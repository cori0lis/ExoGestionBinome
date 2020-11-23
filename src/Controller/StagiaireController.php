<?php

namespace App\Controller;

use App\Entity\Stagiaire;
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
     * @Route("/stagiaire", name="stagiaire")
     */
    public function index()
    {
        $stagiaires = $this->getDoctrine()
            ->getRepository(Stagiaire::class)
            ->findAll();

        return $this->render('stagiaire/index.html.twig', ['stagiaires' => $stagiaires,]);
    }
}
