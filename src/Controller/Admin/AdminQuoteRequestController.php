<?php

namespace App\Controller\Admin;

use App\Entity\QuoteRequest;
use App\Form\AdminQuoteRequestType;
use App\Repository\QuoteRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/quote', name: 'admin_quote_request_')]
final class AdminQuoteRequestController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(QuoteRequestRepository $quoteRequestRepository): Response
    {
        return $this->render('admin_quote_request/index.html.twig', [
            'quote_requests' => $quoteRequestRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quoteRequest = new QuoteRequest();
        $form = $this->createForm(AdminQuoteRequestType::class, $quoteRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quoteRequest);
            $entityManager->flush();

            return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_quote_request/new.html.twig', [
            'quote_request' => $quoteRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(QuoteRequest $quoteRequest): Response
    {
        return $this->render('admin_quote_request/show.html.twig', [
            'quote_request' => $quoteRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuoteRequest $quoteRequest, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminQuoteRequestType::class, $quoteRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_quote_request/edit.html.twig', [
            'quote_request' => $quoteRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, QuoteRequest $quoteRequest, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quoteRequest->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($quoteRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
