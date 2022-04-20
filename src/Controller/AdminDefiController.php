<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Entity\Review;
use App\Form\DefiType;
use App\Repository\DefiRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
 * @Route("/admin/defi")
 */
class AdminDefiController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_defi_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $defis = $entityManager
            ->getRepository(Defi::class)
            ->findAll();

        return $this->render('admin_defi/index.html.twig', [
            'defis' => $defis,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_defi_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $defi = new Defi();
        $form = $this->createForm(DefiType::class, $defi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file =$defi->getImgDefi();
            $fileName =$form->getData().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('defi_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $defi ->setImgDefi($fileName);
            $entityManager->persist($defi);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_defi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_defi/new.html.twig', [
            'defi' => $defi,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idDefi}/edit", name="app_admin_defi_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Defi $defi, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(DefiType::class, $defi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file=$defi->getImgDefi();
            $fileName =$form->getData().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('defi_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $defi ->setImgDefi($fileName);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_defi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_defi/edit.html.twig', [
            'defi' => $defi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idDefi}", name="app_admin_defi_delete", methods={"POST"})
     */
    public function delete(Request $request, Defi $defi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$defi->getIdDefi(), $request->request->get('_token'))) {
            $entityManager->remove($defi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_defi_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * Search action.
     * @Route("/search", name="search")
     * @param  Request               $request Request instance
     * @param  string                $search  Search term
     * @return Response|JsonResponse          Response instance
     */
    public function searchAction(Request $request, string $search)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->render("admin_defi/index.html.twig");
        }

        if (!$searchTerm = trim($request->query->get("search", $search))) {
            return new JsonResponse(["error" => "Search term not specified."], Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        if (!($Defis = $em->getRepository(Defi::class)->findEntitiesByString($searchTerm))) {
            return new JsonResponse(["error" => "No results found."], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            "html" => $this->renderView("admin_defi/index.html.twig", ["Defis" => $Defis]),
        ]);
    }
    /**
     * @Route("/stat", name="app_admin_defi_statbar")
     */
    public function Statistic(ChartBuilderInterface $chartBuilder,DefiRepository $rep,ReviewRepository $rev): Response
    {
        $defis = $rep->findAll();
        foreach ($defis as $defi) {
            $label [] = $defi->getNomDefi();
            $datasets[] = $rev->SelectReview($defi);
        }
            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
            $chart->setData([
                'labels' => $label,
                'datasets' => [
                    [
                        'label' => 'Note Total  Par defi ',
                        'backgroundColor' => 'rgb(9, 161, 149)',
                        'borderColor' => 'rgb(255, 99, 132)',

                        'data' => $datasets ,
                    ],
                ],
            ]);



        return $this->render('admin_defi/Stat.html.twig', [

            'chart' => $chart,
        ]);

    }
    /**
     * @Route("/{idDefi}", name="app_admin_defi_show")
     */
    public function show(Defi $defi): Response
    {
        return $this->render('admin_defi/show.html.twig', [
            'defi' => $defi,
        ]);
    }






}
