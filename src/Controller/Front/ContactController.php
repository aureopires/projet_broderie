<?php

namespace App\Controller\Front;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $prenom = $request->request->get('prenom');
            $nom = $request->request->get('nom');
            $entite = $request->request->get('entite');
            $email = $request->request->get('email');
            $message = $request->request->get('message');

            // Validação simples
            if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($message)) {
                $emailMessage = (new TemplatedEmail())
                    ->from($email)
                    ->to('contact@laiguilledesvolcans.fr') // Insira o e-mail da admin aqui
                    ->subject("Nouveau message de contact de {$prenom} {$nom}")
                    ->htmlTemplate('front/contact/email.html.twig')
                    ->context([
                        'prenom' => $prenom,
                        'nom' => $nom,
                        'entite' => $entite,
                        'email' => $email,
                        'messageContent' => $message,
                    ]);

                try {
                    $mailer->send($emailMessage);
                    $this->addFlash('success', 'Votre message a été envoyé avec succès !');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi du message.');
                }

                return $this->redirectToRoute('app_contact');
            } else {
                $this->addFlash('error', 'Veuillez remplir tous les champs obligatoires.');
            }
        }

        return $this->render('front/contact/index.html.twig');
    }
}
