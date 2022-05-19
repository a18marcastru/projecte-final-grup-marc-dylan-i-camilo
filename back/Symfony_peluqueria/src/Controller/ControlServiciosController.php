<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlServiciosController extends AbstractController
{
    #[Route('/control/servicios', name: 'app_control_servicios')]
    public function index(): Response
    {
        return $this->render('control_servicios/index.html.twig', [
            'controller_name' => 'ControlServiciosController',
        ]);
    }
}
