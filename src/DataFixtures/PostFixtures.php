<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $post = new Post;
            $pictureName = $faker->image('public/uploads/', 360, 360, null, false);
            $post->setPictureName($pictureName); 
            $post->setDescription($faker->sentence());
            $post->setCreatedAt($faker->dateTime());

            $manager->persist($post);
        }
            $manager->flush();
    }
}
