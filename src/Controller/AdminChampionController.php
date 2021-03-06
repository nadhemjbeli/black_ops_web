<?php

namespace App\Controller;

use App\Entity\Champion;
use App\Form\ChampionType;
use App\Repository\ChampionRepository;
use Doctrine\ORM\EntityManagerInterface;
//use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function new(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translate): Response
    {
        $champion = new Champion();
        $form = $this->createForm(ChampionType::class, $champion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$champion->getImageChamp();
            $nomchamp=$champion->getNomChamp();
            // On boucle sur les images

            // On génère un nouveau nom de fichier
            $fichier = $nomchamp.'.'.$file->guessExtension();

            // On copie le fichier dans le dossier uploads
            try {
                $file->move(
                    $this->getParameter('images_directory2'),
                    $fichier
                );
            } catch (FileException $e) { new Response($e->getMessage());}
            $entityManager=$this->getDoctrine()->getManager();
            $champion->setImageChamp($fichier);
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
    public function edit(Request $request, Champion $champion, EntityManagerInterface $entityManager, TranslatorInterface $translate): Response
    {
        $form = $this->createForm(ChampionType::class, $champion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomchamp=$champion->getNomChamp();
            $file=$champion->getImageChamp();

            // On boucle sur les images

            // On génère un nouveau nom de fichier
            $fichier = $nomchamp.'.'.$file->guessExtension();

            // On copie le fichier dans le dossier uploads
            try {
                $file->move(
                    $this->getParameter('images_directory2'),
                    $fichier
                );
            } catch (FileException $e) { new Response($e->getMessage());}
            $entityManager=$this->getDoctrine()->getManager();
            $champion->setImageChamp($fichier);
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
    public function delete(Request $request, Champion $champion, EntityManagerInterface $entityManager, TranslatorInterface $translate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$champion->getIdChamp(), $request->request->get('_token'))) {
            $file=$champion->getImageChamp();
            unlink($this->getParameter('images_directory2').'/'.$file);
            $entityManager->remove($champion);
            $entityManager->flush();

        }

        return $this->redirectToRoute('app_admin_champion_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/", name="app_admin_champion_index", methods={"GET", "POST"})
     */
    public function search(Request $request , ChampionRepository $repchamp)
    {
        $em=$this->getDoctrine()->getManager();
        $champion=$em->getRepository(Champion::class)->findAll();
        if ($request->isMethod("POST")) {
            $nom = $request->get('nom');
            $champion = $repchamp->search2($nom);
        }
        return $this->render('admin_champion/index.html.twig', [
            'champions' => $champion,
        ]);

    }
}
