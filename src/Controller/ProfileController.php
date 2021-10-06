<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/profile", name="profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function __invoke(Request $request, EntityManagerInterface  $em, User $user = null): Response
    {
        if ($user === null){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->updateProfile($user, $em);

            return $this->redirectToRoute('profile/index.html.twig');
        }

        return $this->renderUserForm($form, $user);
    }

    private function renderUserForm( FormInterface $form, User $user): Response
    {
        return $this->render('profile/index.html.twig', [
            'formTrick' => $form->createView(),
            'user' => $user,
        ]);
    }

    private function updateProfile(User $user, EntityManagerInterface $em)
    {
        $em->persist($user);
        $em->flush();
    }
}
