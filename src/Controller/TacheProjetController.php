<?php

namespace App\Controller;

use App\Entity\TacheProjet;
use App\Form\TacheProjetType;
use App\Repository\TacheProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tache/projet')]
final class TacheProjetController extends AbstractController
{
    #[Route(name: 'app_tache_projet_index', methods: ['GET'])]
    public function index(TacheProjetRepository $tacheProjetRepository): Response
    {
        return $this->render('tache_projet/index.html.twig', [
            'tache_projets' => $tacheProjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tache_projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tacheProjet = new TacheProjet();
        $form = $this->createForm(TacheProjetType::class, $tacheProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tacheProjet);
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache_projet/new.html.twig', [
            'tache_projet' => $tacheProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_projet_show', methods: ['GET'])]
    public function show(TacheProjet $tacheProjet): Response
    {
        return $this->render('tache_projet/show.html.twig', [
            'tache_projet' => $tacheProjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_projet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TacheProjet $tacheProjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TacheProjetType::class, $tacheProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache_projet/edit.html.twig', [
            'tache_projet' => $tacheProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_projet_delete', methods: ['POST'])]
    public function delete(Request $request, TacheProjet $tacheProjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tacheProjet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tacheProjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tache_projet_index', [], Response::HTTP_SEE_OTHER);
    }
}
