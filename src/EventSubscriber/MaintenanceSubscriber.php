<?php

namespace App\EventSubscriber;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function __construct(
        #[Autowire('%env(bool:SITE_MAINTENANCE)%')]
        private readonly bool $maintenanceEnabled,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
        private readonly AuthorizationCheckerInterface $authorizationChecker,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', -10],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest() || !$this->maintenanceEnabled) {
            return;
        }

        $path = $event->getRequest()->getPathInfo();

        if (
            $path === '/login'
            || str_starts_with($path, '/build/')
            || str_starts_with($path, '/assets/')
            || str_starts_with($path, '/bundles/')
            || $this->authorizationChecker->isGranted('ROLE_ADMIN')
        ) {
            return;
        }

        $maintenancePage = file_get_contents(
            $this->projectDir.'/public/maintenance.html'
        );

        if ($maintenancePage === false) {
            throw new \RuntimeException('Impossible de lire la page de maintenance.');
        }

        $event->setResponse(new Response(
            $maintenancePage,
            Response::HTTP_SERVICE_UNAVAILABLE,
            [
                'Content-Type' => 'text/html; charset=UTF-8',
                'Cache-Control' => 'no-store',
            ],
        ));
    }
}
