<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/edit/trick/{id}", name="edit_trick")
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


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->updateTrick($trick, $em);

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);

        }

        return $this->renderTrickForm($form);
    }


    private function renderTrickForm(FormInterface $form): Response
    {
        return $this->render('edit_trick/index.html.twig', [
            'formTrick' => $form->createView(),
        ]);
    }

    private function updateTrick(Trick $trick, EntityManagerInterface $em)
    {
        $em->persist($trick);
        $em->flush();
    }

}
