<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/show/{id}", name="trick_show")
 */
class ShowController extends AbstractController
{

    public function __invoke(TricksRepository $tricksRepository, $id): Response
    {
        $trick = $tricksRepository->find($id);
        return $this->render('show/index.html.twig', [
            'trick' => $trick,
            'controller_name' => 'ShowController',
        ]);
    }
//    public function __invoke($id): Response
//    {
//        $repo = $this->getDoctrine()->getRepository(Tricks::class);
//        $trick = $repo->find($id);
//
//        return $this->render('show/index.html.twig', [
//            'trick' => $trick,
//        ]);
//    }



//    /**
//     * @Route("/show", name="show")
//     */
//    public function index(): Response
//    {
//        return $this->render('show/index.html.twig', [
//            'controller_name' => 'ShowController',
//        ]);
//    }

}
