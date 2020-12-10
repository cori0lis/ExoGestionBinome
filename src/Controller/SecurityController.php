<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ChangePasswordType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            header('Refresh: 2 URL=/formateur/utilisateur');
            // return $this->redirectToRoute('utilisateur');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
    * @Route("/forgotten_password", name="forgotten_password")
    */
   public function forgotPassword(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator): Response {
   
       if ($request->isMethod('POST')) {
   
           $email = $request->request->get('email');
   
           $utilisateur = $entityManager->getRepository(Utilisateur::class)->findOneByEmail($email);
           /* @var $utilisateur Utilisateur */
//    dd($utilisateur);
           if ($utilisateur === null) {
               $this->addFlash('danger', 'Email Inconnu');
               return $this->redirectToRoute('app_login');
           }
           $token = $tokenGenerator->generateToken();
   
           try{
               $utilisateur->setResetToken($token);
               $entityManager->flush();
           } catch (\Exception $e) {
               $this->addFlash('warning', $e->getMessage());
               return $this->redirectToRoute('app_login');
           }
   
           $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
   
           $message = (new Email())
               ->from('exogestionmattiann@gmail.com')
               ->to($utilisateur->getEmail())
               ->text(
                   "blablabla voici le token pour reseter votre mot de passe : " . $url,
                   'text/html'
               )
               ->html(
                "blablabla voici le token pour reseter votre mot de passe : " . $url,
                'text/html'
            );
   
           $mailer->send($message);
   
           $this->addFlash('success', 'Mail envoyé');
   
           return $this->redirectToRoute('app_login');
       }
   
       return $this->render('security/forgotten_password.html.twig', ['title' => 'Requete mot de passe']);
   }
   /**
    * @Route("/reset_password/{token}", name="reset_password")
    */
   public function resetPassword(EntityManagerInterface $entityManager,Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
   {
       if ($request->isMethod('POST')) {
           $utilisateur = $entityManager->getRepository(Utilisateur::class)->findOneByResetToken($token);
           /* @var $utilisateur Utilisateur */
           if ($utilisateur === null) {
               $this->addFlash('danger', 'Token Inconnu');
               return $this->redirectToRoute('app_login');
           }
           $utilisateur->setResetToken(null);
           $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur, $request->request->get('password')));
           $entityManager->flush();
           $this->addFlash('success', 'Mot de passe mis à jour');
           return $this->redirectToRoute('app_login');
       }else {
           return $this->render('security/reset_password.html.twig', ['token' => $token]);
       }
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
