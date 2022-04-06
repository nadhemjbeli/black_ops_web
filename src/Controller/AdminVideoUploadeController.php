<?php

namespace App\Controller;

use App\Entity\VideoUploade;
use App\Form\VideoUploadeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/video/uploade")
 */
class AdminVideoUploadeController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_video_uploade_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $videoUploades = $entityManager
            ->getRepository(VideoUploade::class)
            ->findAll();

        return $this->render('admin_video_uploade/index.html.twig', [
            'video_uploades' => $videoUploades,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_video_uploade_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $videoUploade = new VideoUploade();
        $form = $this->createForm(VideoUploadeType::class, $videoUploade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($videoUploade);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_video_uploade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_video_uploade/new.html.twig', [
            'video_uploade' => $videoUploade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVdeo}", name="app_admin_video_uploade_show", methods={"GET"})
     */
    public function show(VideoUploade $videoUploade): Response
    {
        return $this->render('admin_video_uploade/show.html.twig', [
            'video_uploade' => $videoUploade,
        ]);
    }

    /**
     * @Route("/{idVdeo}/edit", name="app_admin_video_uploade_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, VideoUploade $videoUploade, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VideoUploadeType::class, $videoUploade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_video_uploade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_video_uploade/edit.html.twig', [
            'video_uploade' => $videoUploade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVdeo}", name="app_admin_video_uploade_delete", methods={"POST"})
     */
    public function delete(Request $request, VideoUploade $videoUploade, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoUploade->getIdVdeo(), $request->request->get('_token'))) {
            $entityManager->remove($videoUploade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_video_uploade_index', [], Response::HTTP_SEE_OTHER);
    }
}
