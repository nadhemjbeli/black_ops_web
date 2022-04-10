<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientMessageController extends AbstractController
{
    /**
     * @Route("/client/message", name="app_client_message")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        return $this->render('client_message/index.html.twig', [
            'controller_name' => 'ClientMessageController',
        ]);
    }
}
