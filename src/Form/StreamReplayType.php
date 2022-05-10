<?php

namespace App\Form;

use App\Entity\ReplayStream;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamReplayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomReplay',null,[
                'required'=>false,
                'attr'=>['placeholder'=> 'Nom Replay Stream']
            ])

            ->add('descriptionReplay',null,[


                'attr'=>['placeholder'=> 'Description Replay Stream']
            ])

            ->add('idSouscat',null,[
                'label'=>'Sous Catégorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReplayStream::class,
        ]);
    }
}
