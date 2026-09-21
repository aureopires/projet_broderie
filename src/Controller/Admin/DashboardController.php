<?php

namespace App\Controller\Admin;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\QuoteRequestRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use App\Entity\QuoteRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
final class DashboardController extends AbstractController
{
    #[Route('', name: 'admin_dashboard')]
    public function index(
        QuoteRequestRepository $quoteRequestRepository,
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
    ): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'latest_quote_requests' => $quoteRequestRepository->findBy([], ['createdAt' => 'DESC'], 5),
            'latest_reviews' => $reviewRepository->findBy([], ['createdAt' => 'DESC'], 5),
            'quote_requests_count' => $quoteRequestRepository->count([]),
            'new_quote_requests_count' => $quoteRequestRepository->count(['status' => QuoteRequest::STATUS_NEW]),
            'reviews_count' => $reviewRepository->count([]),
            'products_count' => $productRepository->count([]),
            'categories_count' => $categoryRepository->count([]),
            'users_count' => $userRepository->count([]),
        ]);
    }
}
