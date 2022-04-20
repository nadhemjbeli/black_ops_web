<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewType;
use App\Repository\DefiRepository;

use App\Repository\ReviewRepository;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Type;
use PHPUnit\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientDefiController extends AbstractController
{
    /**
     * @Route("/client/defi", name="app_client_defi_all")
     */
    public function index(EntityManagerInterface $entityManager, DefiRepository $rep): Response
    {
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();
        return $this->render('client_defi/index.html.twig', [
            'defis' => $defis,
            'LastThree' => $LastThree,
        ]);
    }

    /**
     * @Route("/client/defi/{idDefi}", name="app_client_defi_detail")
     */
    public function detail(EntityManagerInterface $entityManager, ReviewRepository $rev, Defi $defi, DefiRepository $rep, Request $request, UserRepository $urep): Response
    {
        $review = new review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();
        //stat
        $totalRev = $rev->CountByIDDefi($defi->getIdDefi());

        $username = $this->getUser()->getUsername();

        /** @var User $user */
        $user = $urep->findOneBy(['username' => $username]);
        $reviewByDefi = $rev->ReviewDateDefi($defi->getIdDefi());
        $totalRev = $rev->CountByIDDefi($defi->getIdDefi());

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setIdUser($user);
            $review->setIdDefi($defi);
            $time = new \DateTime();
            $time->format('Y-m-d H:i');
            $review->setDate($time);
            $entityManager->persist($review);
            $entityManager->flush();


            return $this->render('client_defi/defi.html.twig', ['defi' => $defi,
                'defis' => $defis,
                'lts' => $LastThree,
                'formA' => $form->createView(),
                'revList' => $reviewByDefi,
                'total' => $totalRev,
                'user' => $user,

            ]);

        }


        return $this->render('client_defi/defi.html.twig', [
            'defi' => $defi,
            'defis' => $defis,
            'lts' => $LastThree,
            'formA' => $form->createView(),
            'revList' => $reviewByDefi,
            'total' => $totalRev,
            'user' => $user,

        ]);
    }

    /**
     * @Route("/{id}", name="app_client_review_delete", methods={"POST"})
     */
    public function delete(Review $review, EntityManagerInterface $entityManager, Request $request, DefiRepository $rep): Response
    {
//
        if ($this->isCsrfTokenValid('delete' . $review->getId(), $request->request->get('_token'))) {
            $entityManager->remove($review);
            $entityManager->flush();
        }
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();
        return $this->render('client_defi/index.html.twig', [
            'defis' => $defis,
            'LastThree' => $LastThree,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_client_review_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Review $review, EntityManagerInterface $entityManager, ReviewRepository $rev, Defi $defi, DefiRepository $rep, UserRepository $urep): Response
    {

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();
        $LastThree = $rep
            ->findByThree();

        $username = $this->getUser()->getUsername();

        /** @var User $user */
        $user = $urep->findOneBy(['username' => $username]);
        $reviewByDefi = $rev->ReviewDateDefi($defi->getIdDefi());
        $totalRev = $rev->CountByIDDefi($defi->getIdDefi());
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setIdUser($user);
            $review->setIdDefi($defi);
            $time = new \DateTime();
            $time->format('Y-m-d H:i');
            $review->setDate($time);
            $entityManager->persist($review);
            $entityManager->flush();


            return $this->render('client_defi/defi.html.twig', ['defi' => $defi,
                'defis' => $defis,
                'lts' => $LastThree,
                'formA' => $form->createView(),
                'revList' => $reviewByDefi,
                'total' => $totalRev,
                'user' => $user
            ]);


        }
        return $this->render('client_defi/defi.html.twig', [
            'defi' => $defi,
            'defis' => $defis,
            'lts' => $LastThree,
            'formA' => $form->createView(),
            'revList' => $reviewByDefi,
            'total' => $totalRev,
            'user' => $user
        ]);
    }

       public function Stat($a)
       {

            $em = $this->getDoctrine()->getManager() ;
            $totalRev  =$em->getRepository(Review::class)->CountByIDDefi($a);
            $rev = $em->getRepository(Review::class)->SelectReview($a);

           if (intval($totalRev)!=0) {
               $moy = intval($rev) / intval($totalRev);
               return new Response(intval($moy));
               
               
           }else{
               $moy = 0 ;
               return new Response(0);
           }




        }

}
