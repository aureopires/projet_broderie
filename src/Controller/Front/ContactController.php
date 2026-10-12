<?php

namespace App\Controller\Front;

use App\Form\ContactType;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\FormError;

final class ContactController extends AbstractController
{
    public function __construct(#[Autowire('%env(bool:APP_EMAIL_ENABLED)%')] private readonly bool $emailEnabled)
    {
    }

    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function index(Request $request, MailerInterface $mailer, LoggerInterface $logger): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->emailEnabled) {
                $form->addError(new FormError('L’envoi par e-mail est temporairement indisponible. Votre message n’a pas été envoyé. Veuillez réessayer plus tard ou nous joindre au 06 77 89 58 69.'));
                return $this->render('front/contact/index.html.twig', ['form' => $form], new Response(status: Response::HTTP_SERVICE_UNAVAILABLE));
            }
            $data = $form->getData();
            $emailMessage = (new TemplatedEmail())
                ->from('contact@laiguilledesvolcans.fr')
                ->replyTo($data['email'])
                ->to('contact@laiguilledesvolcans.fr')
                ->subject('Nouveau message de contact')
                ->htmlTemplate('front/contact/email.html.twig')
                ->context([
                    'prenom' => $data['prenom'],
                    'nom' => $data['nom'],
                    'entite' => $data['entite'],
                    'email' => $data['email'],
                    'messageContent' => $data['message'],
                ]);

            try {
                $mailer->send($emailMessage);
                $this->addFlash('success', 'Votre message a été envoyé avec succès !');
            } catch (TransportExceptionInterface $exception) {
                $logger->error('Échec de l’envoi du formulaire de contact.', ['exception' => $exception]);
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi du message.');
            }

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('front/contact/index.html.twig', ['form' => $form], new Response(status: $form->isSubmitted() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK));
    }
}
