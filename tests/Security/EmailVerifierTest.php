<?php

namespace App\Tests\Security;

use App\Entity\User;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

final class EmailVerifierTest extends KernelTestCase
{
    public function testSignedLinkConfirmsUserWithoutLoggedInSession(): void
    {
        self::bootKernel();
        $user = (new User())->setEmail('camille@example.test');
        (new \ReflectionProperty(User::class, 'id'))->setValue($user, 123);
        $mailer = $this->createMock(MailerInterface::class);
        $signedUrl = null;
        $mailer->expects(self::once())->method('send')->willReturnCallback(static function (TemplatedEmail $email) use (&$signedUrl): void {
            $signedUrl = $email->getContext()['signedUrl'];
        });
        $manager = $this->createMock(EntityManagerInterface::class);
        $manager->expects(self::once())->method('persist')->with($user);
        $manager->expects(self::once())->method('flush');
        $verifier = new EmailVerifier(self::getContainer()->get(VerifyEmailHelperInterface::class), $mailer, $manager);
        $verifier->sendEmailConfirmation('app_verify_email', $user, (new TemplatedEmail())->from('contact@laiguilledesvolcans.fr')->to($user->getEmail()));
        self::assertStringContainsString('id=123', $signedUrl);
        $verifier->handleEmailConfirmation(Request::create($signedUrl), $user);
        self::assertTrue($user->isVerified());
    }

    public function testTamperedLinkDoesNotConfirmOrPersistUser(): void
    {
        self::bootKernel();
        $user = (new User())->setEmail('camille@example.test');
        (new \ReflectionProperty(User::class, 'id'))->setValue($user, 123);
        $helper = self::getContainer()->get(VerifyEmailHelperInterface::class);
        $url = $helper->generateSignature('app_verify_email', '123', $user->getEmail(), ['id' => 123])->getSignedUrl();
        $manager = $this->createMock(EntityManagerInterface::class);
        $manager->expects(self::never())->method('persist');
        $manager->expects(self::never())->method('flush');
        $verifier = new EmailVerifier($helper, $this->createMock(MailerInterface::class), $manager);
        $this->expectException(VerifyEmailExceptionInterface::class);
        $verifier->handleEmailConfirmation(Request::create(str_replace('id=123', 'id=124', $url)), $user);
    }
}
