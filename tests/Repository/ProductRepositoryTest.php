<?php

namespace App\Tests\Repository;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

final class ProductRepositoryTest extends TestCase
{
    public function testCategoryQueryExcludesInactiveAndOtherCategoryProducts(): void
    {
        $config = ORMSetup::createAttributeMetadataConfiguration([dirname(__DIR__, 2).'/src/Entity'], true);
        $connection = DriverManager::getConnection(['driver' => 'pdo_sqlite', 'memory' => true]);
        $manager = new EntityManager($connection, $config);
        try {
            (new SchemaTool($manager))->createSchema($manager->getMetadataFactory()->getAllMetadata());
            $category = (new Category())->setName('Broderie')->setSlug('broderie');
            $otherCategory = (new Category())->setName('Autre')->setSlug('autre');
            $manager->persist($category);
            $manager->persist($otherCategory);
            foreach ([['ancien', true, $category, '2026-01-01'], ['récent', true, $category, '2026-02-01'], ['masqué', false, $category, '2026-03-01'], ['autre', true, $otherCategory, '2026-04-01']] as [$title, $active, $associatedCategory, $date]) {
                $product = (new Product())->setTitle($title)->setSlug($title)->setIsActive($active)->setCreatedAt(new \DateTimeImmutable($date))->addCategory($associatedCategory);
                $manager->persist($product);
            }
            $manager->flush();
            $manager->clear();
            $registry = $this->createMock(ManagerRegistry::class);
            $registry->method('getManagerForClass')->with(Product::class)->willReturn($manager);
            $repository = new ProductRepository($registry);
            self::assertSame(['récent', 'ancien'], array_map(static fn (Product $product) => $product->getTitle(), $repository->findByCategorySlug('broderie')));
            self::assertSame([], $repository->findByCategorySlug('inexistante'));
        } finally {
            $manager->close();
            $connection->close();
        }
    }
}
