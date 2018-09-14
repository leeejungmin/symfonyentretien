<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;


use App\Entity\User;
use App\Form\RegistrationType;

class SecurityController extends Controller
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registeration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
      $user = new User();
      $form = $this->createForm(RegistrationType::class, $user);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){
        $hash = $encoder->encodePassword($user, $user->getPassword());

        $user->setPassword($hash);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('security_login');
      }
        return $this->render('security/registration.html.twig', [

              'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnextion", name="security_logout")
     */
    public function logout(){
        return $this->render('security/login.html.twig');
    }


}