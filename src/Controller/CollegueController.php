<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollegueController extends AbstractController
{
    /**
     * @Route("/collegue", name="collegue")
     */
    public function index(): Response
    {
        return $this->render('collegue/index.html.twig', [
            'controller_name' => 'CollegueController',
        ]);
    }
}
