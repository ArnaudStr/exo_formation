<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Stagiaire;
use App\Form\FormationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add('sexe',ChoiceType::class, ["choices"=>["Homme"=>"H", "Femme"=>"F"], "expanded"=>true])
        ->add('dateNaissance',DateType::class, [
            "years"=>range(date("Y")-7, date("Y")-77),
            "label"=>"Date de naissance",
            "format"=>"ddMMMMyyyy"
        ])
        ->add('ville',TextType::class, ["required" => false])
        ->add('email',TextType::class)
        ->add('telephone',TextType::class)
        // Collection type
        // ->add("formations", EntityType::class, [
        //     "class" => Formation::class,
        //     "choice_label" => "nom",
        //     "required" => false                
        // ])
        ->add('formations', CollectionType::class, [
            // "mapped" => false,
            // "class" => Stagiaire::class, 
            'entry_type' => FormationType::class, 
            'entry_options' => [
                // 'class' => Formation::class,
                'label' => false,
            ],
            'allow_add' => true,
            'allow_delete' => true,
            "required" => false,
            'by_reference' => false,
        ])  
        ->add('Valider', SubmitType::class)
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
