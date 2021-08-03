<?php

namespace App\Controller;

use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/edit/trick/{id}", name="edit_trick")
 */
class EditTrickController extends AbstractController
{

    public function __invoke(Tricks $trick, Request $request, EntityManagerInterface $em, $id): Response
    {
        $form = $this->createFormBuilder($trick)
            ->add('name')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if ($trick->getId()){
                $trick->setCreatedAt(new \DateTimeImmutable());
            }
            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);
//            return $this->redirectToRoute('home');

        }

        return $this->render('edit_trick/index.html.twig', [
            'controller_name' => 'EditTrickController',
            'formTrick' => $form->createView(),
            'editMode' =>$trick->getId() !== null
        ]);
    }
}
