<?php

namespace App\DataFixtures;

use App\Entity\Cooker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CookerFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $cooker = new Cooker();
        $cooker->setEmail("clement.vetillard@knpkabs.com");
        $cooker->setRoles(["ROLE_USER"]);
        $password = $this->passwordHasher
            ->hashPassword($cooker, "mysecurepassword");
        $cooker->setPassword($password);
        $manager->persist($cooker);
        $manager->flush();
    }
}
