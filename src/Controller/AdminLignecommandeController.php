<?php

namespace App\Controller;

use App\Entity\Lignecommande;
use App\Form\LignecommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/lignecommande")
 */
class AdminLignecommandeController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_lignecommande_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $lignecommandes = $entityManager
            ->getRepository(Lignecommande::class)
            ->findAll();

        return $this->render('admin_lignecommande/index.html.twig', [
            'lignecommandes' => $lignecommandes,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_lignecommande_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lignecommande = new Lignecommande();
        $form = $this->createForm(LignecommandeType::class, $lignecommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lignecommande);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_lignecommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_lignecommande/new.html.twig', [
            'lignecommande' => $lignecommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idLignecommande}", name="app_admin_lignecommande_show", methods={"GET"})
     */
    public function show(Lignecommande $lignecommande): Response
    {
        return $this->render('admin_lignecommande/show.html.twig', [
            'lignecommande' => $lignecommande,
        ]);
    }

    /**
     * @Route("/{idLignecommande}/edit", name="app_admin_lignecommande_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Lignecommande $lignecommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LignecommandeType::class, $lignecommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_lignecommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_lignecommande/edit.html.twig', [
            'lignecommande' => $lignecommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idLignecommande}", name="app_admin_lignecommande_delete", methods={"POST"})
     */
    public function delete(Request $request, Lignecommande $lignecommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignecommande->getIdLignecommande(), $request->request->get('_token'))) {
            $entityManager->remove($lignecommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_lignecommande_index', [], Response::HTTP_SEE_OTHER);
    }
}
