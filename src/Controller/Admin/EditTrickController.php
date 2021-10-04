<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Entity\TrickMedia;
use App\Form\MediaType;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/admin/tricks/{id}", name="edit_trick", methods={"GET", "POST"})
 */
class EditTrickController extends AbstractController
{
    /**
     * @param Trick $trick
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function __invoke(Request $request, EntityManagerInterface $em, Trick $trick = null): Response
    {
        if ($trick === null) {
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(TrickType::class, $trick);

        $media = new TrickMedia();
        $formMedia = $this->createForm(MediaType::class, $media);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->updateTrick($trick, $em);

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);

        }
        $formMedia->handleRequest($request);
        if ($formMedia->isSubmitted() && $formMedia->isValid()){
            $media->setTrick($trick);
            $this->saveMedia($media, $em);

            $this->addFlash('success', 'Le média a bien été ajouté.');
            return $this->redirectToRoute('edit_trick', ['id' => $trick->getId()]);
        }

        return $this->renderTrickForm($form, $formMedia, $trick);
    }


    private function renderTrickForm(FormInterface $form, FormInterface $formMedia, Trick $trick): Response
    {
        return $this->render('edit_trick/index.html.twig', [
            'formTrick' => $form->createView(),
            'formMedia' => $formMedia->createView(),
            'trick' => $trick,
        ]);
    }

    private function updateTrick(Trick $trick, EntityManagerInterface $em)
    {
        $trick->generateSlug();
        $em->persist($trick);
        $em->flush();
    }

    private function saveMedia(TrickMedia $trickMedia, EntityManagerInterface $em)
    {
        $em->persist($trickMedia);
        $em->flush();
    }

}
