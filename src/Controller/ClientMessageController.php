<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\SousCategorie;
use App\Form\MessageClientType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client/message")
 * @IsGranted("ROLE_USER")
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

    public function __construct(MessageRepository $messageRepository, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
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
     * @IsGranted("ROLE_USER")
     */
    public function getMessages(Request $request){
        $messages = $this->messageRepository->getMessagesByUsers();
        return $this->json($messages);
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

}
