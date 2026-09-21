<?php

namespace App\Controller\Front;

use App\Entity\QuoteRequest;
use App\Form\QuoteRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/quote', name: 'app_quote_')]
final class QuoteRequestController extends AbstractController
{
    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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

            /** @var UploadedFile|null $logoFile */
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile) {
                $logoDirectory = $this->getParameter('quote_logos_directory');
                if (!is_dir($logoDirectory) && !mkdir($logoDirectory, 0755, true) && !is_dir($logoDirectory)) {
                    throw new \RuntimeException('Impossible de créer le dossier de stockage du logo.');
                }

                $logoFilename = bin2hex(random_bytes(16)) . '.' . $logoFile->guessExtension();
                $logoFile->move($logoDirectory, $logoFilename);
                $quoteRequest->setLogo($logoFilename);
            }

            $quoteRequest->setCreatedAt(new \DateTimeImmutable());
            $quoteRequest->setStatus(QuoteRequest::STATUS_NEW);

            $entityManager->persist($quoteRequest);
            $entityManager->flush();

            $this->addFlash('success', 'Votre demande de devis a été envoyée avec succès !');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('front/quote_request/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
