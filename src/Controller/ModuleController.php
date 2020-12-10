<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    /**
     * @Route("/admin/module/add", name="module_add")
     * @Route("/admin/module/{id}/edit", name="module_edit")
     */
    public function new_update(Module $module = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$module) {
            $module = new Module();
        }

        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($module);
            $manager->flush();

            return $this->redirectToRoute('module');
        }

        return $this->render('module/add_edit.html.twig', [
            'formModule' => $form->createView(),
            'editMode' => $module->getId() !== null,
            'module' => $module
        ]);
    }
    /**
     * @Route("/admin/module/{id}/delete", name="module_delete")
     */
    public function deleteModule(Module $module = null, EntityManagerInterface $manager)
    {
        $manager->remove($module);
        $manager->flush();

        return $this->redirectToRoute('module');
    }
    
    /**
     * @Route("/admin/module", name="module")
     */
    public function index()
    {
        $modules = $this->getDoctrine()
            ->getRepository(Module::class)
            ->findAll();

        return $this->render('module/index.html.twig', ['modules' => $modules,]);
    }

    /**
     * @Route("/formateur/module/{id}", name="module_show", methods="GET")
     */
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', ['module' => $module]);
    }
}
