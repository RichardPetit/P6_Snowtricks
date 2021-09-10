<?php

namespace App\Controller\Admin;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comments-list", name="comment")
 */

class CommentController extends AbstractController
{

    public function __invoke(CommentRepository $commentRepository, Request $request): Response
    {
        $comments = $commentRepository->findAll();

        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
            'comments' => $comments,

        ]);
    }
}
