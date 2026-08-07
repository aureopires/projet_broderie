<?php

namespace App\Controller\Front;

use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ProductRepository $productRepository,
        ReviewRepository $reviewRepository
    ): Response
    {
        // Busca os 8 produtos ativos mais recentes utilizando o repositório
        $products = $productRepository->findActiveRecent(8);
        $reviews = $reviewRepository->findLatestApproved(6);

        return $this->render('front/home/index.html.twig', [
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('front/home/about.html.twig');
    }
//    #[Route('/contact', name: 'app_contact')]
//    public function contact(): Response
//    {
//        return $this->render('front/contact/index.html.twig);
//    }
}
