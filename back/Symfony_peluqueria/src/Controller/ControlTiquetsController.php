<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlTiquetsController extends AbstractController
{
    #[Route('/control/tiquets', name: 'app_control_tiquets')]
    public function index(): Response
    {
        return $this->render('control_tiquets/index.html.twig', [
            'controller_name' => 'ControlTiquetsController',
        ]);
    }
}
