<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Image;
use App\Entity\Joueur;
use App\Form\EquipeType;
use App\Repository\DefiRepository;
use App\Repository\DetailsDefiRepository;
use App\Repository\EquipeRepository;
use App\Repository\ImageRepository;
use App\Repository\JoueurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientEquipeController extends AbstractController
{
    /**
     * @Route("/client/equipe", name="app_client_equipe")
     */
    public function index(EntityManagerInterface $entityManager,ImageRepository $rep,JoueurRepository $repj,DetailsDefiRepository $rep1 ,DefiRepository $res): Response
    {
        $equipes = $entityManager->getRepository(Equipe::class)->findAll();
        $ima = $rep->findAll();
        $js = $repj->findAll();

        $matchs =$rep1
            ->TopThree();
        $datedb = $rep1->DateDataBase() ;
        $Upcoming = $rep1->Upcoming() ;
        $Match_curent =$rep1->Live();
        $defis = $res->findByThree();


        return $this->render('client_equipe/index.html.twig', [
            'equipes' => $equipes,
            'im'=>$ima,
            'js' => $js,
            'matchs' => $matchs,
            'dbs' => $datedb,
            'ups' => $Upcoming,
            'live'=>$Match_curent,
            'defis' => $defis

        ]);
    }
    /**
     * @Route("/client/equipe/add", name="app_client_equipe_add")
     */
    public function add(EntityManagerInterface $entityManager,Request $request): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file =$equipe->getLogoEquipe();
            $fileName =$form->getData().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('equipe_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $equipe ->setLogoEquipe($fileName);
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_equipe', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('client_equipe/add.html.twig', [
            'equipe' => $equipe,
            'formA' => $form->createView(),
        ]);

    }
}
