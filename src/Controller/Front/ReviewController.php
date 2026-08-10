<?php

namespace App\Controller\Front;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/review')]
final class ReviewController extends AbstractController
{
    // Adicionado para listar todos os reviews aprovados na página de listagem
    #[Route('', name: 'front_review_index', methods: ['GET'])]
    public function index(ReviewRepository $reviewRepository): Response
    {
        // Busca todos os reviews aprovados do mais recente para o mais antigo
        $reviews = $reviewRepository->findBy(
            ['status' => 'approved'],
            ['createdAt' => 'DESC']
        );

        return $this->render('front/review/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

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

            return $this->redirectToRoute('app_home');
        }

        return $this->render('front/review/new.html.twig', [ // Ajustado caso o template de formulário seja separado
            'reviewForm' => $form->createView(),
        ]);
    }
}
