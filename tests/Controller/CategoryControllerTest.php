<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CategoryControllerTest extends WebTestCase
{
    private array $previousMaintenance;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousMaintenance = [$_ENV['SITE_MAINTENANCE'] ?? null, $_SERVER['SITE_MAINTENANCE'] ?? null];
        // Override maintenance only for this test process.
        $_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        foreach (['env', 'server'] as $index => $target) {
            if ($target === 'env') {
                unset($_ENV['SITE_MAINTENANCE']);
                if ($this->previousMaintenance[$index] !== null) {
                    $_ENV['SITE_MAINTENANCE'] = $this->previousMaintenance[$index];
                }
            } else {
                unset($_SERVER['SITE_MAINTENANCE']);
                if ($this->previousMaintenance[$index] !== null) {
                    $_SERVER['SITE_MAINTENANCE'] = $this->previousMaintenance[$index];
                }
            }
        }
    }

    #[DataProvider('categoryRoutes')]
    public function testCategoryDisplaysOnlyRepositoryResults(string $prefix): void
    {
        $client = self::createClient();
        $category = (new Category())->setName('Broderie test')->setSlug('broderie-test');
        $active = (new Product())->setTitle('Produit actif test')->setSlug('actif-test')->setIsActive(true);
        $inactive = (new Product())->setTitle('Produit masqué test')->setSlug('masque-test')->setIsActive(false);
        $category->addProduct($active);
        $category->addProduct($inactive);
        $this->replaceRepositories($category, [$active]);
        $client->request('GET', $prefix.'broderie-test');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Broderie test');
        self::assertSelectorTextContains('.product-card', 'Produit actif test');
        self::assertStringNotContainsString('Produit masqué test', $client->getResponse()->getContent());
    }

    #[DataProvider('categoryRoutes')]
    public function testCategoryWithoutActiveProductsDisplaysEmptyState(string $prefix): void
    {
        $client = self::createClient();
        $category = (new Category())->setName('Broderie test')->setSlug('broderie-test');
        $category->addProduct((new Product())->setTitle('Produit masqué test')->setSlug('masque-test')->setIsActive(false));
        $this->replaceRepositories($category, []);
        $client->request('GET', $prefix.'broderie-test');
        self::assertResponseIsSuccessful();
        self::assertSelectorCount(0, '.product-card');
        self::assertSelectorTextContains('.alert-info', "Aucun produit n'est associé");
    }

    #[DataProvider('categoryRoutes')]
    public function testUnknownCategoryReturns404(string $prefix): void
    {
        $client = self::createClient();
        $this->replaceRepositories(null, []);
        $client->request('GET', $prefix.'broderie-test');
        self::assertResponseStatusCodeSame(404);
    }

    private function replaceRepositories(?Category $category, array $products): void
    {
        $categories = $this->createMock(CategoryRepository::class);
        $categories->expects(self::once())->method('findOneBy')->with(['slug' => 'broderie-test'])->willReturn($category);
        $repository = $this->createMock(ProductRepository::class);
        $repository->expects($category ? self::once() : self::never())->method('findByCategorySlug')->with('broderie-test')->willReturn($products);
        self::getContainer()->set(CategoryRepository::class, $categories);
        self::getContainer()->set(ProductRepository::class, $repository);
    }

    public static function categoryRoutes(): iterable
    {
        yield 'route catégorie' => ['/category/'];
        yield 'route catégorie produit' => ['/product/category/'];
    }
}
