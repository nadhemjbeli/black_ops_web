<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Entity\User;
use App\Form\JoueurType;
use App\Repository\DefiRepository;
use App\Repository\DetailsDefiRepository;
use App\Repository\JoueurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientJoueurController extends AbstractController
{
    /**
     * @Route("/client/joueur", name="app_client_joueur")
     */
    public function index(): Response
    {
        return $this->render('client_joueur/index.html.twig', [

        ]);
    }
    /**
     * @Route("/client/joueur/new", name="app_client_joueur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,UserRepository $rep,JoueurRepository $res): Response
    {

        $username=$this->getUser()->getUsername();

        /** @var User $user */
        $user = $rep->findOneBy(['username'=>$username]);
        $us =$res->Verify($user->getIdUser());

//        if($us){
//            $jr = $res->findOneBy(['idUser'=>$user]);
//            $joueurs = $res->findBy(['idEquipe'=>$jr->getIdEquipe()]);
//            return $this->redirectToRoute('app_client_equipe', [
//                'joueursParEquipe'=>$joueurs
//            ], Response::HTTP_SEE_OTHER);
//        }
        if($us!=null){
            return $this->redirectToRoute('app_client_equipe', [], Response::HTTP_SEE_OTHER);
        }

        $joueur = new Joueur();
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $joueur->setIdUser($user);
            $entityManager->persist($joueur);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_equipe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client_joueur/index.html.twig', [
            'joueur' => $joueur,
            'formA' => $form->createView(),
        ]);
    }

    /**
     * @Route("/client/joueur/{idJoueur}", name="app_client_joueur_show", methods={"GET"})
     */
    public function show(Joueur $joueur,DetailsDefiRepository $rep ,DefiRepository $res): Response
    {
        $matchs =$rep
            ->TopThree();
        $datedb = $rep->DateDataBase() ;
        $Upcoming = $rep->Upcoming() ;
        $Match_curent =$rep->Live();
        $defis = $res->findByThree();

        return $this->render('client_joueur/JoueurProfile.html.twig', [
            'joueur' => $joueur,
            'matchs' => $matchs,
            'dbs' => $datedb,
            'ups' => $Upcoming,
            'live'=>$Match_curent,
            'defis' => $defis
        ]);
    }
}
