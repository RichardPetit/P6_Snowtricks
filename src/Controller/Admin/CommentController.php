<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comments-list/{id}", name="comment")
 */

class CommentController extends AbstractController
{

    public function __invoke(CommentRepository $commentRepository, TricksRepository $tricksRepository, int $id, Request $request, EntityManagerInterface $em): Response
    {
        $trick = $tricksRepository->find($id);
        $comments = $this->getComments($commentRepository, $id);
        if ($trick === null){
            return $this->redirectToRoute('admin_home');
        }


        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
            'trick' => $trick

        ]);
    }

    private function getComments(CommentRepository $commentRepository, int $id): ?Comment
    {
        return $commentRepository->find($id);
    }

}
