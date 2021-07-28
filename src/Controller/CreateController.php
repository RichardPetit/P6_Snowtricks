<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     */
    public function index(): Response
    {
        return $this->render('create/index.html.twig', [
            'controller_name' => 'CreateController',
        ]);
    }

    /**
     * @Route("/new", name="program_new", methods={"GET","POST"})
     * @param Request $request
     * @param Slugify $slugify
     * @return Response
     */
    public function new(Request $request, Slugify $slugify): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($trick->getName());
            $trick->setSlug($slug);
            $entityManager->persist($trick);
            $entityManager->flush();


            $this->addFlash('success', 'La figure a été ajoutée');
            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }


}
