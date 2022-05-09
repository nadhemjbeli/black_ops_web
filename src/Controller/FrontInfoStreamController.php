<?php

namespace App\Controller;

use App\Entity\StreamInfo;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontInfoStreamController extends AbstractController
{
    /**
     * @Route("/information_stream", name="app_front_info_stream")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $this->getDoctrine() ->getRepository(StreamInfo::class)->findAll();
        $infos = $paginator ->paginate($donnees,$request->query->getInt('page',1),5);
        return $this->render('Front/InfoStream.html.twig', [
            'controller_name' => 'FrontInfoStreamController',
            "current_menu" => 'details',
            "infos" => $infos
        ]);
    }
}
