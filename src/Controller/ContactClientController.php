<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/client")
 */
class ContactClientController extends AbstractController
{
    /**
     * @Route("/", name="app_contact_client_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $contacts = $entityManager
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('contact_client/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/new", name="app_contact_client_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('skeleton/footer.html.twig', [
            'contact' => $contact,
            'formA' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idContact}", name="app_contact_client_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('contact_client/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{idContact}/edit", name="app_contact_client_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_client/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idContact}", name="app_contact_client_delete", methods={"POST"})
     */
    public function delete(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getIdContact(), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
