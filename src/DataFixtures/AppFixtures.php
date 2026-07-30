<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;
use App\Factory\QuoteRequestFactory;
use App\Factory\ReviewFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        CategoryFactory::createOne([
            'name' => 'Broderie Florale',
            'slug' => 'broderie-florale',
            'description' => 'Motifs floraux délicats et colorés brodés à la main pour illuminer vos tenues et votre intérieur.',
            ]);

        CategoryFactory::createOne([
            'name' => 'Personnalisation Bébé',
            'slug' => 'personnalisation-bebe',
            'description' => 'Articles doux et uniques pour les nouveau-nés : doudous, sorties de bain et bavoirs brodés.',
        ]);

        CategoryFactory::createOne([
            'name' => 'Vêtements & Accessoires',
            'slug' => 'vetements-accessoires',
            'description' => 'Customisez vos vestes en jean, t-shirts, sacs et casquettes avec des broderies originales.',
        ]);

        CategoryFactory::createOne([
            'name' => 'Cercles & Décoration Murale',
            'slug' => 'cercles-decoration-murale',
            'description' => 'Tambours de broderie artistiques prêts à être suspendus pour une déco bohème et chaleureuse.',
            ]);
        CategoryFactory::createOne([
            'name' => 'Cadeaux Personnalisés',
            'slug' => 'cadeaux-personnalises',
            'description' => 'Offrez un cadeau unique pour un anniversaire, un mariage ou un événement spécial avec une broderie sur mesure.',
            ]);

        CategoryFactory::createOne([
            'name' => 'Linge de Maison',
            'slug' => 'linge-de-maison',
            'description' => 'Serviettes, torchons, taies d’oreiller et nappes élégamment personnalisés au fil.',
            ]);

        CategoryFactory::createMany(4);


        UserFactory::createOne([
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'email' =>  'admin@broderie.com',
            'roles' => ['ROLE_ADMIN'],
            'password' => 'admin123'
        ]);

        UserFactory::createMany(50);

        ProductFactory::createMany(30);

        ReviewFactory::createMany(40);

        QuoteRequestFactory::createMany(15);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
