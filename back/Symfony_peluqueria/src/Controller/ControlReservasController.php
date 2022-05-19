<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlReservasController extends AbstractController
{
    #[Route('/control/reservas', name: 'app_control_reservas')]
    public function index(): Response
    {
        return $this->render('control_reservas/index.html.twig', [
            'controller_name' => 'ControlReservasController',
        ]);
    }
}
