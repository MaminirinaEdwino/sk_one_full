<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardPDGController extends AbstractController
{
    #[Route('/dash/board/p/d/g', name: 'app_dash_board_p_d_g')]
    public function index(Security $security): Response
    {
        if ($security->getUser()) {
            return $this->render('dash_board_pdg/index.html.twig', [
                'controller_name' => 'DashBoardPDGController',
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
}
