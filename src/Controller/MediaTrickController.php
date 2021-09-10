<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\TrickMedia;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/media/trick/{id}", name="media_trick")
 */
class MediaTrickController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Trick $trick
     * @return Response
     */
    public function __invoke(Request $request, EntityManagerInterface $em, Trick $trick = null): Response
    {
        if ($trick === null) {
            return $this->redirectToRoute('home');
        }
        $media = new TrickMedia();

        $form = $this->createForm(MediaType::class, $media);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $media->setTrick($trick);
            $this->saveMedia($media, $em);

            $this->addFlash('success', 'Le média a bien été ajouté.');
            return $this->redirectToRoute('home');
        }

        return $this->renderMediaTrickForm($form);
    }

    private function renderMediaTrickForm(FormInterface $form): Response
    {
        return $this->render('media_trick/index.html.twig', [
            'formMedia' => $form->createView(),
        ]);
    }

    private function saveMedia(TrickMedia $trickMedia, EntityManagerInterface $em)
    {
        $em->persist($trickMedia);
        $em->flush();
    }

    private function secondWay(Request $request, EntityManagerInterface $em, Trick $trick){
        //Partie Media

        $trickMedia = new TrickMedia();
        $mediaForm = $this->createForm(MediaType::class, $trickMedia);
        $mediaForm->handleRequest($request);
        if ($mediaForm->isSubmitted() && $mediaForm->isValid()){
            $trickMedia->setTrick($trick);
            $em->persist($trickMedia);
            $em->flush();

            $this->addFlash('success', 'Le média a bien été ajouté.');
        }
    }
}
