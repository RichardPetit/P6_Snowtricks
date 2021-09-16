<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comments/{id}/delete", name="delete_comment", methods={"GET", "POST"})
 * @param Comment $comment
 * @param EntityManagerInterface $em
 * @return Response
 */
class DeleteCommentController extends AbstractController
{

    public function __invoke(EntityManagerInterface $em, Comment $comment = null): Response
    {
        if ($comment !== null) {
            $em->remove($comment);
            $em->flush();
        }
        return $this->redirectToRoute('admin_home');
    }
}
