<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/user')]
final class AdminUserController extends AbstractController
{
    #[Route(name: 'admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/admin_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(
        Request                     $request,
        EntityManagerInterface      $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {
        $user = new User();
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pega a senha em texto plano digitada no formulário e faz o hash
            $plainPassword = $user->getPassword();
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/admin_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request                     $request,
        User                        $user,
        EntityManagerInterface      $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {
        // Guarda a senha atual caso o campo venha em branco na edição
        $currentPassword = $user->getPassword();

        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Se uma nova senha foi digitada, faz o hash dela. Senão, mantém a antiga.
            $plainPassword = $user->getPassword();
            if ($plainPassword && $plainPassword !== $currentPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            } else {
                $user->setPassword($currentPassword);
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
