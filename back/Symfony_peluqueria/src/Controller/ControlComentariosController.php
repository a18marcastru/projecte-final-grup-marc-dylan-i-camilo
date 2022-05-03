<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlComentariosController extends AbstractController
{
    #[Route('/control/comentarios', name: 'app_control_comentarios')]
    public function index(): Response
    {
        return $this->render('control_comentarios/index.html.twig', [
            'controller_name' => 'ControlComentariosController',
        ]);
    }
}
