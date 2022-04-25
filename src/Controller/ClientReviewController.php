<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientReviewController extends AbstractController
{
    /**
     * @Route("/client/review", name="app_client_review")
     */
    public function index(): Response
    {
        return $this->render('client_review/index.html.twig', [
            'controller_name' => 'ClientReviewController',
        ]);
    }
}
