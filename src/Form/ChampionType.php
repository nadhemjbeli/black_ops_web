<?php

namespace App\Form;

use App\Entity\Champion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChampionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomChamp')
            ->add('descriptionChamp')
            ->add('roleChamp')
            ->add('difficulteChamp')
            ->add('imageChamp',FileType::class,
                array('data_class' => null,
                'multiple'=>false,
                'required'=>true))
            ->add('idJeu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Champion::class,
        ]);
    }
}
