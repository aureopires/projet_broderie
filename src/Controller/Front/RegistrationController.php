<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\RateLimiter\RateLimiterFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private EmailVerifier $emailVerifier,
        private LoggerInterface $logger,
        #[Autowire('%env(bool:APP_EMAIL_ENABLED)%')] private readonly bool $emailEnabled,
    )
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                             Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            if ($this->emailEnabled) {
                $this->sendConfirmation($user);
            } else {
                $this->addFlash('success', 'Votre compte a été créé.');
            }

            return $security->login($user, 'form_login', 'main');
        }

        return $this->render('front/registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email', methods: ['GET'])]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $users): Response
    {
        $id = filter_var($request->query->get('id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $user = $id ? $users->find($id) : null;
        if (!$user) {
            throw $this->createNotFoundException('Lien de confirmation invalide.');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('success', 'Votre adresse e-mail a été confirmée.');

        return $this->redirectToRoute('app_home');
    }

    #[Route('/verify/email/resend', name: 'app_verify_email_resend', methods: ['GET', 'POST'])]
    public function resend(Request $request, #[Autowire(service: 'limiter.email_confirmation')] RateLimiterFactoryInterface $limiter): Response
    {
        if (!$this->emailEnabled) {
            throw $this->createNotFoundException('La confirmation par e-mail est temporairement indisponible.');
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var User $user */
        $user = $this->getUser();
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('resend_confirmation', $request->request->getString('_token'))) {
                throw $this->createAccessDeniedException('Jeton de sécurité invalide.');
            }
            if (!$user->isVerified()) {
                if (!$limiter->create((string) $user->getId())->consume()->isAccepted()) {
                    return $this->render('front/registration/resend_email.html.twig', ['rateLimited' => true], new Response(status: Response::HTTP_TOO_MANY_REQUESTS));
                }
                $this->sendConfirmation($user);
            }
            return $this->redirectToRoute('app_verify_email_resend');
        }
        return $this->render('front/registration/resend_email.html.twig', ['rateLimited' => false]);
    }

    private function sendConfirmation(User $user): void
    {
        try {
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('contact@laiguilledesvolcans.fr', 'L’Aiguille des Volcans'))
                    ->to((string) $user->getEmail())
                    ->subject('Confirmez votre adresse e-mail')
                    ->htmlTemplate('front/registration/confirmation_email.html.twig'),
            );
            $this->addFlash('success', 'Un lien de confirmation vous a été envoyé par e-mail.');
        } catch (TransportExceptionInterface $exception) {
            $this->logger->error('Échec de l’envoi du lien de confirmation.', ['exception' => $exception]);
            $this->addFlash('error', 'Votre compte existe, mais le lien n’a pas pu être envoyé. Vous pouvez réessayer depuis « Confirmer mon adresse e-mail ».');
        }
    }
}
