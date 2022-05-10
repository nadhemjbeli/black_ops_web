<?php

namespace App\Controller;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
/**
 * @Route ("/newesletter")
 */
class NewlestterController extends AbstractController {
    /**
     * @Route ("/", name="app_front_newsletter")
     */
    public function index(\Swift_Mailer $mailer,FlashyNotifier $flashy,Request $request):Response{
if (isset ($_POST['email'])) {
    $message = (new \Swift_Message('Newsletter Black Ops'))
        ->setFrom('replay.client.blackops@gmail.com')
        ->setTo($_POST['email'])
        ->setBody('You should see me from the profiler!');

    $mailer->send($message);
    $flashy->success('Merci de vous être inscrit à notre newsletter!');
$this ->addFlash('successNewsletter','Merci de vous être inscrit à notre newsletter');

   $route = $request->headers->get('referer');
    return $this->redirect($route);
}else {
    $flashy->error('Un problème est survenu lors de votre abonnement !');
    $this ->addFlash('erreurNewsletter','Un problème est survenu lors de votre abonnement ');
    return $this->redirectToRoute("app_front_accueil");
}

    }



}
