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
            if ($security->getUser()->getRoles()[0] === 'ROLE_DG') {
                return $this->redirectToRoute('app_dash_board_d_g');
            }
            if ($security->getUser()->getRoles()[0] === 'ROLE_RH') {
                return $this->redirectToRoute('app_dash_board_r_h');
            }
            if ($security->getUser()->getRoles()[0] === 'ROLE_COLLABORATEUR') {
                return $this->redirectToRoute('app_dash_board_collaborateur');
            }
            if ($security->getUser()->getRoles()[0] === 'ROLE_SUPPORT') {
                return $this->redirectToRoute('app_dash_board_support');
            }
        }
       
        return $this->redirectToRoute('app_login');
    }
}
