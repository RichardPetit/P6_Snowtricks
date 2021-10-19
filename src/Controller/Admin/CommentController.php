<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tricks/{id}/comments", name="comments_list")
 */

class CommentController extends AbstractController
{
    public function __invoke(CommentRepository $commentRepository, Request $request, EntityManagerInterface $em, Trick $trick = null): Response
    {
        if ($trick === null){
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('comment/index.html.twig', [
            'comments' => $trick->getComments(),
            'trick' => $trick,
        ]);
    }

//    public function __invoke(CommentRepository $commentRepository, Request $request, EntityManagerInterface $em, Trick $trick = null): Response
//    {
//        if ($trick === null){
//            return $this->redirectToRoute('admin_home');
//        }
//        $page = $request->get('page') !== null ? (int) $request->get('page') : 1;
//
//        $comments = $commentRepository->getCommentsForArticleByCreationDate($page);
//return $this->render('comment/index.html.twig', [
//    'comments' => $comments,
//    'nbPages' => $commentRepository->getNbOfPages(),
//    'currentPage' => $page,
//    'trick' => $trick
//]);
//
//    }

    private function getComments(CommentRepository $commentRepository, int $id): ?Comment
    {
        return $commentRepository->find($id);
    }

}
