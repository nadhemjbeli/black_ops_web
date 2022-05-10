<?php

namespace App\Form;

use App\Entity\LiveStream;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamLiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomLivestream',null,[
                'required'=>false,
                'attr'=>['placeholder'=> 'Nom Live Stream']
            ])
            ->add('pathLivestream',null,['label' => 'Id stream',
                'attr'=>['placeholder'=> 'Id Unique Live Stream From Youtube']
            ])
            ->add('visibiliteLivestream',ChoiceType::class,[
                'choices' => array ('Dans quelques minutes' => 'Afficher', 'Live' => 'En Cours','Masquer' => 'Masquer')
            ])
            ->add('idDefi',null,[
                'label' =>'Defi'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LiveStream::class,
        ]);
    }
}
