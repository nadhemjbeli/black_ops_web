<?php

namespace App\Controller;


use App\Entity\Defi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class FrontAccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_front_accueil")
     */
    public function index(): Response
    {
 $em = $this->getDoctrine()->getManager();
 $query = $em -> createQuery('SELECT p from App\Entity\Defi p ')
     -> setMaxResults(3);
     $defi = $query -> getResult();
        $query2 = $em -> createQuery('SELECT r from App\Entity\ReplayStream r ')
            -> setMaxResults(4);
        $replay = $query2 -> getResult();
return $this->render("Front/Accueil.html.twig",[
    'defi'=> $defi,"replay"=>$replay]);

    }
}