<?php

namespace App\Controller;

use App\Entity\CategorieFonctionnelle;
use App\Form\CategorieFonctionnelleType;
use App\Repository\CategorieFonctionnelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/categorie/fonctionnelle')]
final class CategorieFonctionnelleController extends AbstractController
{
    #[Route(name: 'app_categorie_fonctionnelle_index', methods: ['GET'])]
    public function index(CategorieFonctionnelleRepository $categorieFonctionnelleRepository): Response
    {
        return $this->render('categorie_fonctionnelle/index.html.twig', [
            'categorie_fonctionnelles' => $categorieFonctionnelleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_fonctionnelle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieFonctionnelle = new CategorieFonctionnelle();
        $form = $this->createForm(CategorieFonctionnelleType::class, $categorieFonctionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieFonctionnelle);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_fonctionnelle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_fonctionnelle/new.html.twig', [
            'categorie_fonctionnelle' => $categorieFonctionnelle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_fonctionnelle_show', methods: ['GET'])]
    public function show(CategorieFonctionnelle $categorieFonctionnelle): Response
    {
        return $this->render('categorie_fonctionnelle/show.html.twig', [
            'categorie_fonctionnelle' => $categorieFonctionnelle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_fonctionnelle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieFonctionnelle $categorieFonctionnelle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieFonctionnelleType::class, $categorieFonctionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_fonctionnelle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_fonctionnelle/edit.html.twig', [
            'categorie_fonctionnelle' => $categorieFonctionnelle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_fonctionnelle_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieFonctionnelle $categorieFonctionnelle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieFonctionnelle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categorieFonctionnelle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_fonctionnelle_index', [], Response::HTTP_SEE_OTHER);
    }
}
