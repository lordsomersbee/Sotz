<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/homepage")
 */
class PostController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('index.html.twig', array('posts' => $posts));
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function showPost(Request $request, $id, User $user = null)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneByIdJoinedToUserAndCommentsJoinedToUser($id);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setDate(\DateTime::createFromFormat('Y-m-d H-i-s', date('Y-m-d H-i-s')));  
            $comment->setPost($post);

            $user = $this->getUser();
            $comment->setUser($user);          

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
    
            return $this->redirectToRoute('post_show', array('request' => $request, 'id' => $id));
        }

        return $this->render('show.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));             
    }
}
