<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Jeu;
use App\Entity\User;
use App\Form\MailType;
use App\Repository\AbonnementRepository;
use Cassandra\Blob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/admin/mokhtar", name="Mailing")
     */
    public function index(Request $request,\Swift_Mailer $mailer,AbonnementRepository $repab)
    {
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();


        $form = $this->createForm(MailType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
//            dd($contact);
            $j = $form->get('idJeu')->getData();

            $test = $repab->abonnementsusers($j);
            foreach ($test as $t) {
                $h = $t->getIdUser()->getMail();

                $message = (new \Swift_Message('New Content'))
                    // On attribue l'expéditeur

                    ->setFrom($contact['email'])

                    // On attribue le destinataire
                    ->setTo($h)

                    // On crée le texte avec la vue
                    ->setBody(
                        $this->renderView(
                            'mail/email.html.twig', compact('contact')
                        ),
                        'text/html'

                    );
                $mailer->send($message);
            }
            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
        }
        return $this->render('mail/index.html.twig',['mailform' => $form->createView()]);
    }

}