<?php

namespace App\Controller;

use App\Entity\CommentaireDemande;
use App\Entity\DemandeInterne;
use App\Form\CommentaireDemandeType;
use App\Form\DemandeInterneType;
use App\Repository\DemandeInterneRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/demande/interne')]
final class DemandeInterneController extends AbstractController
{
    #[Route(name: 'app_demande_interne_index', methods: ['GET'])]
    public function index(DemandeInterneRepository $demandeInterneRepository): Response
    {
        return $this->render('demande_interne/index.html.twig', [
            'demande_internes' => $demandeInterneRepository->findAll(),
        ]);
    }   

    #[Route('/new', name: 'app_demande_interne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $demandeInterne = new DemandeInterne();
        $form = $this->createForm(DemandeInterneType::class, $demandeInterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeInterne->setAuteur($security->getUser());
            $demandeInterne->setDateEnvoi(new DateTime('now'));
            $demandeInterne->setStatus("Soumis");
            $entityManager->persist($demandeInterne);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_interne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_interne/new.html.twig', [
            'demande_interne' => $demandeInterne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_interne_show', methods: ['GET'])]
    public function show(DemandeInterne $demandeInterne): Response
    {
        $commentaire = new CommentaireDemande();
        $commentaire->setDemande($demandeInterne);
        $form = $this->createForm(CommentaireDemandeType::class, $commentaire);
        
        return $this->render('demande_interne/show.html.twig', [
            'demande_interne' => $demandeInterne,
            'form'=>$form
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_interne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeInterne $demandeInterne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeInterneType::class, $demandeInterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_interne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_interne/edit.html.twig', [
            'demande_interne' => $demandeInterne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_interne_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeInterne $demandeInterne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeInterne->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($demandeInterne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_interne_index', [], Response::HTTP_SEE_OTHER);
    }
}
