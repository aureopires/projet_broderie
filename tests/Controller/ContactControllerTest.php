<?php

namespace App\Tests\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportException;

final class ContactControllerTest extends WebTestCase
{
    private array $previousMaintenance;
    private array $previousEmail;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousMaintenance = [$_ENV['SITE_MAINTENANCE'] ?? null, $_SERVER['SITE_MAINTENANCE'] ?? null];
        $_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
        $this->previousEmail = [$_ENV['APP_EMAIL_ENABLED'] ?? null, $_SERVER['APP_EMAIL_ENABLED'] ?? null];
        $_ENV['APP_EMAIL_ENABLED'] = $_SERVER['APP_EMAIL_ENABLED'] = '1';
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($_ENV['SITE_MAINTENANCE'], $_SERVER['SITE_MAINTENANCE']);
        if ($this->previousMaintenance[0] !== null) {
            $_ENV['SITE_MAINTENANCE'] = $this->previousMaintenance[0];
        }
        if ($this->previousMaintenance[1] !== null) {
            $_SERVER['SITE_MAINTENANCE'] = $this->previousMaintenance[1];
        }
        unset($_ENV['APP_EMAIL_ENABLED'], $_SERVER['APP_EMAIL_ENABLED']);
        if ($this->previousEmail[0] !== null) {
            $_ENV['APP_EMAIL_ENABLED'] = $this->previousEmail[0];
        }
        if ($this->previousEmail[1] !== null) {
            $_SERVER['APP_EMAIL_ENABLED'] = $this->previousEmail[1];
        }
    }

    public function testValidContactUsesDomainSenderAndVisitorReplyTo(): void
    {
        $client = self::createClient();
        $client->disableReboot();
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects(self::once())->method('send')->with(self::callback(static function (TemplatedEmail $email): bool {
            return $email->getFrom()[0]->getAddress() === 'contact@laiguilledesvolcans.fr'
                && $email->getReplyTo()[0]->getAddress() === 'camille@example.test'
                && $email->getContext()['messageContent'] === 'Mon projet de broderie.';
        }));
        self::getContainer()->set(MailerInterface::class, $mailer);
        $crawler = $client->request('GET', '/contact');
        self::assertSelectorExists('html[lang="fr"]');
        self::assertSelectorExists('meta[name="viewport"]');
        $form = $crawler->selectButton('Envoyer')->form($this->validData());
        $client->submit($form);
        self::assertResponseRedirects('/contact');
    }

    public function testInvalidEmailAndEmptyNameDoNotSendMail(): void
    {
        $client = self::createClient();
        $client->disableReboot();
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects(self::never())->method('send');
        self::getContainer()->set(MailerInterface::class, $mailer);
        $crawler = $client->request('GET', '/contact');
        $form = $crawler->selectButton('Envoyer')->form(array_replace($this->validData(), ['contact[email]' => 'invalide', 'contact[prenom]' => '   ']));
        $client->submit($form);
        self::assertResponseStatusCodeSame(422);
        self::assertSelectorTextContains('body', 'adresse e-mail valide');
        self::assertSelectorTextContains('body', 'Veuillez renseigner ce champ.');
    }

    public function testMissingCsrfDoesNotSendMail(): void
    {
        $client = self::createClient();
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects(self::never())->method('send');
        self::getContainer()->set(MailerInterface::class, $mailer);
        $client->request('POST', '/contact', ['contact' => ['prenom' => 'Camille', 'nom' => 'Exemple', 'email' => 'camille@example.test', 'message' => 'Mon projet.']]);
        self::assertResponseStatusCodeSame(422);
    }

    public function testDisabledEmailShowsNoticeOnlyAfterSubmissionAndNeverSendsMail(): void
    {
        $_ENV['APP_EMAIL_ENABLED'] = $_SERVER['APP_EMAIL_ENABLED'] = '0';
        $client = self::createClient();
        $client->disableReboot();
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects(self::never())->method('send');
        self::getContainer()->set(MailerInterface::class, $mailer);
        $crawler = $client->request('GET', '/contact');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form[name="contact"]');
        self::assertStringNotContainsString('temporairement indisponible', $client->getResponse()->getContent());
        $client->submit($crawler->selectButton('Envoyer')->form($this->validData()));
        self::assertResponseStatusCodeSame(503);
        self::assertSelectorTextContains('[role="alert"]', 'temporairement indisponible');
        self::assertSelectorTextContains('[role="alert"]', 'Votre message n’a pas été envoyé');
        self::assertSelectorExists('input[name="contact[email]"][value="camille@example.test"]');
    }

    public function testMailFailureDisplaysErrorWithoutClaimingSuccess(): void
    {
        $client = self::createClient();
        $client->disableReboot();
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->method('send')->willThrowException(new TransportException('Simulated failure'));
        self::getContainer()->set(MailerInterface::class, $mailer);
        $crawler = $client->request('GET', '/contact');
        $client->submit($crawler->selectButton('Envoyer')->form($this->validData()));
        self::assertResponseRedirects('/contact');
        $client->followRedirect();
        self::assertSelectorTextContains('[role="alert"]', 'Une erreur est survenue');
    }

    private function validData(): array
    {
        return ['contact[prenom]' => 'Camille', 'contact[nom]' => 'Exemple', 'contact[entite]' => '', 'contact[email]' => 'camille@example.test', 'contact[message]' => 'Mon projet de broderie.'];
    }
}
