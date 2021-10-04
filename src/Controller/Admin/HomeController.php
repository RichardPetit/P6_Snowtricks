<?php

namespace App\Controller\Admin;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_home", methods={"GET"})
 */
class HomeController extends AbstractController
{
    public function __invoke(TricksRepository $tricksRepository, Request $request): Response
    {
        $page = $request->get('page') !== null ? (int) $request->get('page') : 1;

        $tricks = $tricksRepository->getTricksByCreationDate($page);
        return $this->render('tricks/index_admin.html.twig', [
            'tricks' => $tricks,
            'nbPages'   => $tricksRepository->getNbOfPages(),
            'currentPage' => $page,
            'url' => 'admin_home'
        ]);
    }
}
