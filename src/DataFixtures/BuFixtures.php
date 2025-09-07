<?php

namespace App\DataFixtures;

use App\Entity\BU;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BuFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 10 ; $i++) { 
            $bu = new BU();
            $bu->setNom($faker->company);
            $bu->setManager($this->getReference('user_'.mt_rand(0,99), User::class));
            $this->addReference('bu_'.$i, $bu);
            $manager->persist($bu);
        }
        $manager->flush();
    }
    public function getDependencies(): array{
        return [
            UserFixtures::class
        ];
    }
}
