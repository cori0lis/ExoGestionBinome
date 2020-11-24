<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
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
}
