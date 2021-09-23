<?php

namespace App\Form;

use App\Entity\Kinds;
use App\Entity\Places;
use App\Entity\Artists;
use App\Entity\Publics;
use App\Entity\Festivals;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FestivalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', CKEditorType::class)
            ->add('price')
            ->add('duration')
            ->add('websiteLink')
            ->add('ticketOfficeLink')
            ->add('socialLink')
            ->add('tdg')
            ->add('dateStart', DateTimeType::class, [
                'widget'=>'single_text'
            ])
            ->add('dateEnd', DateTimeType::class, [
                'widget'=>'single_text'
            ])
            ->add('places', EntityType::class, [
                'class'=> Places::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
            ])
            ->add('kind', EntityType::class, [
                'class'=> Kinds::class,
                'choice_label' => 'name',
            ])
            ->add('public', EntityType::class, [
                'class'=> Publics::class,
                'choice_label' => 'types',
            ])
            ->add('artists', EntityType::class, [
                'class'=> Artists::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
            ])
            // On ajoute le champ "images" dans le formulaire
            // Il n'est pas lié à la base de données (mapped à false)
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Festivals::class,
        ]);
    }
}
