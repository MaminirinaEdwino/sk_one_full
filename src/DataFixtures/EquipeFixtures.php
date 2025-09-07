<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            $equipe  = new Equipe();
            $equipe->setNom($faker->userName());
            $equipe->setDisponible(true);
            
            $this->addReference('equipe_'.$i, $equipe);
            $manager->persist($equipe);
        }

        $manager->flush();
    }
}
