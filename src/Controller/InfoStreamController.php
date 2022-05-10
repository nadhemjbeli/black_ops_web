<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Entity\StreamInfo;
use App\Form\StreamInfoType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class InfoStreamController extends AbstractController
{
    /**
     * @Route("/infostream", name="app_info_stream")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(StreamInfo::class);
        $infostream = $repository->findAll();
//dd($infostream);
        return $this->render('Back/AfficherInfoStream.html.twig', [
            'controller_name' => 'InfoStreamController',
            'infostreams'=>$infostream
        ]);
    }

    /**
     * @Route("/infostream/ajouter", name="app_info_stream_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $si = new StreamInfo();
        $form = $this->createForm(StreamInfoType::class, $si);
$form ->add('image_Stream',FileType::class,[
    'mapped' => false,
    'required'   => true,
]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image_Stream']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/MediaStream';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $si->setImageStream($newFilename);
            }

            $em->persist($si);
            $em->flush();

            $this->addFlash('success', 'Bien Ajouter avec succès!');
            return $this->redirectToRoute('app_info_stream');
        }
        return $this->render("back/AjouterInfoStream.html.twig", [
            'si' => $si,
            'form' => $form -> createView()

        ]);
    }
    /**
     * @Route("/infostream/modifier_{id}", name="app_info_stream_modifier")
     */
    public function modifier(StreamInfo $si,Request $request, EntityManagerInterface $em): Response
    {
        $form = $this -> createForm(StreamInfoType::class,$si);
        $form ->add('image_Stream',FileType::class,[
            'mapped' => false,
            'required'   => false,

        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image_Stream']->getData();
            $lastFile = $si->getImageStream();
            if ($form['image_Stream']->getData() == null){

                $si->setImageStream($lastFile);
            }
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/MediaStream';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $si->setImageStream($newFilename);
            }

           // $em->persist($si);
            $em->flush();

            $this->addFlash('success', 'Bien Modifié avec succès!');
            return $this->redirectToRoute('app_info_stream', [
                "id_Info" => $si->getIdStream(),
            ]);
        }


return $this->render("back/ModifierInfoStream.html.twig", [
    'si' => $si,
    'form' => $form -> createView()

]);

    }

    /**
     * @Route("/infostream/supprimer_{id}", name="app_info_stream_supprimer")
     */
    public function supprimer(StreamInfo $si, EntityManagerInterface $em){
//dump('suppression');
       $em->remove($si);
     $em->flush();
        $this->addFlash('success', 'Bien Supprimé avec succès!');

//return new Response('Suppression');
        return $this->redirectToRoute('app_info_stream');
    }

    /**
     * @Route("/allinfostream", name="allapp_info_stream")
     */
    public function all(NormalizerInterface $normalizer): Response
    {
        $repository = $this->getDoctrine()->getRepository(StreamInfo::class);
        $infostream = $repository->findAll();
//dd($infostream);
        $jsonContent = $normalizer ->normalize($infostream,'json');

        return new Response(json_encode($jsonContent));
        /*return $this->render('Back/AfficherInfoStream.html.twig', [
            'controller_name' => 'InfoStreamController',
            'infostreams'=>$infostream
        ]);*/
    }

    /**
     * @Route("/addinfostream", name="addapp_info_stream")
     */
    public function addInfo(Request $request,NormalizerInterface $normalizer): Response
    {
        $souscat = $this->getDoctrine()->getRepository(SousCategorie::class)->findOneBy(['nomSouscat'=>'Information']);

        $em = $this->getDoctrine()->getManager();
        $infos = new StreamInfo();
        $infos ->setImageStream($request->get('image'));
        $infos->setDescriptionStream($request->get('descri'));
        $infos->setNomStream($request->get('nom'));
$infos->setIdSouscat($souscat);
$em->persist($infos);
$em->flush();


        $jsonContent = $normalizer ->normalize($infos,'json');

        return new Response(json_encode($jsonContent));

    }

}
