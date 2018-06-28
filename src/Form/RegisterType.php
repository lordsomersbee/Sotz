<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ] 
            ))
            ->add('lastname', TextType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ] 
            ))
            ->add('username', TextType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ] 
            ))
            ->add('email', EmailType::class, array(
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ] 
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => true,
                'options' => array('attr' => array(
                    'class' => 'form-control')),   
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
