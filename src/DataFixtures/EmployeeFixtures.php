<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) { 
            $emp = new Employee();
            $emp->setNom($faker->name);
            $emp->setPrenom($faker->firstName);
            $emp->setEmailpro($faker->email);
            $phone = $faker->phoneNumber;
            $emp->setTelephone((int) $phone);
            $emp->setAddresse($faker->address());
            $emp->addPoste($this->getReference('poste_'.mt_rand(0,49), Poste::class));
            $entree = $faker->dateTime('now');
            $emp->setDateEntree($entree);

            $sortie = $faker->datetime('now');
            while ($sortie<$entree) {
                $sortie = $faker->datetime('now');
            }
            $emp->setDateSortie($sortie);
            

            $manager->persist($emp);
            $this->addReference("emp_".$i, $emp);
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
