<?php

namespace App\DataFixtures;

use App\Entity\TacheNormale;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TacheNormaleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $task = new TacheNormale();
            $task->setNom($faker->name());
            $task->setDescription($faker->sentence());
            $task->setDateFin($faker->dateTime);
            $task->setDateCreation($faker->dateTime);
            $task->setAssigne($this->getReference('user_'.mt_rand(0,9), User::class));
            $task->setAssignant($this->getReference('user_'.mt_rand(0,9), User::class));

            $manager->persist($task);
        }

        $manager->flush();
    }
}
