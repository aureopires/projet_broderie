<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\SecurityRequestAttributes;

final class LoginLimiterTest extends KernelTestCase
{
    public function testSixthAttemptIsRejected(): void
    {
        self::bootKernel();
        $limiter = self::getContainer()->get('security.login_throttling.main.limiter');
        $request = Request::create('/login', 'POST', server: ['REMOTE_ADDR' => '192.0.2.20']);
        $request->attributes->set(SecurityRequestAttributes::LAST_USERNAME, 'limiter-test-'.bin2hex(random_bytes(8)).'@example.test');
        $limiter->reset($request);
        try {
            for ($attempt = 0; $attempt < 5; ++$attempt) {
                self::assertTrue($limiter->consume($request)->isAccepted());
            }
            self::assertFalse($limiter->consume($request)->isAccepted());
        } finally {
            $limiter->reset($request);
        }
    }
}
