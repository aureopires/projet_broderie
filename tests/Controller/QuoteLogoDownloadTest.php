<?php

namespace App\Tests\Controller;

use App\Entity\QuoteRequest;
use App\Entity\User;
use App\Repository\QuoteRequestRepository;
use App\Service\QuoteLogoStorage;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class QuoteLogoDownloadTest extends WebTestCase
{
    private string $directory;
    private array $previousMaintenance;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousMaintenance = [$_ENV['SITE_MAINTENANCE'] ?? null, $_SERVER['SITE_MAINTENANCE'] ?? null];
        $_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
        $this->directory = sys_get_temp_dir().'/quote-download-'.bin2hex(random_bytes(8));
        mkdir($this->directory);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        (new Filesystem())->remove($this->directory);
        unset($_ENV['SITE_MAINTENANCE'], $_SERVER['SITE_MAINTENANCE']);
        if ($this->previousMaintenance[0] !== null) {
            $_ENV['SITE_MAINTENANCE'] = $this->previousMaintenance[0];
        }
        if ($this->previousMaintenance[1] !== null) {
            $_SERVER['SITE_MAINTENANCE'] = $this->previousMaintenance[1];
        }
    }

    public function testAnonymousUserMustLogIn(): void
    {
        $client = self::createClient();
        $client->request('GET', '/admin/quote/123/logo');
        self::assertResponseRedirects('/login');
    }

    public function testOrdinaryUserIsForbidden(): void
    {
        $client = self::createClient();
        $user = $this->user([]);
        $client->loginUser($user);
        $client->request('GET', '/admin/quote/123/logo');
        self::assertResponseStatusCodeSame(403);
    }

    public function testAdministratorCanDownloadWithPrivateHeaders(): void
    {
        $client = self::createClient();
        $client->loginUser($this->user(['ROLE_ADMIN']));
        imagepng(imagecreatetruecolor(2, 2), $this->directory.'/example.png');
        $quote = (new QuoteRequest())->setLogo('example.png');
        $repository = $this->createMock(QuoteRequestRepository::class);
        $repository->method('find')->willReturn($quote);
        self::getContainer()->set(QuoteRequestRepository::class, $repository);
        self::getContainer()->set(QuoteLogoStorage::class, new QuoteLogoStorage($this->directory, new NullLogger()));

        $client->request('GET', '/admin/quote/123/logo');
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('attachment', $client->getResponse()->headers->get('Content-Disposition'));
        self::assertStringContainsString('no-store', $client->getResponse()->headers->get('Cache-Control'));
        self::assertResponseHeaderSame('X-Content-Type-Options', 'nosniff');
    }

    public function testMissingLogoReturns404ForAdministrator(): void
    {
        $client = self::createClient();
        $client->loginUser($this->user(['ROLE_ADMIN']));
        $repository = $this->createMock(QuoteRequestRepository::class);
        $repository->method('find')->willReturn((new QuoteRequest())->setLogo('missing.png'));
        self::getContainer()->set(QuoteRequestRepository::class, $repository);
        self::getContainer()->set(QuoteLogoStorage::class, new QuoteLogoStorage($this->directory, new NullLogger()));
        $client->request('GET', '/admin/quote/123/logo');
        self::assertResponseStatusCodeSame(404);
    }

    private function user(array $roles): User
    {
        $user = (new User())->setEmail('test@example.test')->setPassword('test-hash')->setRoles($roles);
        (new \ReflectionProperty(User::class, 'id'))->setValue($user, 123);
        $provider = $this->createMock(UserProviderInterface::class);
        $provider->method('refreshUser')->willReturn($user);
        $provider->method('supportsClass')->willReturn(true);
        self::getContainer()->set('security.user.provider.concrete.app_user_provider', $provider);
        return $user;
    }
}
