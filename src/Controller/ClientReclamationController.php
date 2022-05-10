<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
/**
 * @Route("/client/reclamation")
 */
class ClientReclamationController extends AbstractController
{
    /**
     * @Route("/", name="app_client_reclamation")
     */
    public function index(ReclamationRepository $reclamationRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        $reclamations = $reclamationRepository->findBy(['idCl'=>$user]);
        return $this->render('client_reclamation/index.html.twig', [
            'controller_name' => 'ClientReclamationController',
            'reclamations' => $reclamations
        ]);
    }


    /**
     * @Route("/new", name="app_client_reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        if ((isset ($_POST['Titre_Reclam'])) && (isset ($_POST['Desc_Reclam'])) && ($_POST['Titre_Reclam'] != null) && ($_POST['Desc_Reclam'] != null)) {
            $user = $userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
            $reclamation = new Reclamation();
       $reclamation -> setTitre($_POST['Titre_Reclam'])
           ->setDescription($_POST['Desc_Reclam'])
           ->setEtat("En Cours")
           ->setIdCl($user);
        $em -> persist($reclamation);
        $em ->flush();

                $route = $request->headers->get('referer');
            $this->addFlash('success', 'Votre Réclamation a été envoyée avec succès!');
                return $this->redirect($route);



        }else {

            $route = $request->headers->get('referer');
            $this->addFlash('erreur', "Erreur d'envoi reclamation!");
            return $this->redirect($route);
        }

    }
    /**
     * @Route("/AllCategorie")
     */
    public function AllCategorie(NormalizerInterface $normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $infostream = $repository->findAll();
        $jsonContent = $normalizer->normalize($infostream, 'json');
        return  new Response (json_encode(($jsonContent)));
    }
    /**
     * @Route("/AddCategorie")
     */
    public function addCategorie(Request $request,NormalizerInterface $normalizer)
    {
        $em= $this ->getDoctrine()->getManager();
        $Categorie= new Categorie();
        $Categorie->setNomCat($request->get('nomcat'));
        $em->persist(($Categorie));
        $em->flush();
        $jsonContent = $normalizer->normalize($Categorie, 'json');
        return new Response(json_encode(($jsonContent)));



    }
}
