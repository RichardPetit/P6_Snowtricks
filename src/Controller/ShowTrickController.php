<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/trick/show/{id}", name="trick_show")
 */
class ShowTrickController extends AbstractController
{

    public function __invoke(CommentRepository $commentRepository, TricksRepository $tricksRepository, int $id, Request $request, EntityManagerInterface $em): Response
    {

        $trick = $this->getTrick($tricksRepository, $id);
//        $comments = $commentRepository->getCommentsForArticle($id);
        if ($trick === null) {
            return $this->redirectToRoute('home');
        }

        // Partie Commentaires
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            $comment->setTrick($trick);
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Votre commentaire a bien été ajouté');
        }


//        return $this->renderTrickForm($trick);
        return $this->render('show/index.html.twig', [
            'trick' => $trick,
            'formComment' => $commentForm->createView( )
        ]);
    }

    private function getTrick(TricksRepository $tricksRepository, int $id): ?Trick
    {
        return $tricksRepository->find($id);
    }


    private function renderTrickForm(Trick $trick): Response
    {
        return $this->render('show/index.html.twig', [
            'trick' => $trick,
        ]);
    }

}
