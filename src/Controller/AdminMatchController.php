<?php

namespace App\Controller;

use App\Entity\DetailsDefi;
use App\Form\DetailsDefiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/match")
 */
class AdminMatchController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_match_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $detailsDefis = $entityManager
            ->getRepository(DetailsDefi::class)
            ->findAll();

        return $this->render('admin_match/index.html.twig', [
            'details_defis' => $detailsDefis,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_match_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailsDefi = new DetailsDefi();
        $form = $this->createForm(DetailsDefiType::class, $detailsDefi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$detailsDefi->getImgscore();

            $fileName =$detailsDefi->getEquipea().' vs '.$detailsDefi->getEquipeb().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('match_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $detailsDefi ->setImgscore($fileName);

            $entityManager->persist($detailsDefi);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_match_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_match/new.html.twig', [
            'details_defi' => $detailsDefi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idStatistique}", name="app_admin_match_show", methods={"GET"})
     */
    public function show(DetailsDefi $detailsDefi): Response
    {
        return $this->render('admin_match/show.html.twig', [
            'details_defi' => $detailsDefi,
        ]);
    }

    /**
     * @Route("/{idStatistique}/edit", name="app_admin_match_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DetailsDefi $detailsDefi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailsDefiType::class, $detailsDefi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$detailsDefi->getImgscore();
            $fileName =$detailsDefi->getEquipea().' vs '.$detailsDefi->getEquipeb().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('match_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $detailsDefi ->setImgscore($fileName);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_match_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_match/edit.html.twig', [
            'details_defi' => $detailsDefi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idStatistique}", name="app_admin_match_delete", methods={"POST"})
     */
    public function delete(Request $request, DetailsDefi $detailsDefi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsDefi->getIdStatistique(), $request->request->get('_token'))) {
            $entityManager->remove($detailsDefi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_match_index', [], Response::HTTP_SEE_OTHER);
    }
}
