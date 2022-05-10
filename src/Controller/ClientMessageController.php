<?php

namespace App\Controller;

use App\Entity\LikeMessage;
use App\Entity\Message;
use App\Entity\SousCategorie;
use App\Form\MessageClientType;
use App\Repository\LikeMessageRepository;
use App\Repository\MessageRepository;
use App\Repository\SousCategorieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/client/message")
 */
class ClientMessageController extends AbstractController
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var LikeMessageRepository
     */
    private LikeMessageRepository $likeMessageRepository;

    public function __construct(
        MessageRepository $messageRepository,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        LikeMessageRepository $likeMessageRepository
    )
    {
        $this->messageRepository = $messageRepository;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->likeMessageRepository = $likeMessageRepository;
    }

    /**
     * @Route("/", name="app_client_message")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
//        $appPath = $this->container->getParameter('kernel.root_dir');
//        $webPath = realpath($appPath . '/../public');
//        dd($webPath);
        return $this->render('client_message/index.html.twig', [
            'controller_name' => 'ClientMessageController',
        ]);
    }

    /**
     * @Route("/postMessage", name="add_message")
     */
    public function post(Request $request){
//        $message = json_decode($request->getContent(), true)['data']['message'];
        $current = $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        $idsc = $this->getDoctrine()->getRepository(SousCategorie::class)->findOneBy(['idSouscat'=>5]);
        $message = new Message();
        $message->setDateMessage();
        $message->setIdCl($current);
        $message->setIdSouscat($idsc);
        $form = $this->createForm(MessageClientType::class, $message);
        $form->handleRequest($request);
        $em = $this->entityManager;
        if($form->isSubmitted()){
            $em->persist($message);
            $em->flush();
            return $this->json([
//                'form'=>$view,
                $message
            ]);
        }
        return $this->json([
            'null'
        ]);

    }

    /**
     * @Route("/api_messages", name="api_message", methods={"GET"})
     */
    public function getMessages(Request $request){
        $messages = $this->messageRepository->getMessagesByUsers();
//        $messages = $this->messageRepository->findAll();
        $messages = $messages->getQuery()->getResult();
//        dd($messages);
//        return new JsonResponse(['message'=> $messages->getQuery()->getResult()]);
        $response = $this->json([
            'message' => $messages
        ], 200, []);
        return $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
    }

    /**
     * @Route("/api_likes/{idMessage}", name="api_count_message_likes", methods={"GET"})
     */
    public function getLikes(Request $request, int $idMessage){
        $likes = $this->likeMessageRepository->countLikes($idMessage);
        $list_of_likes = $this->likeMessageRepository->findBy(['idMessage'=>$idMessage]);
        $current = $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
//        dd($list_of_likes);
        $likes['current_user']=false;
//        if($likes == null){
//            dd($likes);
//        }
        foreach($list_of_likes as $l){
            if($l->getIdCl() === $current and $l->getReact()==1){
                $likes['current_user']=true;
                break;
            }

        }


//        dd($likes['current_user']);
        return $this->json([
            'counted' => $likes['count'],
            'current_user' =>$likes['current_user']
        ], 200, []);
    }

    /**
     * @Route ("/add_like/{idMessage}", name="post_like", methods={"GET","POST"})
     */
    public function post_like(Request $request, Message $message){
//        dd($message);
        $current = $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        $oldLike = $this->likeMessageRepository->findLikeByUserAndMessage($current, $message);
//        dd($oldLike);
        if($oldLike != null){
            $oldLike->setReact(1);
            $this->entityManager->flush();
            return $this->json([
                'oldLike'=>$oldLike
            ]);
        }
        $likeMessage = new LikeMessage();
        $likeMessage->setIdMessage($message);
        $likeMessage->setIdCl($current);
        $likeMessage->setReact(1);
        $this->entityManager->persist($likeMessage);
        $this->entityManager->flush();
        return $this->json([
            'likeMessage'=>$likeMessage
        ]);
    }

    /**
     * @Route ("/add_unlike/{idMessage}", name="post_unlike", methods={"GET","POST"})
     */
    public function post_unlike(Request $request, Message $message){
//        dd($message);
        $current = $this->userRepository->findOneBy(['username'=>$this->getUser()->getUsername()]);
        $oldLike = $this->likeMessageRepository->findLikeByUserAndMessage($current, $message);
//        dd($oldLike);
        if($oldLike != null){
            $oldLike->setReact(0);
            $this->entityManager->flush();
            return $this->json([
                'oldLike'=>$oldLike
            ]);
        }
        $likeMessage = new LikeMessage();
        $likeMessage->setIdMessage($message);
        $likeMessage->setIdCl($current);
        $likeMessage->setReact(0);
        $this->entityManager->persist($likeMessage);
        $this->entityManager->flush();
        return $this->json([
            'likeMessage'=>$likeMessage
        ]);
    }

    /**
     * @Route("/get_form", name="get_form")
     */
    public function getForm(Request $request){
//        $message = json_decode($request->getContent(), true)['data']['message'];
        $form = $this->createForm(MessageClientType::class);
        $view = $this->renderView('client_message/_form.html.twig', [
            'form'=>$form->createView(),
        ]);
        return $this->json([
            'form'=>$view,
            'title'=>'new Message'
        ]);

    }

    /**
     * @Route("/mobile")
     */
    public function getMessagesMobile(NormalizerInterface $normalizable, MessageRepository $messageRepository){
        $messages = $messageRepository->findAll();
        $jsonContent = $normalizable->normalize($messages, 'json');
//        dd($jsonContent);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/addMobile", name="addMobile"  )
     */
    public function addMessageMobile(NormalizerInterface $normalizer, Request $request, SousCategorieRepository $sousCategorieRepository){
//        $messages = $messageRepository->findAll();
        $sc = $sousCategorieRepository->findOneBy(['idSouscat'=>5]);
        $user = $this->userRepository->findOneBy(['username'=>'nadhem5']);
//        dd($user);
        $em = $this->entityManager;
        $message = new Message();
        $message->setContenuMessage($request->get('contenu'));
        $message->setIdCl($user);
        $message->setIdSouscat($sc);
        $message->setDateMessage();
        $em->persist($message);
        $em->flush();
        $jsonContent = $normalizer->normalize($message, 'json');
//        dd($jsonContent);
        return new Response(json_encode($jsonContent));
    }

}
