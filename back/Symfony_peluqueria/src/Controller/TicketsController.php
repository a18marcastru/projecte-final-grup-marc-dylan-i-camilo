<?php

namespace App\Controller;

use App\Entity\Tickets;
use App\Form\TicketsType;
use App\Repository\ComprarRepository;
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
    public function index(TicketsRepository $ticketsRepository): Response
    {
        return $this->render('tickets/index.html.twig', [
            'tickets' => $ticketsRepository->findAll(),
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
    public function new2(Request $request, TicketsRepository $ticketsRepository, UsuariosRepository $usuariosRepository, ComprarRepository $comprarRepository, ProductosRepository $productosRepository): JsonResponse
    {
        $data = $request->request->all();
        print_r($data);
        for($i = 0;$i < 2;$i++) {
            $nombre[$i] = $data[$i]['nombre'];
            //$cantidades[$i] = $data['cantidades'];
        }
        $email = $data['email'];
        $precio_total = $data['precio_total'];
        $fecha = date("Y-m-d H:i:s");
        print_r($nombre);
        for($i = 0;$i < count($cantidades);$i++) {
            $data_nombres = $nombre[$i];
            $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);

            $ticketsRepository->save($data_usuario, $fecha, $precio_total);
            $data_ticket = $ticketsRepository->findOneBy(['fecha' => $fecha]);
            $data_producto = $productosRepository->findOneBy(['nombre' => $data_nombres]);
            $data_cantidades = $cantidades[$i];
            $comprarRepository->save($data_ticket, $data_producto,  $data_cantidades);
        }

        return new JsonResponse("Nuevo tiquet", Response::HTTP_OK);
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