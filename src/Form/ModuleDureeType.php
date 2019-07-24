<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\DureeModule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ModuleDureeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('module',EntityType::class, [
            "class"=> Module::class, 
            "label" => 'Module:',
        ])
        ->add('duree', IntegerType::class, [
            "label" => "Dureé du module (en jours) :"
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DureeModule::class,
        ]);
    }
}
