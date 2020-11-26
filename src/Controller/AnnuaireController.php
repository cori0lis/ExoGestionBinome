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

class AnnuaireController extends AbstractController
{
    /**
     * @Route("/annuaire/add", name="annuaire_add")
     * @Route("/annuaire/{id}/edit", name="annuaire_edit")
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

            return $this->redirectToRoute('annuaire');
        }

        return $this->render('annuaire/add_edit.html.twig', [
            'formAnnuaire' => $form->createView(),
            'editMode' => $utilisateur->getId() !== null,
            'utilisateur' => $utilisateur
        ]);
    }
    /**
     * @Route("annuaire/{id}/delete", name="annuaire_delete")
     */
    public function deleteUtilisateur(Utilisateur $utilisateur = null, EntityManagerInterface $manager)
    {
        $manager->remove($utilisateur);
        $manager->flush();

        return $this->redirectToRoute('annuaire');
    }
    /**
     * @Route("/annuaire", name="annuaire")
     */
    // public function index(): Response
    // {
    //     return $this->render('annuaire/index.html.twig', [
    //         'controller_name' => 'AnnuaireController',
    //     ]);
    // }
    public function index()
    {
        $utilisateurs = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findAll();

        return $this->render('annuaire/index.html.twig', ['utilisateurs' => $utilisateurs,]);
    }
    /**
     * @Route("/annuaire/{id}", name="annuaire_show", methods="GET")
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('annuaire/show.html.twig', ['utilisateur' => $utilisateur]);
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
        $form = $this->createForm(ChangePasswordType::class);
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

                return $this->redirectToRoute('annuaire');
            }
        }

        return $this->render('security/changePw.html.twig', array(
            'form' => $form->createView(),
            'title' => 'modification MDP'
        ));
    }
}
