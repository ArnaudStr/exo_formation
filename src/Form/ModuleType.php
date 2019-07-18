<?php

namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)

            // Ajout des formations au module, utilisation d'entity type
            // ->add("formations", EntityType::class, [
            //     "class"=>Formation::class, 
            //     "query_builder"=> function(FormationRepository $er){
            //         return $er->createQueryBuilder("f")->orderBy("f.nom", "ASC");
            //     }, 
            //     "choice_label"=> function($formation){
            //         return($formation);
            //     }
            // ])

            // Ajout de la catégorie au module
            ->add("categorie", EntityType::class, [
                "class"=>Categorie::class, 
                "choice_label" => 'nom'
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
