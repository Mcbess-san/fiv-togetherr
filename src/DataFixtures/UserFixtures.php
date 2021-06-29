<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private const MAX_USERS = 5;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::MAX_USERS; $i++) {
            $user = new User();
            $user->setName($faker->name());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
