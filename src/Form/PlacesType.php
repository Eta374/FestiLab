<?php

namespace App\Form;

use App\Entity\Cities;
use App\Entity\Festivals;
use App\Entity\Places;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            // ->add('citie')
            ->add('citie', EntityType::class, [
                'class' => Cities::class,
                'choice_label' => 'nameReal',
            ])
        
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Places::class,
        ]);
    }
}
