<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Form\SousCategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sous/categorie")
 */
class AdminSousCategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_sous_categorie_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sousCategories = $entityManager
            ->getRepository(SousCategorie::class)
            ->findAll();

        return $this->render('admin_sous_categorie/index.html.twig', [
            'sous_categories' => $sousCategories,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_sous_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sousCategorie = new SousCategorie();
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_sous_categorie/new.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSouscat}", name="app_admin_sous_categorie_show", methods={"GET"})
     */
    public function show(SousCategorie $sousCategorie): Response
    {
        return $this->render('admin_sous_categorie/show.html.twig', [
            'sous_categorie' => $sousCategorie,
        ]);
    }

    /**
     * @Route("/{idSouscat}/edit", name="app_admin_sous_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SousCategorie $sousCategorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_sous_categorie/edit.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSouscat}", name="app_admin_sous_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, SousCategorie $sousCategorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategorie->getIdSouscat(), $request->request->get('_token'))) {
            $entityManager->remove($sousCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
