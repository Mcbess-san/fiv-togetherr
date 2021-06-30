<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="show")
     */
    public function show(int $id): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['id' => $id]);

            if (!$user) {
                throw $this->createNotFoundException(
                    'No user with id : '.$id.' found in user\'s table.'
                );
            }
        
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findBy(['user' => $id]);

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

}
