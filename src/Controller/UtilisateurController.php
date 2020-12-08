<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur/add", name="utilisateur_add")
     * @Route("/utilisateur/{id}/edit", name="utilisateur_edit")
     */
    public function new_update(Utilisateur $utilisateur = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$utilisateur) {
            $utilisateur = new Utilisateur();
        }

        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($utilisateur);
            $manager->flush();

            return $this->redirectToRoute('utilisateur');
        }

        return $this->render('utilisateur/add_edit.html.twig', [
            'formUtilisateur' => $form->createView(),
            'editMode' => $utilisateur->getId() !== null,
            'utilisateur' => $utilisateur
        ]);
    }
    /**
     * @Route("/direction/utilisateur/{id}/delete", name="utilisateur_delete")
     */
    public function deleteUtilisateur(Utilisateur $utilisateur = null, EntityManagerInterface $manager)
    {
        $manager->remove($utilisateur);
        $manager->flush();

        return $this->redirectToRoute('utilisateur');
    }
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    // public function index(): Response
    // {
    //     return $this->render('utilisateur/index.html.twig', [
    //         'controller_name' => 'utilisateurController',
    //     ]);
    // }
    public function index()
    {
        $utilisateurs = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findAll();

        return $this->render('utilisateur/index.html.twig', ['utilisateurs' => $utilisateurs,]);
    }
    /**
     * @Route("/utilisateur/{id}", name="utilisateur_show", methods="GET")
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', ['utilisateur' => $utilisateur]);
    }

    /**
     * @Route("/changepassword/{id}", name="app_changepassword")
     */
    public function changePassword(
        Utilisateur $utilisateur,
        UserPasswordEncoderInterface $passwordEncoder,
        Request $request,
        EntityManagerInterface $manager
    ) {
        $utilisateur = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldpassword = $form->get('oldpassword')->getData();

            if ($passwordEncoder->isPasswordValid($utilisateur, $oldpassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword(
                    $utilisateur,
                    $form->get('password')->getData()
                );
                // var_dump($newEncodedPassword);
                // die;

                $utilisateur->setPassword($newEncodedPassword);


                // var_dump($utilisateur);
                // die;

                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mdp a été modifié"
                );

                return $this->redirectToRoute('utilisateur');

            }
            else return $this->redirectToRoute('app_login');
        }

        return $this->render('security/changePw.html.twig', array(
            'form' => $form->createView(),
            'title' => 'modification MDP'
        ));
    }
}
