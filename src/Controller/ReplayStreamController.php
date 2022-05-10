<?php

namespace App\Controller;

use App\Entity\ReplayStream;
use App\Form\StreamReplayType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class ReplayStreamController extends AbstractController
{
    /**
     * @Route("/replaystream", name="app_replay_stream")
     */
    public function index(): Response
    {

        $replaystream = $this -> getDoctrine()->getRepository(ReplayStream::class)->findAll();
//dd($replaystream);
        return $this->render('Back/AfficherReplayStream.html.twig', [

            'replaystreams' => $replaystream
        ]);
    }

    /**
     * @Route ("/replaystream/voir_{id}", name="app_replay_stream_voir")
     */
    public function voir($id): Response
    {

        $replaystream = $this -> getDoctrine()->getRepository(ReplayStream::class)->find($id);
//dd($replaystream);
        return $this->render('Back/VoirVideoReplayStream.html.twig', [
            'replaystreams' => $replaystream
        ]);
    }

    /**
     * @Route ("/replaystream/Ajouter" ,name="app_replay_stream_Ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em){
        $ri = new ReplayStream();
        $form = $this->createForm(StreamReplayType::class, $ri);
         $form->add('urlVideo',FileType::class,[
             'mapped' => false,
             'required'   => true,

         ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['urlVideo']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/MediaStream';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $ri->setUrlVideo($newFilename);
            }

            $em->persist($ri);
            $em->flush();

            $this->addFlash('success', 'Bien Ajouter avec succès!');
            return $this->redirectToRoute('app_replay_stream');
        }
        return $this->render("back/AjouterReplayStream.html.twig", [
            'ri' => $ri,
            'form' => $form -> createView()

        ]);
    }


    /**
     * @Route ("/replaystream/Modifier_{id}" ,name="app_replay_stream_modifier")
     */
    public function modifier(ReplayStream $ri,Request $request, EntityManagerInterface $em){

        $form = $this->createForm(StreamReplayType::class, $ri);
        $form->add('urlVideo',FileType::class,[
            'mapped' => false,
            'required'   => false,

        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['urlVideo']->getData();
            $lastFile = $ri->getUrlVideo();
            if ($form['urlVideo']->getData() == null){

                $ri->setUrlVideo($lastFile);
            }
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/MediaStream';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $ri->setUrlVideo($newFilename);
            }


            $em->flush();

            $this->addFlash('success', 'Bien Modifier avec succès!');
            return $this->redirectToRoute('app_replay_stream');
        }
        return $this->render("back/ModifierReplayStream.html.twig", [
            'ri' => $ri,
            'form' => $form -> createView()

        ]);
    }


    /**
     * @Route("/replaystream/Supprimer_{id}" ,name="app_replay_stream_supprimer")
     */
    public function supprimer(ReplayStream $ri, EntityManagerInterface $em)
    {
        $em->remove($ri);
        $em->flush();
        $this->addFlash('success', 'Bien Supprimé avec succès!');

//return new Response('Suppression');
        return $this->redirectToRoute('app_replay_stream');

    }




    /**
     * @Route ("/replaystream/vuestest", name="app_replay_stream_vuestest")
     */

    public function vuesTest(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
return new Response("Hello CHart");
        /*return $this->render('Back/VuesReplayStream.html.twig', [
            'chart' => $chart,
        ]);*/
    }


    /**
     * @Route ("/replaystream/vues", name="app_replay_stream_vues")
     */

    public function vues(): Response
    {
 $query = $this -> getDoctrine()->getRepository(ReplayStream::class)->findAll();

        return $this->render("Back/VuesReplayStream.html.twig",[
            "query"=>$query,
        ]);
    }
}
