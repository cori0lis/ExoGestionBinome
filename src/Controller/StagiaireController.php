<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    // /**
    //  * @Route("/stagiaire", name="stagiaire")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('stagiaire/index.html.twig', [
    //         'controller_name' => 'StagiaireController',
    //     ]);
    // }
    /**
     * @Route("/stagiaire/add", name="stagiaire_add")
     * @Route("/stagiaire/{id}/edit", name="stagiaire_edit")
     */
    public function new_update(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$stagiaire) {
            $stagiaire = new Stagiaire();
        }

        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($stagiaire);
            $manager->flush();

            return $this->redirectToRoute('stagiaire');
        }

        return $this->render('stagiaire/add_edit.html.twig', [
            'formStagiaire' => $form->createView(),
            'editMode' => $stagiaire->getId() !== null,
            'stagiaire' => $stagiaire
        ]);
    }
    /**
     * @Route("/stagiaire", name="stagiaire")
     */
    public function index()
    {
        $stagiaires = $this->getDoctrine()
            ->getRepository(Stagiaire::class)
            ->findAll();

        return $this->render('stagiaire/index.html.twig', ['stagiaires' => $stagiaires,]);
    }
    /**
     * @Route("/stagiaire/{id}", name="stagiaire_show", methods="GET")
     */
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/show.html.twig', ['stagiaire' => $stagiaire]);
    }
}
