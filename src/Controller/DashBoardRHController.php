<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardRHController extends AbstractController
{
    #[Route('/dash/board/r/h', name: 'app_dash_board_r_h')]
    public function index(): Response
    {
        return $this->render('dash_board_rh/index.html.twig', [
            'controller_name' => 'DashBoardRHController',
        ]);
    }
}
