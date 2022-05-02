<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlProductosController extends AbstractController
{
    #[Route('/control/productos', name: 'app_control_productos')]
    public function index(): Response
    {
        return $this->render('control_productos/index.html.twig', [
            'controller_name' => 'ControlProductosController',
        ]);
    }
}
