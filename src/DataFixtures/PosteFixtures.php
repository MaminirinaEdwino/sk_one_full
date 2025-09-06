<?php

namespace App\DataFixtures;

use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PosteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            $poste = new Poste();
            $poste->setNom($faker->word);
            $poste->setDescription($faker->sentence);
            $manager->persist($poste);

            $this->addReference('poste_'.$i, $poste);
        }

        $manager->flush();
    }
}
