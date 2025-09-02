<?php

namespace App\Controller;

use App\Entity\TacheNormale;
use App\Form\TacheNormaleType;
use App\Repository\TacheNormaleRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tache/normale')]
final class TacheNormaleController extends AbstractController
{
    #[Route(name: 'app_tache_normale_index', methods: ['GET'])]
    public function index(TacheNormaleRepository $tacheNormaleRepository): Response
    {
        return $this->render('tache_normale/index.html.twig', [
            'tache_normales' => $tacheNormaleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tache_normale_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $tacheNormale = new TacheNormale();
        $form = $this->createForm(TacheNormaleType::class, $tacheNormale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tacheNormale->setDateCreation(new DateTime('now'));
            // $tacheNormale->setStatus('')
            $tacheNormale->setAssignant($security->getUser());
            $entityManager->persist($tacheNormale);

            $entityManager->flush();

            return $this->redirectToRoute('app_tache_normale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache_normale/new.html.twig', [
            'tache_normale' => $tacheNormale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_normale_show', methods: ['GET'])]
    public function show(TacheNormale $tacheNormale): Response
    {
        return $this->render('tache_normale/show.html.twig', [
            'tache_normale' => $tacheNormale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_normale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TacheNormale $tacheNormale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TacheNormaleType::class, $tacheNormale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_normale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache_normale/edit.html.twig', [
            'tache_normale' => $tacheNormale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_normale_delete', methods: ['POST'])]
    public function delete(Request $request, TacheNormale $tacheNormale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tacheNormale->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tacheNormale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tache_normale_index', [], Response::HTTP_SEE_OTHER);
    }
}
