<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Form\ModulesType;
use App\Form\SessionType;
use App\Form\StagiaireType;
use App\Form\StagiairesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    /**
     * @Route("/admin/session/add", name="session_add")
     * @Route("/admin/session/{id}/edit", name="session_edit")
     */
    public function new_update(Session $session = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$session) {
            $session = new Session();
        }

        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($session);
            $manager->flush();

            return $this->redirectToRoute('session');
        }

        return $this->render('session/add_edit.html.twig', [
            'formSession' => $form->createView(),
            'editMode' => $session->getId() !== null,
            'session' => $session
        ]);
    }
    /**
     * @Route("/admin/session/{id}/delete", name="session_delete")
     */
    public function deleteSession(Session $session = null, EntityManagerInterface $manager)
    {
        $manager->remove($session);
        $manager->flush();

        return $this->redirectToRoute('session');
    }
    
    /**
     * @Route("/admin/session", name="session")
     */
    public function index()
    {
        $sessions = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findAll();

        return $this->render('session/index.html.twig', ['sessions' => $sessions,]);
    }

    /**
     * @Route("/formateur/session/{id}", name="session_show", methods="GET")
     */
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', ['session' => $session]);
    }
    /**
     * @Route("/calendar", name="session_calendar", methods="GET")
     */
    public function showCal(): Response
    {
        return $this->render('session/sessionCalendar.html.twig');
    }
    /**
     * @Route("/admin/StagiairesInSession/{id}", name="stagiairesInSession")
     */
    public function addStagiaireToSession(Session $session, Request $request, EntityManagerInterface $manager) : Response
    {

        $form =$this->createForm(StagiairesType::class, $session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($session);

            $manager->flush();

            return $this->redirectToRoute('session');
        }
        return $this->render('session/duree.html.twig', [
            'form'=> $form->createView(),
            'session'=> $session,
        ]);
    }
}
