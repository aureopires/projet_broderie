<?php

namespace App\Controller\Front;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ProductRepository $productRepository
    ): Response
    {
        // Busca os 8 produtos ativos mais recentes utilizando o repositório
        $products = $productRepository->findActiveRecent(8);

        return $this->render('front/home/index.html.twig', [
            'products' => $products,
        ]);
    }
}
