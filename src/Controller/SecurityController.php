<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/my-profil", name="profil")
     * @return Response
     */
    public function profilUser(): Response
    {
        return $this->render('security/profil.html.twig');
    }

}
