<?php

namespace App\Controller;

use App\Entity\Servicios;
use App\Form\ServiciosType;
use App\Repository\ServiciosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/servicios')]
class ServiciosController extends AbstractController
{
    #[Route('/', name: 'app_servicios_index', methods: ['GET'])]
    public function index(ServiciosRepository $serviciosRepository): Response
    {
        return $this->render('servicios/index.html.twig', [
            'servicios' => $serviciosRepository->findAll(),
        ]);
    }

    #[Route('/mostrar', name: 'app_servicios_index2', methods: ['GET'])]
    public function mostrar(ServiciosRepository $serviciosRepository): JsonResponse
    {
        $restos = $serviciosRepository->findAll();
        $i = 0;

        foreach ($restos as $res){
            $data_producto[$i] = [
                'nombre_servicio' => $res->getNombreServicio(),
                'precio' => $res->getPrecio()
            ];
            $i++;
        }

        return new JsonResponse($data_producto, Response::HTTP_OK);
    }

    #[Route('/new', name: 'app_servicios_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServiciosRepository $serviciosRepository): Response
    {
        $servicio = new Servicios();
        $form = $this->createForm(ServiciosType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviciosRepository->add($servicio);
            return $this->redirectToRoute('app_servicios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('servicios/new.html.twig', [
            'servicio' => $servicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_servicios_show', methods: ['GET'])]
    public function show(Servicios $servicio): Response
    {
        return $this->render('servicios/show.html.twig', [
            'servicio' => $servicio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_servicios_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Servicios $servicio, ServiciosRepository $serviciosRepository): Response
    {
        $form = $this->createForm(ServiciosType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviciosRepository->add($servicio);
            return $this->redirectToRoute('app_servicios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('servicios/edit.html.twig', [
            'servicio' => $servicio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_servicios_delete', methods: ['POST'])]
    public function delete(Request $request, Servicios $servicio, ServiciosRepository $serviciosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicio->getId(), $request->request->get('_token'))) {
            $serviciosRepository->remove($servicio);
        }

        return $this->redirectToRoute('app_servicios_index', [], Response::HTTP_SEE_OTHER);
    }
}
