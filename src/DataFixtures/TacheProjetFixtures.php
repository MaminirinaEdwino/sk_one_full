<?php

namespace App\DataFixtures;

use App\Entity\MembreEquipe;
use App\Entity\Projet;
use App\Entity\TacheProjet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TacheProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) { 
            $task = new TacheProjet();
            $task->setSnom($faker->name());
            $task->setStatus("en attente");
            $task->setAssignant($this->getReference('user_'.mt_rand(0,9), User::class));
            $task->setAssigne($this->getReference('membreEquipe_'.mt_rand(0,19),MembreEquipe::class ));
            $deadLine = $faker->dateTimeThisMonth();
            $task->setDateFin($deadLine);
            $task->setDateCreation($faker->dateTimeThisYear($max = $deadLine));
            $task->setProjet($this->getReference('projet_'.mt_rand(0,49), Projet::class));
            $task->setDescription($faker->sentence);
            $this->addReference('tacheProjet_'.$i, $task);
            $manager->persist($task);
        }
        $manager->flush();
    }


    public function getDependencies(): array{
        return [
            UserFixtures::class,
            MembreEquipeFixtures::class,
            ProjetFixtures::class
        ];
    }
}
