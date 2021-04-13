<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bancs')
            ->add('barres_et_disques')
            ->add('halteres_et_poids')
            ->add('tapis_de_course')
            ->add('steppers')
            ->add('balles_et_ballons_gym')
            ->add('corde_a_sauter')
            ->add('tapis_de_gym')
            ->add('autres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
