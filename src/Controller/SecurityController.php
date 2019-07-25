<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'title' => 'Login', 'login' => true]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/show/getAll", name="user_get_all")
     */
    public function getAllUser(ObjectManager $em){

        $users = $em->getRepository(User::class)->findAll();

        return $this->render('show/allUsers.html.twig', [
            'title' => 'Liste des utilisateurs',
            'users' => $users
        ]);
    }


    /**
    * @Route("/delete/{id}", name="user_delete")
    */
    public function deleteUser($id, ObjectManager $em){

        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
        throw $this->createNotFoundException(
        'There are no User with the following id: ' . $id);
        } else {
            $em->remove($user);
            $em->flush();
            return $this->redirectToRoute('user_get_all');
        }
        return $this->redirectToRoute('user_get_all');
    }
}
