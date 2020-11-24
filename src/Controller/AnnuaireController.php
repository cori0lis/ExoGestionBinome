<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnuaireController extends AbstractController
{
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
}
