<?php

namespace App\Form;

use App\Entity\SousCategorie;
use App\Entity\VideoUploade;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var VideoUploade|null $videoUploade */
        $builder
            ->add('urlVideo',FileType::class, [
        'mapped' => false,
        'required' => false,
        'constraints' => [
            new File([
                'maxSize' => '50M',
                ])
        ]

    ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VideoUploade::class,
        ]);
    }
    public function findSousCatsByComm(SousCategorieRepository $sousCategorieRepository, CategorieRepository $categorieRepository){
        $commun = $categorieRepository->findOneBy(['nomCat'=>'Communaute']);
        return $sousCategorieRepository->findBy(['idCat' => $commun]);
    }
}
