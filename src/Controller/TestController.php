<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test", name="test", methods={"GET"})
 */
class TestController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('tricks/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
