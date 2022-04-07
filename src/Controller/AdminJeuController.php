<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/jeu")
 */
class AdminJeuController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_jeu_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $jeus = $entityManager
            ->getRepository(Jeu::class)
            ->findAll();

        return $this->render('admin_jeu/index.html.twig', [
            'jeus' => $jeus,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_jeu_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jeu = new Jeu();
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jeu);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_jeu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_jeu/new.html.twig', [
            'jeu' => $jeu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJeu}", name="app_admin_jeu_show", methods={"GET"})
     */
    public function show(Jeu $jeu): Response
    {
        return $this->render('admin_jeu/show.html.twig', [
            'jeu' => $jeu,
        ]);
    }

    /**
     * @Route("/{idJeu}/edit", name="app_admin_jeu_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Jeu $jeu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_jeu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_jeu/edit.html.twig', [
            'jeu' => $jeu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJeu}", name="app_admin_jeu_delete", methods={"POST"})
     */
    public function delete(Request $request, Jeu $jeu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeu->getIdJeu(), $request->request->get('_token'))) {
            $entityManager->remove($jeu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_jeu_index', [], Response::HTTP_SEE_OTHER);
    }
}
