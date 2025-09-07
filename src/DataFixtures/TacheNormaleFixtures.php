<?php

namespace App\DataFixtures;

use App\Entity\TacheNormale;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TacheNormaleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) { 
            $task = new TacheNormale();
            $task->setNom($faker->name());
            $task->setDescription($faker->sentence());
            $task->setDateFin($faker->dateTime);
            $task->setDateCreation($faker->dateTime);
            $task->setAssigne($this->getReference('user_'.mt_rand(0,99), User::class));
            $task->setAssignant($this->getReference('user_'.mt_rand(0,99), User::class));

            $manager->persist($task);
        }

        $manager->flush();
    }
    public function getDependencies(): array{
        return[
            UserFixtures::class
        ];
    }
}
