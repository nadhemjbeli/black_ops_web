<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontRechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="app_front_recherche")
     */
    public function index(EntityManagerInterface $em): Response
    {
        if ( (isset($_GET['recherche'])) && ($_GET['recherche'] != null)) {
            $query = $em->createQuery('SELECT p from App\Entity\ReplayStream p where p.nomReplay LIKE :nom')
                ->setParameter('nom', '%'.$_GET['recherche'].'%');
            $replay = $query->getResult();

            $query2 = $em->createQuery('SELECT i from App\Entity\StreamInfo i where i.nomStream LIKE :nom')
                ->setParameter('nom', '%'.$_GET['recherche'].'%');
            $info = $query2->getResult();
            $rech = $_GET['recherche'];
            if ($replay != null || $info != null) {

                return $this->render('Front/Recherche.html.twig', [
                    'replays' => $replay, 'infos' => $info, "rech" => $rech

                ]);


            } else {
                return $this->render('Front/Recherche.html.twig', [
                    'replays' => $replay, 'infos' => $info, "rech" => $rech

                ]);

            }
        }else {

           return $this->redirectToRoute("app_front_accueil");
        }

    }
}
