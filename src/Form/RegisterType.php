<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ] 
            ))
            ->add('lastname', TextType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ] 
            ))
            ->add('email', EmailType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ] 
            ))
            ->add('password', RepeatedType::class, array(
                'required' => true,
                'options' => array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Password')),   
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
        ;
    }
}
