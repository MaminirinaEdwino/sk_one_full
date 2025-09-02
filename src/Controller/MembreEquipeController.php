<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\MembreEquipe;
use App\Form\MembreEquipeType;
use App\Repository\MembreEquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/membre/equipe')]
final class MembreEquipeController extends AbstractController
{
    #[Route(name: 'app_membre_equipe_index', methods: ['GET'])]
    public function index(MembreEquipeRepository $membreEquipeRepository): Response
    {
        return $this->render('membre_equipe/index.html.twig', [
            'membre_equipes' => $membreEquipeRepository->findAll(),
        ]);
    }

    #[Route('/new/{equipe}', name: 'app_membre_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Equipe $equipe, MembreEquipeRepository $membreRepository): Response
    {
        $membreEquipe = new MembreEquipe();
        $membreEquipe->setEquipe($equipe);
        $form = $this->createForm(MembreEquipeType::class, $membreEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tmp = $membreRepository->findBy(['membre'=>$membreEquipe->getMembre(), 'equipe'=>$membreEquipe->getEquipe()]);
            if (count($tmp) == 0) {
                $entityManager->persist($membreEquipe);
                $entityManager->flush();
            }
           
            return $this->redirectToRoute('app_equipe_show', ['id'=>$equipe->getId(), ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('membre_equipe/new.html.twig', [
            'membre_equipe' => $membreEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_membre_equipe_show', methods: ['GET'])]
    public function show(MembreEquipe $membreEquipe): Response
    {
        return $this->render('membre_equipe/show.html.twig', [
            'membre_equipe' => $membreEquipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_membre_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MembreEquipe $membreEquipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MembreEquipeType::class, $membreEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_membre_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('membre_equipe/edit.html.twig', [
            'membre_equipe' => $membreEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/equipe/{equipe}', name: 'app_membre_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, MembreEquipe $membreEquipe, EntityManagerInterface $entityManager, Equipe $equipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membreEquipe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($membreEquipe);
            $entityManager->flush();
            return $this->redirectToRoute('app_equipe_show', [
                'id'=>$equipe->getId()
            ]);
        }

        return $this->redirectToRoute('app_membre_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
