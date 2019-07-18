<?php

namespace App\Form;

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

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            // ->add("formateurs", EntityType::class, [
            //     "class"=>Formateur::class, 
            //     "query_builder"=> function(EntityRepository $er){
            //         return $er->createQueryBuilder("f")->orderBy("f.nom", "ASC");
            //     }, 
            //     "choice_label"=> "nom"
            // ])
            // ->add("modules", EntityType::class, [
            //     "class"=>ModuleType::class, 
            //     "query_builder"=> function(EntityRepository $er){
            //         return $er->createQueryBuilder("m")->orderBy("m.nom", "ASC");
            //     }, 
            //     "choice_label"=> "nom"
                
            // ])
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
