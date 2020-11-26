<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation/add", name="formation_add")
     * @Route("/formation/{id}/edit", name="formation_edit")
     */
    public function new_update(Formation $formation = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$formation) {
            $formation = new Formation();
        }

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($formation);
            $manager->flush();

            return $this->redirectToRoute('formation');
        }

        return $this->render('formation/add_edit.html.twig', [
            'formFormation' => $form->createView(),
            'editMode' => $formation->getId() !== null,
            'formation' => $formation
        ]);
    }
    /**
     * @Route("formation/{id}/delete", name="formation_delete")
     */
    public function deleteFormation(Formation $formation = null, EntityManagerInterface $manager)
    {
        $manager->remove($formation);
        $manager->flush();

        return $this->redirectToRoute('formation');
    }
    /**
     * @Route("/formation", name="formation")
     */
    // public function index(): Response
    // {
    //     return $this->render('formation/index.html.twig', [
    //         'controller_name' => 'FormationController',
    //     ]);
    // }
    public function index()
    {
        $formations = $this->getDoctrine()
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('formation/index.html.twig', ['formations' => $formations,]);
    }
    /**
     * @Route("/formation/{id}", name="formation_show", methods="GET")
     */
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', ['formation' => $formation]);
    }
}
