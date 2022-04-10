<?php

namespace App\Controller;

use App\Entity\Champion;
use App\Entity\Image;
use App\Entity\Jeu;
use App\Entity\Skin;
use App\Repository\ChampionRepository;
use App\Repository\ImageRepository;
use App\Repository\SkinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientjeuController extends AbstractController
{
    /**
     * @Route("/clientjeu", name="app_clientjeu")
     */
    public function index(ChampionRepository $repository,SkinRepository $repskin,ImageRepository $repimg): Response
    {
        $images1 =$repimg->firstimgbyjeu();
        $champions=$repository->top3recent();
        $skins = $repskin->toprecent();
        return $this->render('clientjeu/index.html.twig', [

            'images'=>$images1,
            'champions3'=>$champions,
            'skins'=>$skins,


            ]);
    }

    /**
     * @Route("/product/{id}/{idimg}", name="showgame")
     */
public function show($id,$idimg)
{//prepare the manager
    $allimg=$this->getDoctrine()->getRepository(Image::class)->findBy(['idJeu'=>$id]);
        $jeudetails=$this->getDoctrine()->getRepository(Jeu::class)->find($id);
        $imagedetails=$this->getDoctrine()->getRepository(Image::class)->find($idimg);
        $champions=$this->getDoctrine()->getRepository(Champion::class)->findBy(['idJeu'=>$id]);

        return $this->render('clientjeu/show.html.twig', [
        'jeuDetails'=>$jeudetails,
            'imagedetails'=>$imagedetails,
            'Relatedchampions'=>$champions,
            'allimg'=>$allimg
]);
}
    /**
     * @Route("/product/{idchamp}", name="showchamps")
     */
public function showChamp($idchamp ,ChampionRepository $repchamp)
{   $champion=$this->getDoctrine()->getRepository(Champion::class)->find($idchamp);
    $allimg2=$this->getDoctrine()->getRepository(Skin::class)->findBy(['idChamp'=>$idchamp]);
    $relatedrole=$repchamp->championSameRole($champion->getRoleChamp(),$champion->getIdJeu());
    $relateddiffuculty=$repchamp->championSameDifficulty($champion->getDifficulteChamp(),$champion->getIdJeu());
    return $this->render('clientjeu/ShowChamp.html.twig', [
        'championDetails'=>$champion,
        'allimg2'=>$allimg2,
        'Relatedrole'=>$relatedrole,
        'relateddiffuculty'=>$relateddiffuculty
    ]);

}

}
