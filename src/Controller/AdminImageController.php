<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/admin/image")
 */
class AdminImageController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_image_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $images = $entityManager
            ->getRepository(Image::class)
            ->findAll();

        return $this->render('admin_image/index.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_image_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,ImageRepository $repimg, TranslatorInterface $translate): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$image->getUrlImage();
            $idimg=$repimg->maxidimg();
            // On boucle sur les images
            // On génère un nouveau nom de fichier
            $fichier = $idimg.'.'.$file->guessExtension();

            // On copie le fichier dans le dossier uploads
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            } catch (FileException $e) { new Response($e->getMessage());}

            // On stocke l'image dans la base de données (son nom)

            $entityManager=$this->getDoctrine()->getManager();
            $image->setUrlImage($fichier);
            $entityManager->persist($image);
            $entityManager->flush();


            return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_image/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idImage}", name="app_admin_image_show", methods={"GET"})
     */
    public function show(Image $image): Response
    {
        return $this->render('admin_image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{idImage}/edit", name="app_admin_image_edit", methods={"GET", "POST"})
     */
    public function edit(Image $img,Request $request, Image $image, EntityManagerInterface $entityManager,ImageRepository $repimg, TranslatorInterface $translate): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$image->getUrlImage();
            $idimg=$img->getIdImage();

            // On génère un nouveau nom de fichier
            $fichier = $idimg.'.'.$file->guessExtension();

            // On copie le fichier dans le dossier uploads
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            } catch (FileException $e) { new Response($e->getMessage());}
            $entityManager=$this->getDoctrine()->getManager();
            $image->setUrlImage($fichier);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idImage}", name="app_admin_image_delete", methods={"POST"})
     */
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager, TranslatorInterface $translate): Response
    {

        if ($this->isCsrfTokenValid('delete'.$image->getIdImage(), $request->request->get('_token'))) {
            $file=$image->getUrlImage();
            unlink($this->getParameter('images_directory').'/'.$file);
            $entityManager->remove($image);
            $entityManager->flush();

        }

        return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/", name="app_admin_image_index", methods={"GET", "POST"})
     */
    public function search(Request $request , ImageRepository $repimage)
    {
        $em=$this->getDoctrine()->getManager();
        $image=$em->getRepository(Image::class)->findAll();
        if ($request->isMethod("POST")) {
            $nom = $request->get('nom');
            $image = $repimage->search($nom);
        }
        return $this->render('admin_image/index.html.twig', [
            'images' => $image,
        ]);

    }
}
