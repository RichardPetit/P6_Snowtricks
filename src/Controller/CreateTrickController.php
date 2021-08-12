<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/trick/create", name="trick_create")
 */
class CreateTrickController extends AbstractController
{

    public function __invoke(Request $request, EntityManagerInterface $em): Response
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('create/index.html.twig', [
            'formTrick' => $form->createView(),
        ]);
    }

    private function renderTrickCreationForm(): Response
    {
        return $this->render('create/index.html.twig', [
            'formTrick' => $form->createView(),
        ]);
    }

}
