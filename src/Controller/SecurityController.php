<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    // /**
    //  * @Route("/forgotten_password", name="forgotten_password")
    //  */
    // public function forgottenPassword(EntityManagerInterface $manager, Request $request, MailerInterface $mailer, TokenGeneratorInterface $tokengenerator): Response
    // {
// si cest en methode POST
// alors chercher $email
// email == email du formulaire
// trouver $user par son email (verifier si mail existe)
// $token = $tokengenerator -> generateToken();
// set le resetToken de lutlisateur (faut ajouter resettoken dans BDD user)
// flush
// $url = $this -> generateUrl(??)
// $message
// $mailer -> send($message)
// return $this -> render('security/forgotten_password.html.twig', ['title' => 'requete mdp']);
// }

// /**
//  * @Route("/reset_password/{token}", name="reset_password")
//  */

    // public function resetPassword(EntityManagerInterface $manager, Request $request, UserPasswordEncoderInterface $passwordEncoder, string $token){
// si methode POST
// alors $user findOneByResetToken($token)
// set $token = null, encoder password, flush
// return à la page quon veut
    // }
}
