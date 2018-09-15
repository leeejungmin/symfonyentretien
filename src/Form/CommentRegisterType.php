<?php

namespace App\Form;

use App\Entity\Comment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CommentRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    //   $date=new \DateTime();
      $t=time();
    // $dat =  $date->format('Y-m-d H:i:s');
      $time=date("Y-m-d G:i:s",$t);
    //
        $builder
            // ->add('creatat', HiddenType::class)
            ->add('creatat',   array('data' => $time ))
            ->add('author', TextType::class)
            ->add('content', TextareaType::class)


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
