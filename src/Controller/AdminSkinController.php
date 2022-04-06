<?php

namespace App\Controller;

use App\Entity\Skin;
use App\Form\SkinType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/skin")
 */
class AdminSkinController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_skin_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $skins = $entityManager
            ->getRepository(Skin::class)
            ->findAll();

        return $this->render('admin_skin/index.html.twig', [
            'skins' => $skins,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_skin_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skin = new Skin();
        $form = $this->createForm(SkinType::class, $skin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skin);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_skin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_skin/new.html.twig', [
            'skin' => $skin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSkin}", name="app_admin_skin_show", methods={"GET"})
     */
    public function show(Skin $skin): Response
    {
        return $this->render('admin_skin/show.html.twig', [
            'skin' => $skin,
        ]);
    }

    /**
     * @Route("/{idSkin}/edit", name="app_admin_skin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Skin $skin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkinType::class, $skin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_skin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_skin/edit.html.twig', [
            'skin' => $skin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSkin}", name="app_admin_skin_delete", methods={"POST"})
     */
    public function delete(Request $request, Skin $skin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skin->getIdSkin(), $request->request->get('_token'))) {
            $entityManager->remove($skin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_skin_index', [], Response::HTTP_SEE_OTHER);
    }
}