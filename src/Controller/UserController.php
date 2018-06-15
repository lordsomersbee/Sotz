<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="login")
     */
    public function index(Request $request)
    {
        //TODO action when wrong login

        $userInput = new User();

        $form = $this->createForm(LoginType::class, $userInput);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userInput = $form->getData();
            
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $userInput->getEmail()]);

            $session = new Session();
            // $session->start();

            $this->getDoctrine()->getManager()->detach($user);
            $session->set('logged_user', $user);
    
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/login.html.twig', array(
            'form' => $form->createView()
        ));
    }

    //TODO register mechanizm

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
    {
        $newUser = new User();

        $form = $this->createForm(RegisterType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();

            //TODO check if email is not in database
            //TODO send mail to confirm registration
            //TODO meybe some flash message

            //form validation

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();
            
            return $this->redirectToRoute('login', array('request' => $request));
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    //TODO show profile mechanizm
}
