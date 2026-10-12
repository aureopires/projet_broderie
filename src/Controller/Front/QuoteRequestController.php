<?php

namespace App\Controller\Front;

use App\Entity\QuoteRequest;
use App\Form\QuoteRequestType;
use App\Service\QuoteLogoStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/quote', name: 'app_quote_')]
final class QuoteRequestController extends AbstractController
{
    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager, QuoteLogoStorage $logos): Response
    {
        $quoteRequest = new QuoteRequest();

        if ($this->getUser()) {
            $user = $this->getUser();
            if (method_exists($user, 'getFirstName') && method_exists($user, 'getLastName')) {
                $quoteRequest->setName($user->getFirstName() . ' ' . $user->getLastName());
            }
            if (method_exists($user, 'getEmail')) {
                $quoteRequest->setEmail($user->getEmail());
            }
            $quoteRequest->setUser($user);
        }

        $form = $this->createForm(QuoteRequestType::class, $quoteRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $firstName = (string) $form->get('firstName')->getData();
            $lastName = (string) $form->get('lastName')->getData();
            $quoteRequest->setName(trim($firstName . ' ' . $lastName));

            $logoFile = $form->get('logoFile')->getData();
            try {
                if ($logoFile) {
                    $quoteRequest->setLogo($logos->store($logoFile));
                }
            } catch (FileException $exception) {
                $form->get('logoFile')->addError(new FormError('Impossible d’enregistrer le logo. Veuillez réessayer avec une image PNG, JPEG ou WebP.'));
                return $this->render('front/quote_request/new.html.twig', ['form' => $form->createView()], new Response(status: Response::HTTP_UNPROCESSABLE_ENTITY));
            }

            $quoteRequest->setCreatedAt(new \DateTimeImmutable());
            $quoteRequest->setStatus(QuoteRequest::STATUS_NEW);

            try {
                $entityManager->persist($quoteRequest);
                $entityManager->flush();
            } catch (\Throwable $exception) {
                $logos->delete($quoteRequest->getLogo());
                throw $exception;
            }

            $this->addFlash('success', 'Votre demande de devis a été envoyée avec succès !');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('front/quote_request/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
