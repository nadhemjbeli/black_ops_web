<?php

namespace App\Controller;

use App\Entity\ReplayStream;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontReplayStreamController extends AbstractController
{
    /**
     * @Route("/replay_streaming", name="app_front_replay_stream")
     */
    public function index(): Response
    {

        $replays = $this->getDoctrine() -> getRepository(ReplayStream::class) ->findAll();
        return $this->render('Front/ReplayStream.html.twig', [
            "replays" => $replays
        ]);
    }

    /**
     * @Route ("/replay_streaming_voir_{id}" , name ="app_front_replay_stream_voir")
     */
    public function voir($id, EntityManagerInterface $em): Response
    {
        $verif = $this->getDoctrine()->getRepository(ReplayStream::class)->find($id);

        if ($verif) {

        $vues = $verif->getVuesReplay() + 1;
        $verif->setVuesReplay($vues);
        $em->flush();
        $sug = $this->find($id, $em);
        return $this->render("Front/VoirReplayStream.html.twig", [
            'rs' => $verif, 'sugs' => $sug,
        ]);
    }else {
        return $this->redirectToRoute("app_front_replay_stream");

        }
    }

    function find($id, EntityManagerInterface $em){
    $query = $em -> createQuery('SELECT p from App\Entity\ReplayStream p where p.idReplay!=:id')
           ->setParameter('id',$id)
    -> setMaxResults(3);
       return $query->getResult();


    }
}
