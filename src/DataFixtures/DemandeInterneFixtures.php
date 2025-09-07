<?php

namespace App\DataFixtures;

use App\Entity\DemandeInterne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DemandeInterneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');
        // for ($i=0; $i < 10; $i++) { 
        //     $demande = new DemandeInterne();
        //     $demande->setTitre($faker->domainName());
        //     $demande->setDescription($faker->sentence);

        // }

        $manager->flush();
    }
}
