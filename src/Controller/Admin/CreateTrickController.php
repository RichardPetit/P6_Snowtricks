<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/tricks/create", name="trick_create")
 */
class CreateTrickController extends AbstractController
{

    public function __invoke(Request $request, EntityManagerInterface $em, TricksRepository $tricksRepository): Response
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $trick->generateSlug();
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'La figure a bien été ajoutée.');

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('create/index.html.twig', [
            'formTrick' => $form->createView(),
        ]);
    }

}
