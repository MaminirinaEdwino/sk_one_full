<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardCollaborateurController extends AbstractController
{
    #[Route('/dash/board/collaborateur', name: 'app_dash_board_collaborateur')]
    public function index(): Response
    {
        return $this->render('dash_board_collaborateur/index.html.twig', [
            'controller_name' => 'DashBoardCollaborateurController',
        ]);
    }
}
