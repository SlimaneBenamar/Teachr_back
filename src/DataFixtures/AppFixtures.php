<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $teachr = new Teachr();
            $teachr->setPrenom($faker->prenom);
            $teachr->setDateCreation($faker->date_creation);
            $manager->persist($teachr);
        }
        $manager->flush();
    }
}
