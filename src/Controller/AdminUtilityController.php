<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminUtilityController extends AbstractController
{
    /**
     * @Route("/admin/utility/users", methods="GET", name="admin_utility_users")
     */
    public function getUsersApi(UserRepository $userRepository, Request $request)
    {
//        $users = $userRepository->findAllEmailAlphabetical();
        $users = $userRepository->findAllMatching($request->query->get('query'));
        $response = $this->json([
            'users' => $users
        ], 200, []);
        return $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
    }
}
