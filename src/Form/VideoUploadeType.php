<?php

namespace App\Form;

use App\Entity\VideoUploade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoUploadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var VideoUploade|null $videoUploade */
        $article = $options['data'] ?? null;
        $builder
            ->add('nomVideo')
//            ->add('dateVideo')
            ->add('descriptionVideo')
            ->add('urlVideo',FileType::class, [
        'mapped' => false,
        'required' => false,
//        'constraints' => $imageConstraints

    ])
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
