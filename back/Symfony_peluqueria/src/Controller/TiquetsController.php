<?php

namespace App\Controller;

use App\Entity\Tiquets;
use App\Form\TiquetsType;
use App\Repository\TiquetsRepository;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tiquets')]
class TiquetsController extends AbstractController
{
    #[Route('/', name: 'app_tiquets_index', methods: ['GET'])]
    public function index(TiquetsRepository $tiquetsRepository): Response
    {
        return $this->render('tiquets/index.html.twig', [
            'tiquets' => $tiquetsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tiquets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TiquetsRepository $tiquetsRepository): Response
    {
        $tiquet = new Tiquets();
        $form = $this->createForm(TiquetsType::class, $tiquet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tiquetsRepository->add($tiquet);
            return $this->redirectToRoute('app_tiquets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tiquets/new.html.twig', [
            'tiquet' => $tiquet,
            'form' => $form,
        ]);
    }

    #[Route('/nuevo/tiquet', name: 'app_tiquet_new2', methods: ['POST','GET'])]
    public function new2(Request $request, TiquetsRepository $tiquetsRepository, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $data = $request->request->all();
        $id = 1;//$data['id_producto'];
        $email = "camilo@gmail.com";//$data['email'];
        $precio_total = 10;//$data['precio_total'];
        $cantidades = 1;//$data['cantidades'];
        $fecha = date("Y-m-d");
        print_r($fecha);
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);

        $tiquetsRepository->save($data_usuario, $fecha, $precio_total);

        $id_usuario = $data_usuario->getId();
        $id_tiquet = $tiquetsRepository->coger_id_tiquet($id_usuario);
        $id2 = $id_tiquet[0]['id'];
        print_r($id2);
        $tiquetsRepository->save2($id2, $id,  $cantidades);

        return new JsonResponse("Nuevo tiquet", Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'app_tiquets_show', methods: ['GET'])]
    public function show(Tiquets $tiquet): Response
    {
        return $this->render('tiquets/show.html.twig', [
            'tiquet' => $tiquet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tiquets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tiquets $tiquet, TiquetsRepository $tiquetsRepository): Response
    {
        $form = $this->createForm(TiquetsType::class, $tiquet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tiquetsRepository->add($tiquet);
            return $this->redirectToRoute('app_tiquets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tiquets/edit.html.twig', [
            'tiquet' => $tiquet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tiquets_delete', methods: ['POST'])]
    public function delete(Request $request, Tiquets $tiquet, TiquetsRepository $tiquetsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tiquet->getId(), $request->request->get('_token'))) {
            $tiquetsRepository->remove($tiquet);
        }

        return $this->redirectToRoute('app_tiquets_index', [], Response::HTTP_SEE_OTHER);
    }
}
