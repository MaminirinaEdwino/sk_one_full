<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $emp = new Employee();
            $emp->setNom($faker->name);
            $emp->setPrenom($faker->firstName);
            $emp->setEmailpro($faker->email);
            $emp->setTelephone($faker->phoneNumber);
            $emp->setAddresse($faker->address());
            $emp->addPoste($this->getReference('poste_'.mt_rand(0,4), Poste::class));
            $emp->setDateEntree($faker->dateTime);
            $emp->setDateSortie($faker->datetime);
        }
        

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PosteFixtures::class,
        ];
    }
}
