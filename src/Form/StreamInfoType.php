<?php

namespace App\Form;

use App\Entity\StreamInfo;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;

class StreamInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStream',null,array('label'=>'Nom','attr'=>['placeholder'=> 'Nom Stream'], 'required' => false))
            /*->add('Image Stream',FileType::class, array(
                'data_class' => null,
                'label'=>'Image'
            ))*/

            ->add('descriptionStream',null,array('label'=>'Description','attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 7000,'placeholder'=> 'Description Stream']))
            ->add('idSouscat',null,array('label'=>'Sous Catégorie'))
           -> add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptcha'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StreamInfo::class,
        ]);
    }
}
