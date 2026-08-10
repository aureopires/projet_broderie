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
            'name' => 'Broderie personnalisée',
            'slug' => 'broderie-personnalisee',
            'description' => 'Personnaliser vos vêtements accessoires et cadeaux grâce à une broderie de qualité
            durable et élégante. Logo prénoms motifs ou texte : chaque création est réalisée avec soin.',
        ]);

        CategoryFactory::createOne([
            'name' => 'Personnalisation textile et accessoires',
            'slug' => 'personnalisation-textile-et-accessoires',
            'description' => 'Je personnalise vos vêtements professionnels vos tenues d’association, équipement
            sportif ou textiles publicitaires afin de valoriser votre image.',
        ]);

        CategoryFactory::createOne([
            'name' => 'Couture et retouches',
            'slug' => 'couture-et-retouches',
            'description' => 'Besoin d’une retouche? Je réalise différents travaux de couture avec précision pour
            donner une seconde vie à vos textiles ou créer une pièce unique.',
        ]);

        CategoryFactory::createOne([
            'name' => 'Création sur mesure',
            'slug' => 'creation-sur-mesure',
            'description' => 'Envie d’un cadeau personnalisé ou d’une création unique ? ensemble nous imaginons un
            projet qui vous ressemble adapté à vos envies et à votre budget.',
        ]);

        UserFactory::createOne([
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'email' => 'admin@broderie.com',
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
