<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RedirectionController extends AbstractController
{
    #[Route('/', name: 'app_redirection')]
    public function index(Security $security): Response
    {
        if ($security->getUser()) {
            if ($security->getUser()->getRoles()[0] === 'ROLE_PDG') {
                return $this->redirectToRoute('app_dash_board_p_d_g');
            }
        }
        return $this->redirectToRoute('app_login');
    }
}
