<?php

namespace App\Controller\Admin;

use App\Entity\TrickMedia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/medias/{id}/delete", name="delete_media", methods={"GET"})
 * @param TrickMedia $media
 * @param EntityManagerInterface $em
 * @return Response
 */
class DeleteMediaController extends AbstractController
{

    public function __invoke(EntityManagerInterface $em, TrickMedia $media): Response
    {
        if ($media !==null){
            $trick = $media->getTrick();
            $em->remove($media);
            $em->flush();

            $this->addFlash('error', 'Le media a bien été supprimé');

            return $this->redirectToRoute('edit_trick', ['id'=> $trick->getId()]);

        }

        return $this->redirectToRoute('admin_home');

    }
}
