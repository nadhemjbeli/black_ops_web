<?php

namespace App\Form;

use App\Entity\Defi;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DefiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomDefi')
            ->add('descriptionDefi')
            ->add('imgDefi', FileType::class, array('data_class' => null ,
                'label' => 'Selectionnez image du defi',
                'required'   => false,

                    )
            )

            ->add('prixDefi')

            ->add('nbrEquipeDefi')
            ->add('regleDefi')
            ->add('recompenseDefi')
            ->add('jeuDefi')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Defi::class,
        ]);
    }
}
