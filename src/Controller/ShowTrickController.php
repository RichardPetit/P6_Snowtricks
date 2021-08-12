<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/trick/show/{id}", name="trick_show")
 */
class ShowTrickController extends AbstractController
{

    public function __invoke(TricksRepository $tricksRepository, int $id): Response
    {

        $trick = $this->getTrick($tricksRepository, $id);
        if ($trick === null) {
            return $this->redirectToRoute('home');
        }
        return $this->renderTrickForm($trick);
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
