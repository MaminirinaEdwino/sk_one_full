<?php

namespace App\Controller;

use App\Entity\DocumentProjet;
use App\Form\DocumentProjetType;
use App\Repository\DocumentProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/documentprojet')]
final class DocumentProjetController extends AbstractController
{
    #[Route(name: 'app_document_projet_index', methods: ['GET'])]
    public function index(DocumentProjetRepository $documentProjetRepository): Response
    {
        return $this->render('document_projet/index.html.twig', [
            'document_projets' => $documentProjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $documentProjet = new DocumentProjet();
        $form = $this->createForm(DocumentProjetType::class, $documentProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($documentProjet);
            $entityManager->flush();

            return $this->redirectToRoute('app_document_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_projet/new.html.twig', [
            'document_projet' => $documentProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_projet_show', methods: ['GET'])]
    public function show(DocumentProjet $documentProjet): Response
    {
        return $this->render('document_projet/show.html.twig', [
            'document_projet' => $documentProjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_projet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DocumentProjet $documentProjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentProjetType::class, $documentProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_document_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_projet/edit.html.twig', [
            'document_projet' => $documentProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_projet_delete', methods: ['POST'])]
    public function delete(Request $request, DocumentProjet $documentProjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentProjet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($documentProjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_projet_index', [], Response::HTTP_SEE_OTHER);
    }
}
