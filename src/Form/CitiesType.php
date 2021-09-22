<?php

namespace App\Form;

use App\Entity\Cities;
use App\Entity\Departments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameUppercase')
            ->add('nameSimple')
            ->add('nameReal')
            ->add('zip')
            ->add('longitudeDeg')
            ->add('latitudeDeg')
            //->add('department')
            ->add('department', EntityType::class, [
                'class' => Departments::class,
                 'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cities::class,
        ]);
    }
}
