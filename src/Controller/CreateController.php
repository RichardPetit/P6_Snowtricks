<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Service\Slugify;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateController extends AbstractController
{
    /**
     * @Route("/create", name="trick_create")
     * @Route("/edit/{id}", name="trick_edit")
     */
    public function index(Tricks $trick = null,Request $request): Response
    {

        if (!$trick){
            $trick = new Tricks();
        }

        $form = $this->createFormBuilder($trick)
            ->add('name')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if ($trick->getId()){
                $trick->setCreatedAt(new \DateTimeImmutable());
            }
//            $manager->persist($trick);
//            $manager->flush();

//            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);
            return $this->redirectToRoute('home');

        }

        return $this->render('create/index.html.twig', [
            'formTrick' => $form->createView(),
//            'editMode' =>$trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/new", name="trick_new", methods={"GET","POST"})
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
            return $this->redirectToRoute('home');
        }

        return $this->render('create/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }


}
