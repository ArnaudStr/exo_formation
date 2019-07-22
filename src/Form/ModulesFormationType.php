<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Categorie;
use App\Entity\Formation;
use App\Entity\DureeModule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ModulesFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('duree',IntegerType::class)
            // Collection type
            ->add("formation", EntityType::class, [
                "class"=>Formation::class, 
                "choice_label" => 'nom'
            ])

            ->add("module", EntityType::class, [
                "class"=>Module::class, 
                "choice_label" => 'nom'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        
        $resolver->setDefaults([
            'data_class' => DureeModule::class,
        ]);
    }
}
