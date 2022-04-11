<?php

namespace App\Controller;

use App\Repository\VideoUploadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientVideoUploadeController extends AbstractController
{
    /**
     * @Route("/client/video_uploade", name="app_client_video_uploade")
     */
    public function index(VideoUploadeRepository $videoUploadeRepository): Response
    {
        $videos = $videoUploadeRepository->findAllWithUser();
//        dd($videos);

        return $this->render('client_video_uploade/index.html.twig', [
            'controller_name' => 'ClientVideoUploadeController',
            'videos'=>$videos
        ]);
    }
}
