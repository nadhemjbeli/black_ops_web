<?php

namespace App\Controller;

use App\Entity\LiveStream;
use App\Form\StreamLiveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiveStreamController extends AbstractController
{
    /**
     * @Route("/livestream", name="app_live_stream")
     */
    public function index(): Response
    {
        $livestream = $this -> getDoctrine()->getRepository(LiveStream::class)->findAll();
        //dd($livestream);
        return $this->render('Back/AfficherLiveStream.html.twig', [
            'controller_name' => 'LiveStreamController',
            'livestreams'=>$livestream
        ]);
    }



    /**
     * @Route ("/livestream/Ajouter" ,name="app_live_stream_Ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em){
        $li = new LiveStream();
        $form = $this->createForm(StreamLiveType::class, $li);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $em->persist($li);
            $em->flush();

            $this->addFlash('success', 'Bien Ajouter avec succès!');
            return $this->redirectToRoute('app_live_stream');
        }
        return $this->render("back/AjouterLiveStream.html.twig", [
            'li' => $li,
            'form' => $form -> createView()

        ]);
    }


    /**
     * @Route ("/livestream/Modifier_{id}" ,name="app_live_stream_modifier")
     */
    public function modifier(LiveStream $li,Request $request, EntityManagerInterface $em){

        $form = $this->createForm(StreamLiveType::class, $li);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {




            $em->flush();

            $this->addFlash('success', 'Bien Ajouter avec succès!');
            return $this->redirectToRoute('app_live_stream');
        }
        return $this->render("back/ModifierLiveStream.html.twig", [
            'li' => $li,
            'form' => $form -> createView()

        ]);
    }


    /**
     * @Route ("/livestream/Supprimer_{id}" ,name="app_live_stream_supprimer")
     */
    public function supprimer(LiveStream $li, EntityManagerInterface $em){

        $em->remove($li);
        $em->flush();
        $this->addFlash('success', 'Bien Supprimé avec succès!');

//return new Response('Suppression');
        return $this->redirectToRoute('app_live_stream');
    }


}
