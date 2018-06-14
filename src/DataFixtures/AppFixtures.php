<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Internet;

// require_once 'vendor/autoload.php';

class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager) 
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setEmail($faker->freeEmail);
            $user->setFirstname($faker->firstNameMale);
            $user->setLastname($faker->lastName);
            $user->setPassword($faker->password);

            for($j = 0; $j < 1; $j++) {
                $post = new Post();
                $post->setTitle($faker->sentence(3));
                $post->setContent($faker->text(700));
                $post->setDate($faker->dateTimeThisMonth);
                $post->setUser($user);
    
                for($k = 0; $k < 2; $k++)
                {   
                    $comment = new Comment();
                    $comment->setDate($faker->dateTimeThisMonth);
                    $comment->setContent($faker->text(50));
                    $comment->setPost($post);
                    $comment->setUser($user);

                    $manager->persist($comment);                                    
                }

                $manager->persist($post);                
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}