<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/admincontact")
 */
class AdmincontactController extends AbstractController
{
    /**
     * @Route("/", name="app_admincontact_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $contacts = $entityManager
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('admincontact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/new", name="app_admincontact_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(Contact1Type::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_admincontact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admincontact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idContact}", name="app_admincontact_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('admincontact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{idContact}/edit", name="app_admincontact_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Contact1Type::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admincontact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admincontact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idContact}", name="app_admincontact_delete", methods={"POST"})
     */
    public function delete(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getIdContact(), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admincontact_index', [], Response::HTTP_SEE_OTHER);
    }
}
