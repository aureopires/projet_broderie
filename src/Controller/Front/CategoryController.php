<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'app_category_')]
final class CategoryController extends AbstractController
{
    /**
     * 1. Lista todas as categorias
     */
    #[Route('', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('front/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * 2. Exibe uma categoria específica e seus produtos
     */
    #[Route('/{slug}', name: 'show')]
    public function show(string $slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie introuvable.');
        }

        return $this->render('front/category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
