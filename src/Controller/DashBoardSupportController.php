<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardSupportController extends AbstractController
{
    #[Route('/dash/board/support', name: 'app_dash_board_support')]
    public function index(): Response
    {
        return $this->render('dash_board_support/index.html.twig', [
            'controller_name' => 'DashBoardSupportController',
        ]);
    }
}
