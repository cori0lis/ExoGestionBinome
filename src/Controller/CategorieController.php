<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/admin/categorie/add", name="categorie_add")
     * @Route("/admin/categorie/{id}/edit", name="categorie_edit")
     */
    public function new_update(Categorie $categorie = null, Request $request, EntityManagerInterface $manager)
    {

        if (!$categorie) {
            $categorie = new Categorie();
        }

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('categorie');
        }

        return $this->render('categorie/add_edit.html.twig', [
            'formCategorie' => $form->createView(),
            'editMode' => $categorie->getId() !== null,
            'categorie' => $categorie
        ]);
    }
    /**
     * @Route("/admin/categorie/{id}/delete", name="categorie_delete")
     */
    public function deleteCategorie(Categorie $categorie = null, EntityManagerInterface $manager)
    {
        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute('categorie');
    }
    
    /**
     * @Route("/admin/categorie", name="categorie")
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render('categorie/index.html.twig', ['categories' => $categories,]);
    }

    /**
     * @Route("/formateur/categorie/{id}", name="categorie_show", methods="GET")
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', ['categorie' => $categorie]);
    }
}
