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
    public function index(ReservasRepository $reservasRepository, UsuariosRepository $usuariosRepository): Response
    {
        $data_reservas = $reservasRepository->findAll();

        foreach ($data_reservas as $key) {
            $id_usuarios[] = $key->getId();
        }

        for($i = 0;$i < count($id_usuarios);$i++) {
            $data_usuarios[$i] = $usuariosRepository->coger_emails_telefonos($id_usuarios[$i]);
        }

        for($i = 0;$i < count($data_reservas);$i++) {
            $data_email[$i] = $data_usuarios[$i][0]['email'];
            $data_telefono[$i] = $data_usuarios[$i][0]['telefono'];
        }

        $i = 0;
        foreach($data_reservas as $key) {
            $array_reservas[$i] = [
                'id' => $key->getId(),
                'email' => $data_email[$i],
                'telefono' => $data_telefono[$i],
                'hora' => $key->getHora(),
                'dia' => $key->getDia(),
                'mes' => $key->getMes(),
                'precioTotal' => $key->getPrecioTotal()
            ];
            $i++;
        }

        return $this->render('reservas/index.html.twig', [
            'reservas' => $array_reservas,
        ]);
    }

    #[Route('/buscar', name: 'app_reservas_index2', methods: ['POST','GET'])]
    public function search(UsuariosRepository $usuariosRepository, ReservaServicioRepository $reservaServicioRepository): Response
    {
        $data_usuario = $usuariosRepository->findOneBy(['email' => $_POST['email']]);
        $id = $data_usuario->getId();
        $data_reservas_servicio = $reservaServicioRepository->coger_reserva_servicio($id);


        return $this->render('reservas/resultado.html.twig', [
            'reservas_servicio' => $data_reservas_servicio,
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

    #[Route('/todas', name: 'app_reservas_todas', methods: ['GET'])]
    public function mostrar(ReservasRepository $reservasRepository): JsonResponse
    {
        $reservas = $reservasRepository->findAll();

        $i = 0;
        foreach ($reservas as $key) {
            $data_reservas[$i] = [
                'hora' => $key->getHora(),
                'dia' => $key->getDia()
            ];
            $i++;
        }

        return new JsonResponse($data_reservas, Response::HTTP_OK);
    }

    #[Route('/nueva/reserva', name: 'app_reserva_new2', methods: ['POST','GET'])]
    public function new2(Request $request, ReservasRepository $reservasRepository, UsuariosRepository $usuariosRepository, ServiciosRepository $serviciosRepository, ReservaServicioRepository $reservaServicioRepository): JsonResponse
    {
        $data = $request->request->all();
        $array = json_decode($data['servicios'],true);

        for($i = 0;$i < count($array);$i++) {
            $nombre_servicio[$i] = $array[$i]['nombre_servicio'];
        }
        $email = $data['email'];
        $precio_total = $data['precio_total'];
        $dia = $data['dia'];
        $hora = $data['hora'];
        $mes = $data['mes'];
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        $reservasRepository->save($data_usuario, $dia, $hora, $mes, $precio_total);
        $id_usuario = $data_usuario->getId();
        for($i = 0;$i < count($nombre_servicio);$i++) {
            $data_nombres_servicio = $nombre_servicio[$i];
            $id_reserva = $reservasRepository->coger_reserva($id_usuario, $dia, $mes, $hora);
            $data_reserva = $reservasRepository->findOneBy(['id' => $id_reserva]);
            $data_servicio = $serviciosRepository->findOneBy(['nombre_servicio' => $data_nombres_servicio]);
            $reservaServicioRepository->save($data_reserva, $data_servicio);
        }

        return new JsonResponse("Gracias por reservar", Response::HTTP_OK);
    }

    /*#[Route('/cancelar/reserva/{id}', name: 'app_delete', methods: ['DELETE','GET'])]
    public function cancelar($id, ReservasRepository $reservasRepository, ReservaServicioRepository $reservaServicioRepository): JsonResponse
    {
        $data_id = $reservaServicioRepository->coger_id_reserva_servicio($id);
        for($i = 0;$i < count($data_id);$i++) {
            $id_reserva = $data_id[$i]['id'];
            $restos = $reservaServicioRepository->findOneBy(['id' => $id_reserva]);
            $reservaServicioRepository->remove($restos);
        }
        $id_reserva2 = $data_id[0]['reserva_id'];
        $restos2 = $reservasRepository->findOneBy(['id' => $id_reserva2]);
        $reservasRepository->remove($restos2);
        return new JsonResponse("Se ha eliminado reserva", Response::HTTP_OK);
    }*/

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
