<?php

namespace App\Form;

use App\Entity\VideoUploade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoUploadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomVideo')
//            ->add('dateVideo')
            ->add('descriptionVideo')
            ->add('urlVideo')
            ->add('idSouscat')
            ->add('idCl')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VideoUploade::class,
        ]);
    }
}
