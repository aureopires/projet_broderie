<?php

namespace App\Controller\Admin;

use App\Entity\QuoteRequest;
use App\Form\AdminQuoteRequestType;
use App\Repository\QuoteRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/quote', name: 'admin_quote_request_')]
final class AdminQuoteRequestController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(QuoteRequestRepository $quoteRequestRepository): Response
    {
        return $this->render('admin/admin_quote_request/index.html.twig', [
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
            $this->storeLogo($form, $quoteRequest);
            $entityManager->persist($quoteRequest);
            $entityManager->flush();

            return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_quote_request/new.html.twig', [
            'quote_request' => $quoteRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(QuoteRequest $quoteRequest): Response
    {
        return $this->render('admin/admin_quote_request/show.html.twig', [
            'quote_request' => $quoteRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuoteRequest $quoteRequest, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminQuoteRequestType::class, $quoteRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->storeLogo($form, $quoteRequest);
            $entityManager->flush();

            return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_quote_request/edit.html.twig', [
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

    private function storeLogo(FormInterface $form, QuoteRequest $quoteRequest): void
    {
        /** @var UploadedFile|null $logoFile */
        $logoFile = $form->get('logoFile')->getData();
        if (!$logoFile) {
            return;
        }

        $logoDirectory = $this->getParameter('quote_logos_directory');
        if (!is_dir($logoDirectory) && !mkdir($logoDirectory, 0755, true) && !is_dir($logoDirectory)) {
            throw new \RuntimeException('Impossible de créer le dossier de stockage du logo.');
        }

        $logoFilename = bin2hex(random_bytes(16)) . '.' . $logoFile->guessExtension();
        $logoFile->move($logoDirectory, $logoFilename);
        $quoteRequest->setLogo($logoFilename);
    }
}
