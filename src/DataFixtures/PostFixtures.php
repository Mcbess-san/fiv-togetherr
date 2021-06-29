<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    private const MAX_POSTS = 9;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::MAX_POSTS; $i++) {
            $post = new Post();
            $pictureName = $faker->image('public/uploads/', 360, 360, null, false);
            $post->setPictureName($pictureName);
            $post->setDescription($faker->sentence());
            $post->setCreatedAt($faker->dateTime());
            $post->setCategory($this->getReference('category_' . rand(0, count(CategoryFixtures::CATEGORIES) - 1)));
            $post->setUser($this->getReference('user_' . rand(0, UserFixtures::MAX_USERS - 1)));

            $manager->persist($post);
        }
            $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
