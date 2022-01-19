<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PalindromeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('palindrome', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter text for palindrome',
                ],
                'required' => false,
                'label' => false,
            ])
            ->add('check', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success mt-3'
                ]
            ])
        ;
    }
}
