<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Amis;
use App\Repository\PersonRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ RegistrationType;

class InscriptionController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
    


        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'Welcome'

        ]);
    }


    /**
     * @Route("/amis", name="amis")
     */
    public function Amis()
    {
        $user = $this->getUser();



         dump($user);
       $amis = $user->getAmis();

        return $this->render('inscription/amis.html.twig', [
            'controller_name' => 'Jungmin',
            'amis' => $amis,
            'id' => $user->getId(),
        ]);
    }

    /**
     * @Route("/amis/{id}/add", name="addamis")
     */
    public function Addamis($id, Amis $amis = null, Request $request, objectManager $manager)
    {
      if(!$amis){

        $amis = new Amis();
      }



    $user = $this->getUser();


     $amis = $amis->addAmi($user);


       $form = $this->createFormBuilder($amis)

                   ->add('prenom', TextType::class,['attr' => [
                               'placeholder' => "Notez le nom de votre ami",

                               ] ])
                   ->add('age',TextType::class,['attr' => [
                               'placeholder' => "Notez l'age de votre ami.",

                               ] ])
                   ->add('location',TextType::class,['attr' => [
                               'placeholder' => "Notez le location de votre ami.",

                               ] ])

                  ->getForm();


                    $form->handleRequest($request);

                    dump($amis);

                    if($form->isSubmitted() && $form->isValid()){
                      $manager->persist($amis);
                      $manager->flush();

                      return $this->redirectToRoute('amis',['id' => $user->getId()]);

                    };

            return $this->render('inscription/amisadd.html.twig', [
            'controller_name' => $user->getusername(),
            'form' => $form->createView(),
            ]);

    }


    /**
     * @Route("/amisedelete/{id}", name="amisdelete")
     */
    public function amisdelete($id){
          $amis = new Amis();
          $user = $this->getUser();

          $em = $this->getDoctrine()->getManager();

          $post = $em->getRepository($amis)->find($id);



          if($form->isSubmitted() && $form->isValid()){

            $em->remove($post);
            $amis = $amis->removeAmi($user);
            $em->flush();
            $amis->flush();

            return $this->redirectToRoute('amis');
          }

          $user = $this->getUser();
          $id = $user->getId();

          $amisuser = $amis->getUser();

        return $this->render('inscription/amis.html.twig', [


            'amiss' => $amis,
            'user' => $user,
            'id' => $id,

        ]);
    }


}
