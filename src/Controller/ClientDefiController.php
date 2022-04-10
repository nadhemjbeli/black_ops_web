<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Repository\DefiRepository;
use App\Repository\DetailsDefiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientDefiController extends AbstractController
{
    /**
     * @Route("/client/defi", name="app_client_defi_all")
     */
    public function index(EntityManagerInterface $entityManager,DefiRepository $rep): Response
    {
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();
        return $this->render('client_defi/index.html.twig', [
            'defis' => $defis,
            'LastThree' => $LastThree,
        ]);
    }
    /**
     * @Route("/client/defi/{idDefi}", name="app_client_defi_detail")
     */
    public function detail( EntityManagerInterface $entityManager ,Defi $defi, DefiRepository $rep): Response
    {
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();
        return $this->render('client_defi/defi.html.twig',[
            'defi' => $defi,
            'defis'=> $defis,
            'lts' => $LastThree,
        ]);
    }

}
