<?php

namespace App\Controller;

use App\Entity\Tickets;
use App\Form\TicketsType;
use App\Repository\TicketProductoRepository;
use App\Repository\ProductosRepository;
use App\Repository\TicketsRepository;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tickets')]
class TicketsController extends AbstractController
{
    #[Route('/', name: 'app_tickets_index', methods: ['GET'])]
    public function index(TicketsRepository $ticketsRepository, UsuariosRepository $usuariosRepository): Response
    {
        $data_tickets = $ticketsRepository->findAll();

        foreach ($data_tickets as $key) {
            $id_usuarios[] = $key->getUsuario();
        }

        for($i = 0;$i < count($id_usuarios);$i++) {
            $data_usuarios[$i] = $usuariosRepository->coger_emails_telefonos($id_usuarios[$i]);
        }

        for($i = 0;$i < count($data_tickets);$i++) {
            $data_email[$i] = $data_usuarios[$i][0]['email'];
            $data_telefono[$i] = $data_usuarios[$i][0]['telefono'];
        }

        $i = 0;
        foreach($data_tickets as $key) {
            $array_tickets[$i] = [
                'id' => $key->getId(),
                'email' => $data_email[$i],
                'telefono' => $data_telefono[$i],
                'fecha' => $key->getFecha(),
                'precioTotal' => $key->getPrecioTotal()
            ];
            $i++;
        }

        return $this->render('tickets/index.html.twig', [
            'tickets' => $array_tickets,
        ]);
    }

    #[Route('/buscar', name: 'app_tickets_index2', methods: ['POST','GET'])]
    public function search(UsuariosRepository $usuariosRepository, TicketProductoRepository $ticketProductoRepository): Response
    {
        $data_usuario = $usuariosRepository->findOneBy(['email' => $_POST['email']]);
        $id = $data_usuario->getId();
        $data_compra = $ticketProductoRepository->coger_compra($id);


        return $this->render('tickets/resultado.html.twig', [
            'tickets' => $data_compra,
        ]);
    }

    #[Route('/new', name: 'app_tickets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TicketsRepository $ticketsRepository): Response
    {
        $ticket = new Tickets();
        $form = $this->createForm(TicketsType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketsRepository->add($ticket);
            return $this->redirectToRoute('app_tickets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tickets/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/nuevo/ticket', name: 'app_ticket_new2', methods: ['POST','GET'])]
    public function new2(Request $request, TicketsRepository $ticketsRepository, UsuariosRepository $usuariosRepository, TicketProductoRepository $ticketProductoRepository, ProductosRepository $productosRepository): JsonResponse
    {
        $data = $request->request->all();
        $array = json_decode($data['productos'],true);

        for($i = 0;$i < count($array);$i++) {
            $nombre[$i] = $array[$i]['nombre'];
            $cantidades[$i] = $array[$i]['cantidades'];
        }
        $email = $data['email'];
        $precio_total = $data['precio_total'];
        $fecha = date("Y-m-d H:i:s");
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        if(!empty($data_usuario)) {
            $ticketsRepository->save($data_usuario, $fecha, $precio_total);
            for($i = 0;$i < count($nombre);$i++) {
                $data_nombres = $nombre[$i];
                $id_usuario = $data_usuario->getId();
                $id_ticket = $ticketsRepository->coger_ticket($id_usuario, $fecha);
                $data_ticket = $ticketsRepository->findOneBy(['id' => $id_ticket]);
                $data_producto = $productosRepository->findOneBy(['nombre' => $data_nombres]);
                $cantidad = $data_producto->getCantidad();
                $data_cantidades_total = $cantidad - $cantidades[$i];

                empty($data_cantidades_total) ? true : $data_producto->setCantidad($data_cantidades_total);

                $data_cantidades = $cantidades[$i];
                $ticketProductoRepository->save($data_ticket, $data_producto,  $data_cantidades);
            }

            return new JsonResponse("Gracias por comprar", Response::HTTP_OK);
        }

        return new JsonResponse("No existe usuario", Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'app_tickets_show', methods: ['GET'])]
    public function show(Tickets $ticket): Response
    {
        return $this->render('tickets/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tickets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tickets $ticket, TicketsRepository $ticketsRepository): Response
    {
        $form = $this->createForm(TicketsType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketsRepository->add($ticket);
            return $this->redirectToRoute('app_tickets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tickets/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tickets_delete', methods: ['POST'])]
    public function delete(Request $request, Tickets $ticket, TicketsRepository $ticketsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $ticketsRepository->remove($ticket);
        }

        return $this->redirectToRoute('app_tickets_index', [], Response::HTTP_SEE_OTHER);
    }
}
