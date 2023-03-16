<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormjeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nombre',NumberType::class,

        [
            'label' => "Deviner un nombre enre 0 et 100",
            'required' => true,
            'constraints' =>
                [ 
                    new Range([
                    'min' => 0,
                    'max' => 100,
                'notInRangeMessage' => 
                'Vous devez insérer un nombre entre {{ min }} et {{ max }}',
            ])
            ]
        ])

        ->add('jouer',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
