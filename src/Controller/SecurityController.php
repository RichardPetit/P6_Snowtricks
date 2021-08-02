<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    /**
//     * @Route("/login", name="app_login")
//     */
//    public function login(AuthenticationUtils $authenticationUtils): Response
//    {
//        // if ($this->getUser()) {
//        //     return $this->redirectToRoute('target_path');
//        // }
//
//        $error = $authenticationUtils->getLastAuthenticationError();
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        return $this->render('security/login.html.twig', ['last_username' => $lastUsername,
//            'error' => $error]);
//    }

//    /**
//     * @Route("/logout", name="app_logout")
//     */
//    public function logout()
//    {
//        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
//    }

//    /**
//     * @Route ("/register", name="security_registration")
//     */
//    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
//    {
//        $user = new User();
//        $form = $this->createForm(RegistrationType::class, $user);
//
//        $form->handleRequest($request);
//         if ($form->isSubmitted() && $form->isValid()){
//             $user->setPassword($passwordHasher->hashPassword($user,$user->getPassword()));
//             $manager->persist($user);
//             $manager->flush();
//
//             return $this->redirectToRoute('app_login');
//         }
//
//        return $this->render('security/registration.html.twig', [
//            'form' => $form->createView()
//            ]);
//    }

    /**
     * @Route("/my-profil", name="profil")
     * @return Response
     */
    public function profilUser(): Response
    {
        return $this->render('security/profil.html.twig');
    }

}
