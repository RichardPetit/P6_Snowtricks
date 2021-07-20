<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="home", methods={"GET"})
 */
class HomeController extends AbstractController
{
    public function __invoke(TricksRepository $tricksRepository): Response
    {
        $tricks = $tricksRepository->getTricksByAlpha();
        return $this->render('tricks/index.html.twig', [
            'controller_name' => 'HomeController',
            'tricks' => $tricks,
        ]);
    }
}
