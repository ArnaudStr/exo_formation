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
            ->add('nom',TextType::class)
            ->add("formateurs", EntityType::class, [
                "class"=>Formateur::class, 
                "query_builder"=> function(FormateurRepository $er){
                    return $er->createQueryBuilder("f")->orderBy("f.nom", "ASC");
                }, 
                "choice_label"=> function($formateur){
                    return($formateur); 
                }
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
