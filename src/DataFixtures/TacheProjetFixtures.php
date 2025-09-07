<?php

namespace App\DataFixtures;

use App\Entity\TacheProjet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TacheProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $task = new TacheProjet();
            $task->setSnom($faker->name());
            $task->setStatus("en attente");
            
        }
        $manager->flush();
    }
}
