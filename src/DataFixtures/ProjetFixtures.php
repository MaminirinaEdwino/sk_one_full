<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Projet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            $projet = new Projet();
            $projet->setNom($faker->name);
            $projet->setDescription($faker->sentence());
            $projet->setResponsable($this->getReference('user_'.mt_rand(0,9), User::class));
            $projet->setEquipe($this->getReference('equipe_'.$i, Equipe::class));
            $projet->setAssignant($this->getReference('user_'.mt_rand(0,9), User::class));
            $projet->setDateFin($faker->dateTime());
            $projet->setArchive(false);
            $projet->setStatus("en attente");
            $this->addReference('projet_'.$i, $projet);
            $manager->persist($projet);
        }
        $manager->flush();
    }

    public function getDependencies(): array{
        return[
            UserFixtures::class,
            EquipeFixtures::class
        ];
    }
}
