<?php

namespace App\Controller;

use App\Entity\Champion;
use App\Entity\Image;
use App\Entity\Jeu;
use App\Entity\Skin;
use App\Repository\ChampionRepository;
use App\Repository\ImageRepository;
use App\Repository\JeuRepository;
use App\Repository\SkinRepository;


use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClientjeuController extends AbstractController
{
    /**
     * @Route("/clientjeu", name="app_clientjeu")
     */
    public function index(ChampionRepository $repository,SkinRepository $repskin,ImageRepository $repimg, PaginatorInterface $page,Request $request ): Response
    {
        $images1 =$repimg->firstimgbyjeu();
        $article =$page->paginate(
            $images1,
            $request->query->getInt('page',1),1


        );
        $champions=$repository->top3recent();
        $skins = $repskin->toprecent();
        return $this->render('clientjeu/index.html.twig', [

            'images'=>$article,
            'champions3'=>$champions,
            'skins'=>$skins,


            ]);
    }

    /**
     * @Route("/product/{id}/{idimg}", name="showgame")
     */
public function show($id,$idimg,SkinRepository $repskin ,Request $request , PaginatorInterface $page)
{//prepare the manager
    $skins= array();


    $allimg=$this->getDoctrine()->getRepository(Image::class)->findBy(['idJeu'=>$id]);
        $jeudetails=$this->getDoctrine()->getRepository(Jeu::class)->find($id);
        $imagedetails=$this->getDoctrine()->getRepository(Image::class)->find($idimg);
        $champions=$this->getDoctrine()->getRepository(Champion::class)->findBy(['idJeu'=>$id]);

    $article =$page->paginate(
        $champions,
        $request->query->getInt('page',1),3


    );
        foreach($champions as $champion) {


            $ab = $repskin->Relatedskins($champion->getIdChamp());

            if ($ab) {
                array_push($skins, $ab);


            }


        }
    $article2 =$page->paginate(
        $skins,
        $request->query->getInt('page',1),1


    );




        return $this->render('clientjeu/show.html.twig', [
        'jeuDetails'=>$jeudetails,
            'imagedetails'=>$imagedetails,
            'Relatedchampions'=>$article,
            'allimg'=>$allimg,
            'skins'=>$article2

]);
}
    /**
     * @Route("/product/{idchamp}", name="showchamps")
     */
public function showChamp($idchamp ,ChampionRepository $repchamp,Request $request , PaginatorInterface $page)
{   $champion=$this->getDoctrine()->getRepository(Champion::class)->find($idchamp);
    $allimg2=$this->getDoctrine()->getRepository(Skin::class)->findBy(['idChamp'=>$idchamp]);
    $relatedrole=$repchamp->championSameRole($champion->getRoleChamp(),$champion->getIdJeu());
    $article =$page->paginate(
        $relatedrole,
        $request->query->getInt('page',1),2


    );
    $relateddiffuculty=$repchamp->championSameDifficulty($champion->getDifficulteChamp(),$champion->getIdJeu());
    $article2 =$page->paginate(
        $relateddiffuculty,
        $request->query->getInt('page',1),2


    );
    return $this->render('clientjeu/ShowChamp.html.twig', [
        'championDetails'=>$champion,
        'allimg2'=>$allimg2,
        'Relatedrole'=>$article,
        'relateddiffuculty'=>$article2
    ]);

}


}
