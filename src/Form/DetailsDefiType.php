<?php

namespace App\Form;

use App\Entity\DetailsDefi;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsDefiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imgscore',FileType::class, array('data_class' => null ,
            'label' => 'Selectionnez image du score final'))
            ->add('scoreFinale')
            ->add('equipeb')
            ->add('equipea')
            ->add('idDefi')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailsDefi::class,
        ]);
    }
}
