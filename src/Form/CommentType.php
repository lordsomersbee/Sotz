<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Type here...'
                ]              
            ))
            ->add('save', SubmitType::class, array(
                'label' => "Add Comment",
                'attr' => [
                    'class' => 'form-control'
                ]         
            ))
        ;
    }
}