<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardDGController extends AbstractController
{
    #[Route('/dash/board/d/g', name: 'app_dash_board_d_g')]
    public function index(): Response
    {
        return $this->render('dash_board_dg/index.html.twig', [
            'controller_name' => 'DashBoardDGController',
        ]);
    }
}
