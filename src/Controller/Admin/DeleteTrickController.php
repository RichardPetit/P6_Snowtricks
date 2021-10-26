<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tricks/{id}/delete", name="delete_trick", methods={"GET"})
 * @param Trick $trick
 * @param EntityManagerInterface $em
 * @return Response
 */
class DeleteTrickController extends AbstractController
{

    public function __invoke(EntityManagerInterface $em, Trick $trick = null): Response
    {
        if ($trick !== null) {

            $medias = $trick->getMedias();
            foreach ($medias as $media) {
                $em->remove($media);
            }
            $em->flush();
            $em->remove($trick);
            $em->flush();
        }
        $this->addFlash('error', 'La figure a bien été supprimée');
        return $this->redirectToRoute('admin_home');
    }
}
