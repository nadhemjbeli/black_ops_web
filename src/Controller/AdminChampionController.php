<?php

namespace App\Controller;

use App\Entity\Champion;
use App\Form\ChampionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/champion")
 */
class AdminChampionController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_champion_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $champions = $entityManager
            ->getRepository(Champion::class)
            ->findAll();

        return $this->render('admin_champion/index.html.twig', [
            'champions' => $champions,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_champion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $champion = new Champion();
        $form = $this->createForm(ChampionType::class, $champion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($champion);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_champion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_champion/new.html.twig', [
            'champion' => $champion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idChamp}", name="app_admin_champion_show", methods={"GET"})
     */
    public function show(Champion $champion): Response
    {
        return $this->render('admin_champion/show.html.twig', [
            'champion' => $champion,
        ]);
    }

    /**
     * @Route("/{idChamp}/edit", name="app_admin_champion_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Champion $champion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChampionType::class, $champion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_champion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_champion/edit.html.twig', [
            'champion' => $champion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idChamp}", name="app_admin_champion_delete", methods={"POST"})
     */
    public function delete(Request $request, Champion $champion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$champion->getIdChamp(), $request->request->get('_token'))) {
            $entityManager->remove($champion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_champion_index', [], Response::HTTP_SEE_OTHER);
    }
}
