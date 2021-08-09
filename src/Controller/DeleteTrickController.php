<?php

namespace App\Controller;

use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/delete/trick/{id}", name="delete_trick")
 * @param Tricks $trick
 * @param EntityManagerInterface $em
 * @return Response
 */
class DeleteTrickController extends AbstractController
{

    public function __invoke(EntityManagerInterface $em, Tricks $trick = null): Response
    {
        if ($trick !== null) {
            $em->remove($trick);
            $em->flush();
        }

        return $this->redirectToRoute('home');
    }
}
