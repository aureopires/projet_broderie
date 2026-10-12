<?php

namespace App\Tests\Form;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

final class AdminUserTypeTest extends KernelTestCase
{
    public function testExistingHashIsNeverDisplayedOrChangedByEmptyPassword(): void
    {
        self::bootKernel();
        $user = (new User())->setEmail('test@example.test')->setPassword('existing-hash')->setFirstName('Camille')->setLastName('Exemple');
        $repository = $this->createMock(UserRepository::class);
        $repository->method('findBy')->willReturn([]);
        self::getContainer()->set(UserRepository::class, $repository);
        $form = self::getContainer()->get(FormFactoryInterface::class)->create(AdminUserType::class, $user, ['csrf_protection' => false]);
        self::assertFalse($form->has('password'));
        self::assertSame('', $form->get('plainPassword')->createView()->vars['value']);
        $form->submit(['plainPassword' => ''], false);
        self::assertTrue($form->isValid(), (string) $form->getErrors(true));
        self::assertSame('existing-hash', $user->getPassword());
    }

    public function testNewUserRequiresPassword(): void
    {
        self::bootKernel();
        $user = (new User())->setEmail('test@example.test');
        $repository = $this->createMock(UserRepository::class);
        $repository->method('findBy')->willReturn([]);
        self::getContainer()->set(UserRepository::class, $repository);
        $form = self::getContainer()->get(FormFactoryInterface::class)->create(AdminUserType::class, $user, ['csrf_protection' => false, 'password_required' => true]);
        $form->submit(['plainPassword' => ''], false);
        self::assertFalse($form->isValid());
        self::assertGreaterThan(0, count($form->get('plainPassword')->getErrors()));
    }
}
