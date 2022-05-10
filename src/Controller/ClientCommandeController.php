<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Defi;
use App\Entity\Lignecommande;
use App\Entity\User;
use App\Repository\CommandeRepository;
use App\Repository\DefiRepository;
use App\Repository\LignecommandeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandes")
 */
class ClientCommandeController extends AbstractController
{
    /**
     * @var CommandeRepository
     */
    private $commandeRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var LignecommandeRepository
     */
    private $lignecommandeRepository;

    /**
     * ClientCommandeController constructor.
     */
    public function __construct(CommandeRepository $commandeRepository, UserRepository $userRepository, LignecommandeRepository $lignecommandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
        $this->userRepository = $userRepository;
        $this->lignecommandeRepository = $lignecommandeRepository;
    }


    /**
     * @Route("/", name="app_client_commande")
     */
    public function index(): Response
    {
        return $this->render('client_commande/index.html.twig', [
            'controller_name' => 'ClientCommandeController',
        ]);
    }

    /**
     * @Route("/defis", name="app_client_c_defi")
     */
    public function getDefis(DefiRepository $defiRepository): Response
    {

        $defis = $defiRepository->findAll();
//        dd($produits);
        return $this->render('client_commande/defis.html.twig', [
            'controller_name' => 'ClientCommandeController',
            'defis' => $defis
        ]);
    }



    /**
     * @Route("/new/lc/{id}", name="app_client_add_ligne_commande", methods={"GET", "POST"})
     */
    public function addLigneCommande(DefiRepository $defiRepository, EntityManagerInterface $entityManager, Defi $defi): Response
    {

//        $defis = $defiRepository->findAll();
//        dd($produits);
        $user =  $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        $commande = $this->commandeRepository->findMaxCommandeByUser($user->getIdUser());
        if(!$commande){
            $commande = $this->getOrCreateCommande($user);
            $entityManager->persist($commande);
            $entityManager->flush();
        }

        $defi = $defiRepository->findOneBy(['idDefi'=>$defi]);
        $ligneCommande = new Lignecommande;
        $ligneCommande->setIdCommande($commande);
        $ligneCommande->setIdDefi($defi);
        $ligneCommande->setQuantiteBillet(1);
        $ligneCommande->setPrixBillet($defi->getPrixDefi() * $ligneCommande->getQuantiteBillet());
        $entityManager->persist($ligneCommande);
        $entityManager->flush();
//        dd($ligneCommande);
        $this->addFlash('success', $defi->getNomDefi());

        return $this->redirectToRoute('app_client_defi_all');
    }


    /**
     * @Route("/get_lc/", name="app_client_get_ligne_commande", methods={"GET", "POST"})
     */
    public function getLigneCommandes(EntityManagerInterface $entityManager): Response
    {

//        dd($produits);
        $user =  $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        /** @var Commande $commande */
        $commande = $this->commandeRepository->findMaxCommandeByUser($user->getIdUser());
        if(!$commande){
            /** @var Commande $commande */
            $commande = $this->getOrCreateCommande($user);
            $entityManager->persist($commande);
            $entityManager->flush();
            /** @var Commande $commande */
            $commande = $this->commandeRepository->findMaxCommandeByUser($user->getIdUser());
        }
        $lignecommandes = $this->lignecommandeRepository
            ->findWithDefisByCommande($commande->getIdCommande())
        ;
        $total_points = 0;
        $total_quantite = 0;
        /** @var Lignecommande $l */
        foreach($lignecommandes as $l){
            $total_points = $total_points + $l->getQuantiteBillet();
            $total_quantite = $total_quantite + $l->getPrixBillet();
        }
        return $this->render('client_commande/panier.html.twig',[
            'idCommande'=>$commande->getIdCommande(),
            'lignecommandes'=>$lignecommandes,
            'total_points'=>$total_points,
            'total_quantite'=>$total_quantite,
        ]);
    }

    public function getOrCreateCommande($user){

        $commande = new Commande();
        $commande->setIdCl($user);
        $commande->setEtatCommande('en cours');
        $commande->setDateCommande();
        return $commande;
//            dd($commande);

    }

    /**
     * @Route("del/{idLignecommande}", name="app_client_lignecommande_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Lignecommande $lignecommande, EntityManagerInterface $entityManager): Response
    {
//        if ($this->isCsrfTokenValid('delete'.$lignecommande->getIdLignecommande(), $request->request->get('_token'))) {
            $entityManager->remove($lignecommande);
            $entityManager->flush();
//        }

        return $this->redirectToRoute('app_client_get_ligne_commande', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("proc/{idcommande}", name="app_client_proceed_commande", methods={"GET","POST"})
     */
    public function proceedCommande(int $idcommande, EntityManagerInterface $entityManager){
        $commande = $this->commandeRepository->findOneBy(['idCommande'=>$idcommande]);
        $commande->setEtatCommande('en attente');
        $entityManager->flush();
        return $this->redirectToRoute('app_client_defi_all', [], Response::HTTP_SEE_OTHER);
    }


}
