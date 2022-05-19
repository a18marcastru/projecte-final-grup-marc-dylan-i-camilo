<?php

namespace App\Controller;

use App\Entity\Comentarios;
use App\Form\ComentariosType;
use App\Repository\ComentariosRepository;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comentarios')]
class ComentariosController extends AbstractController
{
    #[Route('/', name: 'app_comentarios_index', methods: ['GET'])]
    public function index(ComentariosRepository $comentariosRepository): Response
    {
        return $this->render('comentarios/index.html.twig', [
            'comentarios' => $comentariosRepository->findAll(),
        ]);
    }

    public function __construct(UsuariosRepository $usuariosRepository) {
        $this->usuariosRepository = $usuariosRepository;
    }

    #[Route('/mostrar/comentarios', name: 'app_comentarios_index2', methods: ['GET'])]
    public function mostrar(ComentariosRepository $comentariosRepository, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $data_comentarios = $comentariosRepository->mostrarComentarios();


        $comentarios = array_rand($data_comentarios, 2);

        foreach ($comentarios as $key) {
            $id_usuarios[] = $data_comentarios[$key]['usuario_id'];
        }

        for($i = 0;$i < count($id_usuarios);$i++) {
            $data_usuarios[] = $usuariosRepository->coger_ids($id_usuarios[$i]);
        }

        for($i = 0;$i < count($comentarios);$i++) {
            $array_comentarios[$i] = [
                'nombre' => $data_usuarios[$i][0]['nombre'],
                'apellido' => $data_usuarios[$i][0]['apellido'],
                'descripcion' => $data_comentarios[$i]['descripcion'],
                'valoracion' => $data_comentarios[$i]['valoracion']
            ];
        }

        return new JsonResponse($array_comentarios,Response::HTTP_OK);
    }

    #[Route('/nuevo/comentario', name: 'app_comentarios_index4', methods: ['POST','GET'])]
    public function anadir(Request $request, ComentariosRepository $comentariosRepository, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $data = $request->request->all();

        $email = $data['email'];
        $descripcion = $data['descripcion'];
        $valoracion = $data['valoracion'];

        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);

        if(!empty($data_usuario)) {
            $comentariosRepository->save($data_usuario, $descripcion, $valoracion);

            return new JsonResponse("Nuevo Comentario",Response::HTTP_OK);
        }

        return new JsonResponse("Tienes que registrarte",Response::HTTP_OK);
    }

    #[Route('/new', name: 'app_comentarios_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComentariosRepository $comentariosRepository): Response
    {
        $comentario = new Comentarios();
        $form = $this->createForm(ComentariosType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentariosRepository->add($comentario);
            return $this->redirectToRoute('app_comentarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentarios/new.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comentarios_show', methods: ['GET'])]
    public function show(Comentarios $comentario): Response
    {
        return $this->render('comentarios/show.html.twig', [
            'comentario' => $comentario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comentarios_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comentarios $comentario, ComentariosRepository $comentariosRepository): Response
    {
        $form = $this->createForm(ComentariosType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentariosRepository->add($comentario);
            return $this->redirectToRoute('app_comentarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentarios/edit.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comentarios_delete', methods: ['POST'])]
    public function delete(Request $request, Comentarios $comentario, ComentariosRepository $comentariosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comentario->getId(), $request->request->get('_token'))) {
            $comentariosRepository->remove($comentario);
        }

        return $this->redirectToRoute('app_comentarios_index', [], Response::HTTP_SEE_OTHER);
    }
}
