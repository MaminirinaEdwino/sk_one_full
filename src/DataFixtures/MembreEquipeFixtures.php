<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\MembreEquipe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MembreEquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 20; $i++) { 
            $membre = new MembreEquipe();
            $membre->setMembre($this->getReference('user_'.mt_rand(0,9), User::class)); 
            $membre->setEquipe($this->getReference('equipe_'.mt_rand(0,19), Equipe::class));
            $this->addReference('membreEquipe_'.$i, $membre);
            $manager->persist($membre);
        }
        $manager->flush();
    }
    public function getDependencies(): array{
        return [
            UserFixtures::class,
            EquipeFixtures::class,
        ];
    }
}
