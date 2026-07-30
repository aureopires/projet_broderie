<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product', name: 'app_product_')]
final class ProductController extends AbstractController
{
    /**
     * 1. Lista todos os produtos ativos e exibe as categorias para navegação
     */
    #[Route('', name: 'index')]
    public function index(
        ProductRepository  $productRepository,
        CategoryRepository $categoryRepository
    ): Response
    {
        $products = $productRepository->findBy(['isActive' => true], ['createdAt' => 'DESC']);
        $categories = $categoryRepository->findAll();

        return $this->render('front/product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            ]);
    }

    /**
     * 2. Lista os produtos filtrados por uma categoria específica usando o slug
     */
    #[Route('/category/{slug}', name: 'category')]
    public function category(string $slug, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie introuvable.');
        }

        // Utilizando o método personalizado que criamos no ProductRepository!
        $products = $productRepository->findByCategorySlug($slug);
        $categories = $categoryRepository->findAll();

        return $this->render('front/product/category.html.twig', [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * 3. Exibe os detalhes de um produto único pelo seu slug
     */
    #[Route('/{slug}', name: 'show')]
    public function show(string $slug, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBy(['slug' => $slug, 'isActive' => true]);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        return $this->render('front/product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
