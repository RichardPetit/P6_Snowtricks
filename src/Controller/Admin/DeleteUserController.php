<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/user/{id}/delete", name="delete_user")
 */
class DeleteUserController extends AbstractController
{

    public function __invoke(EntityManagerInterface $em, User $user = null): Response
    {
        if ($user !==null){
            $em->remove($user);
            $em->flush();
        }

        $this->addFlash('error', 'L\'utilisateur a bien été supprimé');
        return $this->redirectToRoute('users_list');
    }
}
