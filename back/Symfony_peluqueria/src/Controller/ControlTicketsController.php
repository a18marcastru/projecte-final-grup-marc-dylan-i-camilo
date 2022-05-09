<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlTicketsController extends AbstractController
{
    #[Route('/control/tickets', name: 'app_control_tickets')]
    public function index(): Response
    {
        return $this->render('control_tickets/index.html.twig', [
            'controller_name' => 'ControlTicketsController',
        ]);
    }
}
