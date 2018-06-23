<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Internet;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// require_once 'vendor/autoload.php';

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) 
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setEmail($faker->freeEmail);
            $user->setUsername($faker->userName);
            $user->setFirstname($faker->firstNameMale);
            $user->setLastname($faker->lastName);

            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $faker->password);
            $user->setPassword($password);

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

        //--------------------

        $user = new User();
        $user->setEmail('qwe@qwe.qwe');
        $user->setUsername('qwe');
        $user->setFirstname('Qwe');
        $user->setLastname('qwE');

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'qwe');
        $user->setPassword($password);

        $manager->persist($user);

        //--------------------

        $manager->flush();
    }
}