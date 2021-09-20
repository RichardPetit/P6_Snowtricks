<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users", name="users_list")
 */
class UserController extends AbstractController
{

    public function __invoke(UserRepository $userRepository, Request $request): Response
    {
        $users = $userRepository->getAllUsersExceptedUser($this->getUser()->getId());

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

}
