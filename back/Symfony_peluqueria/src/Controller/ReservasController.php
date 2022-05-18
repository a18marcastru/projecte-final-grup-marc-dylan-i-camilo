<?php

namespace App\Controller;

use App\Entity\Reservas;
use App\Form\ReservasType;
use App\Repository\ReservaServicioRepository;
use App\Repository\ReservasRepository;
use App\Repository\ServiciosRepository;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservas')]
class ReservasController extends AbstractController
{
    #[Route('/', name: 'app_reservas_index', methods: ['GET'])]
    public function index(ReservasRepository $reservasRepository): Response
    {
        return $this->render('reservas/index.html.twig', [
            'reservas' => $reservasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservasRepository $reservasRepository): Response
    {
        $reserva = new Reservas();
        $form = $this->createForm(ReservasType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservasRepository->add($reserva);
            return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservas/new.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/nueva/reserva', name: 'app_reserva_new2', methods: ['POST','GET'])]
    public function new2(Request $request, ReservasRepository $reservasRepository, UsuariosRepository $usuariosRepository, ServiciosRepository $serviciosRepository, ReservaServicioRepository $reservaServicioRepository): JsonResponse
    {
        $data = $request->request->all();
        print_r($data);
        /*$data = json_decode($request->getContent(),true);
        for($i = 0;$i < count($data);$i++) {
            $nombre_servicio[$i] = $data[$i]['nombre_servicio'];
        }
        $email = "marc@gmail.com";//$data['email'];
        $precio_total = 30; //$data['precio_total'];
        $dia = date("Y-m-d"); //data['fecha'];
        $hora = date("H:i:s"); //data['hora'];
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        $telefono = $data_usuario->getTelefono();
        $reservasRepository->save($data_usuario, $dia, $hora, $precio_total, $telefono);
        $id_usuario = $data_usuario->getId();
        for($i = 0;$i < count($nombre_servicio);$i++) {
            $data_nombres_servicio = $nombre_servicio[$i];
            $id_reserva = $reservasRepository->coger_reserva($id_usuario, $dia, $hora);
            $data_reserva = $reservasRepository->findOneBy(['id' => $id_reserva]);
            $data_servicio = $serviciosRepository->findOneBy(['nombre_servicio' => $data_nombres_servicio]);
            $reservaServicioRepository->save($data_reserva, $data_servicio);
        }*/

        return new JsonResponse("Gracias por reservar", Response::HTTP_OK);
    }

    #[Route('/cancelar/reserva/{id}', name: 'app_delete', methods: ['POST','GET'])]
    public function cancelar($id, ReservasRepository $reservasRepository, ReservaServicioRepository $reservaServicioRepository): JsonResponse
    {
        $data_id = $reservaServicioRepository->coger_id_reserva_servicio($id);
        print_r($data_id);
        for($i = 0;$i < count($data_id);$i++) {
            $id_reserva = $data_id[$i]['id'];
            $restos = $reservaServicioRepository->findOneBy(['id' => $id_reserva]);
            $reservaServicioRepository->remove($restos);
        }
        $id_reserva2 = $data_id[0]['reserva_id'];
        $restos2 = $reservasRepository->findOneBy(['id' => $id_reserva2]);
        $reservasRepository->remove($restos2);
        return new JsonResponse("Se ha eliminado reserva", Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'app_reservas_show', methods: ['GET'])]
    public function show(Reservas $reserva): Response
    {
        return $this->render('reservas/show.html.twig', [
            'reserva' => $reserva,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservas $reserva, ReservasRepository $reservasRepository): Response
    {
        $form = $this->createForm(ReservasType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservasRepository->add($reserva);
            return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservas/edit.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservas_delete', methods: ['POST'])]
    public function delete(Request $request, Reservas $reserva, ReservasRepository $reservasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserva->getId(), $request->request->get('_token'))) {
            $reservasRepository->remove($reserva);
        }

        return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
    }
}
