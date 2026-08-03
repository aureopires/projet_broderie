<?php

namespace App\Controller\Front;

use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/review')]
final class ReviewController extends AbstractController
{
    #[Route('/new', name: 'front_review_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Garante que apenas usuários logados podem deixar avaliações
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Atribui automaticamente o usuário logado
            $review->setUser($this->getUser());

            // Força o status inicial como pendente para moderação do admin
            $review->setStatus('pending');
            $review->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($review);
            $entityManager->flush();

            $this->addFlash('success', 'Merci ! Votre avis a été soumis et sera publié après validation.');

            return $this->redirectToRoute('app_home'); // Ou para a página de produtos
        }

        return $this->render('front/review/index.html.twig', [
            'reviewForm' => $form->createView(),
        ]);
    }
}
