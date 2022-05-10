<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
//        dd($this->getUser());
        foreach($this->getUser()->getRoles() as $role){
            if ($role=="ROLE_ADMIN"){
                return $this->redirectToRoute('app_user_admin_index');
            }
    }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
