<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $images = [
            'ballon.jpg',
            'hamac.jpg',
            'parasol.jpg',
            'super-hamac.jpg',
            'ventilo.jpg'
        ];

        // Récupération du faker
        $generator = Factory::create('fr_FR');
        // Populateur d'entités (se base sur /src/Entity)
        $populator = new Populator($generator, $manager);

        // Création des catégories
        $populator->addEntity(Category::class, 10);
        $populator->addEntity(Tag::class, 20);
        $populator->addEntity(User::class, 20);
        $populator->addEntity(Product::class, 197, [
            'price' => function () use ($generator) {
                return $generator->randomFloat(2, 0, 9999999.99);
            },
            'imageName' => function () use ($images) {
                return $images[rand(0, sizeof($images) - 1)];
            }
        ]);

        // Flush
        $populator->execute();
    }
}
