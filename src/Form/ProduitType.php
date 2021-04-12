<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_produit', TextType::class)
            ->add('marque', TextType::class)
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('prix')
            // ->add('categorie', EntityType::class, [
            //     'class'=>Categorie::class,
            //     'choice_label'=>'nom'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
