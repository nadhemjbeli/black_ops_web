<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Entity\User;
use App\Entity\VideoUploade;
use App\Form\ClientVideoUploadeType;
use App\Repository\VideoUploadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @Route("/client/video_uploade")
 * @IsGranted("ROLE_USER")
 */
class ClientVideoUploadeController extends AbstractController
{
    /**
     * @Route("/{page<\d+>}", name="app_client_video_uploade")
     */
    public function index(VideoUploadeRepository $videoUploadeRepository, int $page = 1): Response
    {
        $videos = $videoUploadeRepository->findAllWithUser();
        $pagerfanta = new Pagerfanta(new QueryAdapter($videos));
        $pagerfanta->setMaxPerPage(4);
        $pagerfanta->setCurrentPage($page);
//        dd($videos);


        return $this->render('client_video_uploade/index.html.twig', [
            'controller_name' => 'ClientVideoUploadeController',
            'videos'=>$pagerfanta
        ]);
    }

    /**
     * @Route("/new", name="app_client_video_uploade_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $error = null;
        $videoUploade = new VideoUploade();
        $form = $this->createForm(ClientVideoUploadeType::class, $videoUploade);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['urlVideo']->getData();

//                throw new \Exception('choose a video');
            $idSousCat = $this->getDoctrine()->getRepository(SousCategorie::class)->findOneBy(['idSouscat'=>6]);
            $currentUser = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$this->getUser()->getUsername()]);

            if($uploadedFile){
                if($uploadedFile->guessExtension() == 'mp4'){

                    $file_name = $uploadedFile->getClientOriginalName();
//                    dd($file_name);
                    try {
                        $uploadedFile->move(
                            $this->getParameter('video_uploade_directory'),
                            $file_name
                        );
                    } catch (FileException $e) {
                        throw new \Exception('could not move your file');
                    }
                    $videoUploade->setUrlVideo($file_name);
                    $videoUploade->setIdSouscat($idSousCat);
                    $videoUploade->setIdCl($currentUser);
                    $entityManager->persist($videoUploade);

                    $entityManager->flush();
                    return $this->redirectToRoute('app_client_video_uploade', [], Response::HTTP_SEE_OTHER);
                }
                else{
                    $error = 'Video must be of type mp4';
                    return $this->render('admin_video_uploade/new.html.twig', [
                        'video_uploade' => $videoUploade,
                        'form' => $form->createView(),
                        'error' => $error
                    ]);
                }
            }
            $videoUploade->setIdSouscat($idSousCat);
            $videoUploade->setIdCl($currentUser);
            $entityManager->persist($videoUploade);
            $entityManager->flush();
            return $this->redirectToRoute('app_client_video_uploade', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client_video_uploade/new.html.twig', [
            'video_uploade' => $videoUploade,
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @Route("/show/{id}", name="app_client_show_video_uploade")
     */
    public function show(VideoUploadeRepository $videoUploadeRepository, int $id): Response
    {
        $video = $videoUploadeRepository->findOneBy(['idVdeo' => $id]);

        return $this->render('client_video_uploade/show_video.html.twig', [
            'controller_name' => 'ClientVideoUploadeController',
            'video'=>$video
        ]);
    }
}
