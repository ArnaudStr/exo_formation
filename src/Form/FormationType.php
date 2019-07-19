<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('date_debut',DateType::class, [
                "years"=>range(date("Y"), date("Y")+10),
                "label"=>"Date de naissance",
                "format"=>"ddMMMMyyyy"
            ])
            ->add('dateFin', DateType::class, [
                "years"=>range(date("Y"), date("Y")+10),
                "label"=>"Date de naissance",
                "format"=>"ddMMMMyyyy"
            ])
            ->add("nbPlaces", IntegerType::class, [
                'attr' => [
                    "min" => 1,
                    "max" => 100,
                    "label" => "Nombre de places" ]
            ])
            // ->add("modules",  )
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
