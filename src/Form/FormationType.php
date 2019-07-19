<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('date_debut',DateType::class, [
                "years"=>range(date("Y"), date("Y")+10),
                "label"=>"Date de début",
                "format"=>"ddMMMMyyyy"
            ])
            ->add('dateFin', DateType::class, [
                "years"=>range(date("Y"), date("Y")+10),
                "label"=>"Date de fin",
                "format"=>"ddMMMMyyyy"
            ])
            ->add("nbPlaces", IntegerType::class, [
                'attr' => [
                    "min" => 1,
                    "max" => 100,
                    "label" => "Nombre de places" ]
            ])
            // Collection type
            // ->add("modules", EntityType::class, [
            //     "class" => Module::class, 
            //     "choice_label"=> "nom",
            //     "required" => false
            // ])

            // ->add("modules", CollectionType::class, [
            //     "entry_type" => Module::class, 
            //     'entry_options' => ['label' => false],
            //     "required" => false
            // ])

            // Collection type
            ->add("stagiaires", CollectionType::class, [
                // "mapped" => false
                // "class" => Stagiaire::class, 
                "entry_type" => Stagiaire::class, 
                'entry_options' => [
                    'label' => 'Stagiaire',
                ],
                'allow_add' => true,
                'allow_delete' => true,
                "required" => false
            ])  

            // ->add("stagiaires", CollectionType::class, [
            //     "entry_type" => Module::class, 
            //     'entry_options' => ['label' => false],
            //     'allow_add' => true,
            //     "required" => false
            // ])

            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
