<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Defi;
use App\Entity\LiveStream;

use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use mofodojodino\ProfanityFilter\Check;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Vangrg\ProfanityBundle\Entity\Profanity;

class FrontLiveStreamController extends AbstractController
{

    /**
     * @Route("/live_streaming", name="app_front_live_stream")
     */
    public function index(FlashyNotifier $flashy): Response
    {

$live = $this->getDoctrine() ->getRepository(LiveStream::class)->findBy(['visibiliteLivestream' => ["En cours","Afficher"]]);
$defi = $this->getDoctrine() ->getRepository(Defi::class)->findAll();


        $flashy->success('"Bienvenu Dans le Live Stream!','#');
        return $this->render('Front/LiveStream.html.twig', [

            "current_menu" => 'details',
            "lives" => $live,'defis'=>$defi
        ]);
    }

    /**
     * @Route ("/Live_Streaming_voir{ID}",name="app_front_live_stream_voir")
     */
    public function live($ID){
        $lives = $this->getDoctrine()->getRepository(LiveStream::class) ->findBY(['idLivestream'=>$ID,'visibiliteLivestream'=>'En cours']);
        if ($lives) {
            $live = $this->getDoctrine()->getRepository(LiveStream::class) ->find($ID);

            return $this->render("Front/VoirLiveStream.html.twig", ['live' => $live,
                'id' => $ID

            ]);
        }else {

            return $this->redirectToRoute('app_front_live_stream');
        }
    }



    /**
     * @Route("/student/ajax")
     */
    public function ajaxAction(Request $request, FlashyNotifier $flashy) {
$commentaire = new Commentaire();
$livestream = new LiveStream();
$live = $this->getDoctrine()->getRepository(LiveStream::class) -> find($_POST['id_live']);

        $check = new Check( '../config/profanities.php');
        $hasProfanity = $check->hasProfanity($_POST['text']);
        $cleanWords = $check->obfuscateIfProfane($_POST['text']);


       // $badWords = array('bad', $_POST['text']); // or load from db
       // $check = new Check($_POST['text']);
        if ($hasProfanity == false) {
            $commentaire->setIdLivestream($live);
            $commentaire->setContenuCommentaire($_POST['text']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();


            $commentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(['idLivestream' => $_POST['id_live']], ['dateCommentaire' => 'DESC'], 1);
            foreach ($commentaires as $comm) {
                $x = $comm->getContenuCommentaire();
                // dd($x);
            }
            if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {

                //  dd($commentaires);
                $jsonData = $x;

                return new JsonResponse($jsonData);
            } else {
                return $this->render('Front/VoirLiveStream.html.twig');
            }

        }else {
            if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {

                //  dd($commentaires);
                $jsonData = "il faut pas dire de gros mots";
                $mot= $_POST['text'];

                return new JsonResponse($jsonData);
            }

        }



    }

}
