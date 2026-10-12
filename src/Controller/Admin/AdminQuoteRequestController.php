<?php

namespace App\Controller\Admin;

use App\Entity\QuoteRequest;
use App\Form\AdminQuoteRequestType;
use App\Repository\QuoteRequestRepository;
use App\Service\QuoteLogoStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/quote', name: 'admin_quote_request_')]
#[IsGranted('ROLE_ADMIN')]
final class AdminQuoteRequestController extends AbstractController
{
    public function __construct(private readonly QuoteLogoStorage $logos)
    {
    }

    #[Route('/{id}/logo', name: 'logo', methods: ['GET'])]
    public function logo(QuoteRequest $quoteRequest): BinaryFileResponse
    {
        $path = $this->logos->downloadablePath($quoteRequest->getLogo());
        if (!$path) {
            throw $this->createNotFoundException('Logo introuvable ou format non autorisé.');
        }
        $response = $this->file($path, $quoteRequest->getLogo(), ResponseHeaderBag::DISPOSITION_ATTACHMENT);
        $response->headers->set('Cache-Control', 'private, no-store');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        return $response;
    }

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
            try {
                $logoFile = $form->get('logoFile')->getData();
                if ($logoFile) {
                    $quoteRequest->setLogo($this->logos->store($logoFile));
                }
            } catch (FileException $exception) {
                $form->get('logoFile')->addError(new FormError('Impossible d’enregistrer le logo. Veuillez réessayer.'));
                return $this->render('admin/admin_quote_request/new.html.twig', ['quote_request' => $quoteRequest, 'form' => $form], new Response(status: Response::HTTP_UNPROCESSABLE_ENTITY));
            }
            try {
                $entityManager->persist($quoteRequest);
                $entityManager->flush();
            } catch (\Throwable $exception) {
                $this->logos->delete($quoteRequest->getLogo());
                throw $exception;
            }

            $this->addFlash('success', 'Demande de devis ajoutée avec succès.');

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
            $oldLogo = $quoteRequest->getLogo();
            $logoFile = $form->get('logoFile')->getData();
            try {
                if ($logoFile) {
                    $quoteRequest->setLogo($this->logos->store($logoFile));
                }
            } catch (FileException $exception) {
                $form->get('logoFile')->addError(new FormError('Impossible d’enregistrer le logo. Veuillez réessayer.'));
                return $this->render('admin/admin_quote_request/edit.html.twig', ['quote_request' => $quoteRequest, 'form' => $form], new Response(status: Response::HTTP_UNPROCESSABLE_ENTITY));
            }
            try {
                $entityManager->flush();
            } catch (\Throwable $exception) {
                if ($logoFile) {
                    $this->logos->delete($quoteRequest->getLogo());
                    $quoteRequest->setLogo($oldLogo);
                }
                throw $exception;
            }
            if ($logoFile) {
                $this->logos->delete($oldLogo);
            }

            $this->addFlash('success', 'Demande de devis modifiée avec succès.');

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
            $logo = $quoteRequest->getLogo();
            $entityManager->remove($quoteRequest);
            $entityManager->flush();
            $this->logos->delete($logo);
            $this->addFlash('success', 'Demande de devis supprimée avec succès.');
        }

        return $this->redirectToRoute('admin_quote_request_index', [], Response::HTTP_SEE_OTHER);
    }

}
