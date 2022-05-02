<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlUsuariosController extends AbstractController
{
    #[Route('/control/usuarios', name: 'app_control_usuarios')]
    public function index(): Response
    {
        return $this->render('control_usuarios/index.html.twig', [
            'controller_name' => 'ControlUsuariosController',
        ]);
    }
}
