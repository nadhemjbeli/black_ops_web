<?php

namespace App\Controller;




use App\Entity\DetailsDefi;
use App\Repository\DefiRepository;
use App\Repository\DetailsDefiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClientMatchController extends AbstractController
{
    /**
     * @Route("/client/match", name="app_client_match")
     */
    public function index(DetailsDefiRepository $rep ,DefiRepository $res): Response
    {

        $matchs =$rep
            ->TopThree();
        $datedb = $rep->DateDataBase() ;
        $Upcoming = $rep->Upcoming() ;
        $Match_curent =$rep->Live();
        $defis = $res->findByThree();
        return $this->render('client_match/index.html.twig', [
            'matchs' => $matchs,
            'dbs' => $datedb,
            'ups' => $Upcoming,
            'live'=>$Match_curent,
            'defis' => $defis
        ]);
    }


}
