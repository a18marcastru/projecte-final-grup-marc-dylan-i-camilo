<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlEstilosController extends AbstractController
{
    #[Route('/control/estilos', name: 'app_control_estilos')]
    public function index(): Response
    {
        return $this->render('control_estilos/index.html.twig', [
            'controller_name' => 'ControlEstilosController',
        ]);
    }
}
