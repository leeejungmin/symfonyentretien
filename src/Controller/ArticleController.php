<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Amis;
use App\Entity\Comment;

use App\Repository\PersonRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ PasswordType;
use App\Form\ ArticleRegisterType;
use App\Form\ CommentRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ArticleController extends Controller
{
    /**
     * @Route("/article/register", name="articleregister")
     */
    public function registerarticle(Article $article  ,Request $request, ObjectManager $manager)
    {

      $user = $this->getUser();


      $form = $this->createForm(ArticleRegisterType::class, $article);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){

        $manager->persist($article);
        $manager->flush();

        return $this->redirectToRoute('article');
      }
        return $this->render('article/artregister.html.twig', [

              'form' => $form->createView(),
              'user' => $user,
        ]);
    }

    /**
     * @Route("/article", name="article")
     */
    public function showarticle(){


          $repo = $this->getDoctrine()->getRepository(Article::class);

          $articles = $repo->findAll();


          $user = $this->getUser();

        return $this->render('article/article.html.twig', [


            'articles' => $articles,

            'user' => $user,

        ]);
    }

    /**
     * @Route("/articleupdate/{id}", name="articleupdate")
     */
    public function articleupdate($id){

          $article = new Article();

          $em = $this->getDoctrine()->getManager();

          $post = $em->getRepository($article)->find($id);

          $form = $this->createFormBuilder($post)

                      ->add('prenom', TextType::class,['attr' => [
                                  'placeholder' => "Notez le nom de votre ami",

                                  ] ])
                      ->add('Age',TextType::class,['attr' => [
                                  'placeholder' => "Notez l'age de votre ami.",

                                  ] ])
                      ->add('location',TextType::class,['attr' => [
                                  'placeholder' => "Notez le location de votre ami.",

                                  ] ])

                     ->getForm();

                     if($form->isSubmitted() && $form->isValid()){

                       $manager->persist($article);
                       $manager->flush();

                       return $this->redirectToRoute('article');
                     }

          $user = $this->getUser();
          $articleuser = $article->getUser();

        return $this->render('article/article.html.twig', [


            'articles' => $article,
            'articlesuser' => $articleuser,
            'user' => $user,

        ]);
    }

    /**
     * @Route("/articledelete/{id}", name="articledelete")
     */
    public function articledelete($id){
          $article = new Article();

          $em = $this->getDoctrine()->getManager();

          $post = $em->getRepository($article)->find($id);


          if($form->isSubmitted() && $form->isValid()){

            $em->remove($post);
            $em->flush();


            return $this->redirectToRoute('article');
          }

          $user = $this->getUser();
          $id = $user->getId();

          $articleuser = $article->getUser();

        return $this->render('article/article.html.twig', [


            'articles' => $article,
            'articlesuser' => $articleuser,
            'user' => $user,
            'id' => $id,

        ]);
    }
    /**
     * @Route("/commentregister/{id}", name="commentregister")
     */
    public function commentregister($id, Request $request, ObjectManager $manager)
    {

      $article = new Article();
      $comment = new Comment();
      $em = $this->getDoctrine()->getManager();

      $post = $em->getRepository($article)->find($id);



      $comment = $comment->setArticle($post);


      $form = $this->createForm(CommentRegisterType::class, $comment);

      $form->handleRequest($request);



      if($form->isSubmitted() && $form->isValid()){

        $manager->persist($comment);
        $manager->flush();

        return $this->redirectToRoute('article');
      }
        return $this->render('article/addcomment.html.twig', [

              'form' => $form->createView(),
              'user' => $user
        ]);
    }

}