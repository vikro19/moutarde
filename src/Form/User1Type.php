<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class, 
                'invalid_message'=>'mot de passe doit etre identique',
                'options'=>[
                    'attr'=>[
                        'always_empty'=>true,
                    ],
                ],
                'required'=>false,
                'first_options'=>[
                    'label'=>'ton mot de passe',

                ],
                'second_options'=>[
                    'label'=>'confirmer mot de passe',

                ],
                'constraints'=>[
                    new Length([
                        'min'=> 6,
                        'minMessage'=>'mot de passe doit comprendre un minimum de {{limit}} caractère',
                        'max'=> 4096 
                    ])
                ]
            ])
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
