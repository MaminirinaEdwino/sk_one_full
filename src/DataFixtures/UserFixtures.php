<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserPasswordHasherInterface $hasher
    ){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager ): void
    {
        
        for ($i=0; $i < 100; $i++) { 
            $emp = $this->getReference('emp_'.$i, Employee::class);
            $user = new User();
            $user->setEmail($emp->getEmailpro());
            $user->setPassword($this->hasher->hashPassword($user, 'testeuser'));
            $user->setEmployee($emp);
            $user->setPassword($this->hasher->hashPassword($user, 'testeuser'));
            $user->setRoles(['ROLE_COLLABORATTEUR']);
            $this->addReference("user_".$i, $user);
            $manager->persist($user);
        }


        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            EmployeeFixtures::class,
        ];
    }
}
