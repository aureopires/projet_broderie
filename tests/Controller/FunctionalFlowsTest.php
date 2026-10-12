<?php

namespace App\Tests\Controller;

use App\Entity\QuoteRequest;
use App\Entity\Review;
use App\Entity\User;
use App\Service\QuoteLogoStorage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Psr\Log\NullLogger;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class FunctionalFlowsTest extends WebTestCase
{
    private array $previousEnvironment;
    private string $directory;
    private EntityManagerInterface $manager;
    private KernelBrowser $client;
    private array $emails = [];

    protected function setUp(): void
    {
        parent::setUp();
        foreach (['DATABASE_URL' => 'sqlite:///:memory:', 'SITE_MAINTENANCE' => '0', 'APP_EMAIL_ENABLED' => '1'] as $key => $value) {
            $this->previousEnvironment[$key] = [$_ENV[$key] ?? null, $_SERVER[$key] ?? null];
            $_ENV[$key] = $_SERVER[$key] = $value;
        }
        $this->directory = sys_get_temp_dir().'/broderie-flow-'.bin2hex(random_bytes(8));
        mkdir($this->directory);
        $this->client = self::createClient();
        $this->client->disableReboot();
        $this->manager = self::getContainer()->get(EntityManagerInterface::class);
        // Fail before schema creation if the test connection is not isolated SQLite memory.
        $parameters = $this->manager->getConnection()->getParams();
        self::assertSame('pdo_sqlite', $parameters['driver']);
        self::assertTrue($parameters['memory']);
        (new SchemaTool($this->manager))->createSchema($this->manager->getMetadataFactory()->getAllMetadata());
        self::getContainer()->set(QuoteLogoStorage::class, new QuoteLogoStorage($this->directory.'/private', new NullLogger()));
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->method('send')->willReturnCallback(function (TemplatedEmail $email): void {
            $this->emails[] = $email;
        });
        self::getContainer()->set(MailerInterface::class, $mailer);
    }

    protected function tearDown(): void
    {
        $this->manager->getConnection()->close();
        parent::tearDown();
        (new Filesystem())->remove($this->directory);
        foreach ($this->previousEnvironment as $key => [$env, $server]) {
            unset($_ENV[$key], $_SERVER[$key]);
            if ($env !== null) {
                $_ENV[$key] = $env;
            }
            if ($server !== null) {
                $_SERVER[$key] = $server;
            }
        }
    }

    public function testQuotePersistsWithPrivateLogoAndAdminCanReplaceThenDeleteIt(): void
    {
        $source = $this->directory.'/logo.png';
        imagepng(imagecreatetruecolor(2, 2), $source);
        $crawler = $this->client->request('GET', '/quote/new');
        $form = $crawler->selectButton('Envoyer')->form($this->quoteData());
        $form['quote_request[logoFile]']->upload($source);
        $this->client->submit($form);
        self::assertResponseRedirects('/');
        $quote = $this->manager->getRepository(QuoteRequest::class)->findOneBy(['email' => 'camille@example.test']);
        self::assertNotNull($quote);
        self::assertSame(QuoteRequest::STATUS_NEW, $quote->getStatus());
        $oldLogo = $quote->getLogo();
        self::assertFileExists($this->directory.'/private/'.$oldLogo);

        $admin = $this->createUser(['ROLE_ADMIN']);
        $this->client->loginUser($admin);
        $crawler = $this->client->request('GET', '/admin/quote/'.$quote->getId().'/edit');
        $form = $crawler->selectButton('Mettre à jour')->form(['admin_quote_request[user]' => $admin->getId()]);
        imagepng(imagecreatetruecolor(3, 3), $source);
        $form['admin_quote_request[logoFile]']->upload($source);
        $this->client->submit($form);
        self::assertResponseRedirects('/admin/quote', 303);
        $quote = $this->manager->getRepository(QuoteRequest::class)->find($quote->getId());
        $newLogo = $quote->getLogo();
        self::assertNotSame($oldLogo, $newLogo);
        self::assertFileDoesNotExist($this->directory.'/private/'.$oldLogo);
        self::assertFileExists($this->directory.'/private/'.$newLogo);

        $crawler = $this->client->request('GET', '/admin/quote/'.$quote->getId());
        $this->client->submit($crawler->selectButton('Supprimer')->form());
        self::assertResponseRedirects('/admin/quote', 303);
        self::assertFileDoesNotExist($this->directory.'/private/'.$newLogo);
        self::assertSame(0, $this->manager->getRepository(QuoteRequest::class)->count([]));
    }

    public function testInvalidQuoteDoesNotPersist(): void
    {
        $crawler = $this->client->request('GET', '/quote/new');
        $this->client->submit($crawler->selectButton('Envoyer')->form(array_replace($this->quoteData(), ['quote_request[email]' => 'invalide', 'quote_request[firstName]' => ''])));
        self::assertSelectorTextContains('body', 'adresse e-mail valide');
        self::assertSame(0, $this->manager->getRepository(QuoteRequest::class)->count([]));
    }

    public function testReviewBecomesPublicOnlyAfterAdminApproval(): void
    {
        $user = $this->createUser([]);
        $this->client->loginUser($user);
        $crawler = $this->client->request('GET', '/review/new');
        $this->client->submit($crawler->selectButton('Envoyer mon avis')->form(['review[rating]' => 5, 'review[content]' => 'Témoignage de test unique.']));
        self::assertResponseRedirects('/');
        $review = $this->manager->getRepository(Review::class)->findOneBy(['content' => 'Témoignage de test unique.']);
        self::assertSame(Review::STATUS_PENDING, $review->getStatus());
        $this->client->request('GET', '/review');
        self::assertStringNotContainsString('Témoignage de test unique.', $this->client->getResponse()->getContent());
        $this->client->loginUser($this->createUser(['ROLE_ADMIN']));
        $crawler = $this->client->request('GET', '/admin/review/'.$review->getId().'/edit');
        $this->client->submit($crawler->selectButton('Mettre à jour')->form(['admin_review[status]' => Review::STATUS_APPROVED]));
        self::assertResponseRedirects('/admin/review', 303);
        $this->client->request('GET', '/review');
        self::assertSelectorTextContains('body', 'Témoignage de test unique.');
        self::assertStringNotContainsString($user->getEmail(), $this->client->getResponse()->getContent());
    }

    public function testRegistrationSendsSignedLinkAndConfirmationUpdatesAccount(): void
    {
        $crawler = $this->client->request('GET', '/register');
        $this->client->submit($crawler->selectButton("S'inscrire")->form([
            'registration_form[email]' => 'registration@example.test',
            'registration_form[first_name]' => 'Camille', 'registration_form[last_name]' => 'Exemple',
            'registration_form[plainPassword]' => 'phrase-secrete-123',
        ]));
        self::assertResponseRedirects('/');
        self::assertCount(1, $this->emails);
        $url = $this->emails[0]->getContext()['signedUrl'];
        $user = $this->manager->getRepository(User::class)->findOneBy(['email' => 'registration@example.test']);
        self::assertFalse($user->isVerified());
        self::assertNotSame('phrase-secrete-123', $user->getPassword());
        self::assertTrue(self::getContainer()->get(UserPasswordHasherInterface::class)->isPasswordValid($user, 'phrase-secrete-123'));
        $this->client->request('GET', $url);
        self::assertResponseRedirects('/');
        $user = $this->manager->getRepository(User::class)->find($user->getId());
        self::assertTrue($user->isVerified());
    }

    private function createUser(array $roles): User
    {
        $user = (new User())->setEmail(bin2hex(random_bytes(6)).'@example.test')->setFirstName('Camille')->setLastName('Exemple')->setRoles($roles)->setPassword('test-hash')->setIsVerified(true);
        $this->manager->persist($user);
        $this->manager->flush();
        return $user;
    }

    private function quoteData(): array
    {
        return [
            'quote_request[articleType]' => 'Polo', 'quote_request[articleOrigin]' => 'client',
            'quote_request[markingType]' => 'broderie', 'quote_request[quantity]' => 12,
            'quote_request[firstName]' => 'Camille', 'quote_request[lastName]' => 'Exemple',
            'quote_request[organizationType]' => 'particulier', 'quote_request[email]' => 'camille@example.test',
            'quote_request[phone]' => '0600000000', 'quote_request[message]' => 'Douze polos de test.',
        ];
    }
}
