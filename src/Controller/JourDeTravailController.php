<?php

namespace App\Controller;

use App\Entity\JourDeTravail;
use App\Form\JourDeTravailType;
use App\Repository\JourDeTravailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jour/de/travail')]
final class JourDeTravailController extends AbstractController
{
    #[Route(name: 'app_jour_de_travail_index', methods: ['GET'])]
    public function index(JourDeTravailRepository $jourDeTravailRepository): Response
    {
        return $this->render('jour_de_travail/index.html.twig', [
            'jour_de_travails' => $jourDeTravailRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jour_de_travail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jourDeTravail = new JourDeTravail();
        $form = $this->createForm(JourDeTravailType::class, $jourDeTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jourDeTravail);
            $entityManager->flush();

            return $this->redirectToRoute('app_jour_de_travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jour_de_travail/new.html.twig', [
            'jour_de_travail' => $jourDeTravail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jour_de_travail_show', methods: ['GET'])]
    public function show(JourDeTravail $jourDeTravail): Response
    {
        return $this->render('jour_de_travail/show.html.twig', [
            'jour_de_travail' => $jourDeTravail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jour_de_travail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JourDeTravail $jourDeTravail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JourDeTravailType::class, $jourDeTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jour_de_travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jour_de_travail/edit.html.twig', [
            'jour_de_travail' => $jourDeTravail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jour_de_travail_delete', methods: ['POST'])]
    public function delete(Request $request, JourDeTravail $jourDeTravail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jourDeTravail->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($jourDeTravail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jour_de_travail_index', [], Response::HTTP_SEE_OTHER);
    }
}
