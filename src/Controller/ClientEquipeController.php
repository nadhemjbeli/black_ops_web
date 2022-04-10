<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Jeu;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientEquipeController extends AbstractController
{
    /**
     * @Route("/client/equipe", name="app_client_equipe")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {

        $equipes = $entityManager->getRepository(Equipe::class)->findAll();



        return $this->render('client_equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }
}
