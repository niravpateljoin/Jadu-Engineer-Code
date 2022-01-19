<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PangramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pangram', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter text for pangram',
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
