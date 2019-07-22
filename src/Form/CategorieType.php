<?php

namespace App\Form;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Entity\Categorie;
use App\Entity\Formateur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('nom',TextType::class)

            // TODO : CollectionType pour ajout de formateurs / modules
            ->add("formateurs", EntityType::class, [
                "class" => Formateur::class, 
                "choice_label"=> "nom",
                "required" => false
            ])
            // Collection type
            ->add('modules', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => ['label' => "Choisir module :", "class" => Module::class,],
                'allow_add' => true,
                'allow_delete' => true,
                "required" => false                
            ])

            ->add('formateurs', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => ['label' => "Choisir formateur :", "class" => Formateur::class,],
                'allow_add' => true,
                'allow_delete' => true,
                "required" => false                
            ])

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
