<?php

namespace App\Controller;

use App\Entity\CommentaireDemande;
use App\Entity\DemandeInterne;
use App\Form\CommentaireDemandeType;
use App\Repository\CommentaireDemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commentaire/demande')]
final class CommentaireDemandeController extends AbstractController
{
    #[Route(name: 'app_commentaire_demande_index', methods: ['GET'])]
    public function index(CommentaireDemandeRepository $commentaireDemandeRepository): Response
    {
        return $this->render('commentaire_demande/index.html.twig', [
            'commentaire_demandes' => $commentaireDemandeRepository->findAll(),
        ]);
    }

    #[Route('/new/{demande}', name: 'app_commentaire_demande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, DemandeInterne $demande, Security $security): Response
    {
        $commentaireDemande = new CommentaireDemande();
        $commentaireDemande->setDemande($demande);
        $commentaireDemande->setAuteur($security->getUser());
        $form = $this->createForm(CommentaireDemandeType::class, $commentaireDemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaireDemande);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_interne_show', ['id'=>$demande->getId(), 302]);
        }

        return $this->render('commentaire_demande/new.html.twig', [
            'commentaire_demande' => $commentaireDemande,
            'form' => $form,
        ]);
        
    }

    #[Route('/{id}', name: 'app_commentaire_demande_show', methods: ['GET'])]
    public function show(CommentaireDemande $commentaireDemande): Response
    {
        return $this->render('commentaire_demande/show.html.twig', [
            'commentaire_demande' => $commentaireDemande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commentaire_demande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommentaireDemande $commentaireDemande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentaireDemandeType::class, $commentaireDemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commentaire_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentaire_demande/edit.html.twig', [
            'commentaire_demande' => $commentaireDemande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_demande_delete', methods: ['POST'])]
    public function delete(Request $request, CommentaireDemande $commentaireDemande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireDemande->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($commentaireDemande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commentaire_demande_index', [], Response::HTTP_SEE_OTHER);
    }
}
