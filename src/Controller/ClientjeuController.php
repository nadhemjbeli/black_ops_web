<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Champion;
use App\Entity\Image;
use App\Entity\Jeu;
use App\Entity\Skin;
use App\Entity\User;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use App\Repository\ChampionRepository;
use App\Repository\ImageRepository;
use App\Repository\JeuRepository;
use App\Repository\SkinRepository;


use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        if ($request->isMethod("POST")) {
            $nom = $request->get('jeu');
            $images1=$repimg->searchGame($nom);
        }
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
public function show($id,$idimg,SkinRepository $repskin ,Request $request , PaginatorInterface $page , UserRepository $repuser,Jeu $jeux,EntityManagerInterface $entityManager,ChampionRepository $repchamp)
{//prepare the manager
    $skins= array();


    $allimg=$this->getDoctrine()->getRepository(Image::class)->findBy(['idJeu'=>$id]);
        $jeudetails=$this->getDoctrine()->getRepository(Jeu::class)->find($id);
        $imagedetails=$this->getDoctrine()->getRepository(Image::class)->find($idimg);
        $champions=$this->getDoctrine()->getRepository(Champion::class)->findBy(['idJeu'=>$id]);
    if ($request->isMethod("POST")) {
        $nom = $request->get('champion');
        $champions=$repchamp->search($nom,$id);
    }

    $article =$page->paginate(
        $champions,
        $request->query->getInt('page',1),3


    );
        $skins=$repskin->allskins($id);

    if ($request->isMethod("POST")) {
        $nom = $request->get('skin');
        $skins=$repskin->searchSkin($nom,$id);
    }


//        foreach($champions as $champion) {
//
//
//            $ab = $repskin->Relatedskins($champion->getIdChamp());
//
//            if ($ab) {
//                array_push($skins, $ab);
////
//
//            }
//
//
//        }

    $article2 =$page->paginate(
        $skins,
        $request->query->getInt('page',1),6


    );

    $abonnement=new Abonnement();
    $username=$this->getUser()->getUsername();
    /** @var User $user */
    $users = $repuser->findOneBy(['username'=>$username]);




    $form = $this->createForm(AbonnementType::class, $abonnement);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $abonnement->setIdJeu($jeux);


        $abonnement->setIdUser($users);

        $entityManager->persist($abonnement);
        $entityManager->flush();

    }

        return $this->render('clientjeu/show.html.twig', [
        'jeuDetails'=>$jeudetails,
            'imagedetails'=>$imagedetails,
            'Relatedchampions'=>$article,
            'allimg'=>$allimg,
            'skins'=>$article2,
            'form' => $form->createView(),
            'abonnement'=>$abonnement

]);
}
    /**
     * @Route("/product/{idchamp}", name="showchamps")
     */
public function showChamp($idchamp ,ChampionRepository $repchamp,Request $request , PaginatorInterface $page)
{   $champion=$this->getDoctrine()->getRepository(Champion::class)->find($idchamp);
    $allimg2=$this->getDoctrine()->getRepository(Skin::class)->findBy(['idChamp'=>$idchamp]);
    $relatedrole=$repchamp->championSameRole($champion->getRoleChamp(),$champion->getIdJeu());
    if ($request->isMethod("POST")) {

        $nom = $request->get('role');

        $relatedrole=$repchamp->searchbyrole($champion->getRoleChamp(),$champion->getIdJeu(),$nom);
    }
    $article =$page->paginate(
        $relatedrole,
        $request->query->getInt('page',1),2


    );

    $relateddiffuculty=$repchamp->championSameDifficulty($champion->getDifficulteChamp(),$champion->getIdJeu());
    if ($request->isMethod("POST")) {

        $nom = $request->get('diff');

        $relateddiffuculty=$repchamp->searchbydiff($champion->getDifficulteChamp(),$champion->getIdJeu(),$nom);
    }
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
//    /**
//     * @Route("/clientjeu/abonner/{id}", name="abonner",methods={"GET", "POST"})
//     */
//    function abonner(Jeu $jeux,UserRepository $repuser ,$id,Request $request,EntityManagerInterface $entityManager,ImageRepository $repimg, PaginatorInterface $page,ChampionRepository $repository,SkinRepository $repskin)
//    {
//        $images1 =$repimg->firstimgbyjeu();
//        $article =$page->paginate(
//            $images1,
//            $request->query->getInt('page',1),1
//
//
//        );
//        $champions=$repository->top3recent();
//        $skins = $repskin->toprecent();
//        $abonnement=new Abonnement();
//        $username=$this->getUser()->getUsername();
//
//        $images1 =$repimg->firstimgbyjeu();
//        $article =$page->paginate(
//            $images1,
//            $request->query->getInt('page',1),1
//
//
//        );
//        /** @var User $user */
//        $users = $repuser->findOneBy(['username'=>$username]);
//
//
//
//
//        $form = $this->createForm(AbonnementType::class, $abonnement);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $abonnement->setIdJeu($jeux);
//
//
//            $abonnement->setIdUser($users);
//
//            $entityManager->persist($abonnement);
//            $entityManager->flush();
//
//
//
//        }
//
//        return $this->render('clientjeu/index.html.twig', [
//            'abonnement' => $abonnement,
//            'form' => $form->createView(),
//            'images'=>$article,
//            'champions3'=>$champions,
//            'skins'=>$skins,
//        ]);
//    }
    /**
     * @Route("/product/{idchamp}/", name="desabonner",methods={"GET", "POST"})
     */
    function desabonner(ChampionRepository $repchamp,$idchamp,AbonnementRepository $repabon,UserRepository $repuser ,Request $request,EntityManagerInterface $entityManager,ImageRepository $repimg, PaginatorInterface $page,ChampionRepository $repository,SkinRepository $repskin)
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


        $username=$this->getUser()->getUsername();
        /** @var User $user */

        $users = $repuser->findOneBy(['username'=>$username]);

       $iduser=$users->getIdUser();
       $champion4=$repchamp->findgame($idchamp);

        foreach ($champion4 as $champ) {
            $abonnement = $repabon->findabonnement($iduser, $champ->getidJeu());




        foreach ($abonnement as $abonn) {

            if ($this->isCsrfTokenValid('unfollow', $request->request->get('_token'))) {


                $entityManager->remove($abonn);
                $entityManager->flush();

            }
        }}
        return $this->render('clientjeu/ShowChamp.html.twig', [

            'championDetails'=>$champion,
            'allimg2'=>$allimg2,
            'Relatedrole'=>$article,
            'relateddiffuculty'=>$article2

            ]);

}
//    /**
//     * @Route("/product/{id}/{idimg}", name="showgame", methods={"GET", "POST"})
//     */
//
//    public function search(Request $request , JeuRepository $repjeu)
//    {
//        $em=$this->getDoctrine()->getManager();
//        $jeu=$em->getRepository(Jeu::class)->findAll();
//        if ($request->isMethod("POST")) {
//            $nom = $request->get('nom');
//            $jeu = $repjeu->search($nom);
//        }
//        return $this->render('admin_jeu/index.html.twig', [
//            'jeus' => $jeu,
//        ]);
//
//    }


}
