<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\UsuariosType;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/usuarios')]
class UsuariosController extends AbstractController
{
    #[Route('/', name: 'app_usuarios_index', methods: ['GET'])]
    public function index(UsuariosRepository $usuariosRepository): Response
    {
        return $this->render('usuarios/index.html.twig', [
            'usuarios' => $usuariosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_usuarios_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsuariosRepository $usuariosRepository): Response
    {
        $usuario = new Usuarios();
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuariosRepository->add($usuario);
            return $this->redirectToRoute('app_usuarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuarios/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/nuevo/usuario', name: 'app_usuarios_new2', methods: ['GET','POST'])]
    public function new2(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $data = $request->request->all();

        $nombre = "Marc"; //$data['nombre'];
        $apellido = "Castro"; //$data['apellido'];
        $email = "marc@gmail.com"; //$data['email'];
        $contrasena = password_hash("Marcfv1302*?*", PASSWORD_DEFAULT);
        //$data['contrasena'];

        $usuariosRepository->save($nombre, $apellido, $email, $contrasena);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/login', name: 'app_usuarios_login', methods: ['GET','POST'])]
    public function login(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $data = $request->request->all();

        $email = "marc@gmail.com"; //$data['email'];
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        $data_contras = $data_usuario->getContrasena();
        //$data['contrasena'];

        if (password_verify("Marcfv1302*?*", $data_contras)) {
            $num = 1;
            print_r('¡La contraseña es válida!');
        } else {
            $num = 2;
            print_r('La contraseña no es válida.');
        }

        return new JsonResponse($num, Response::HTTP_OK);
    }

    #[Route('/perfil/{id}', name: 'app_usuarios_perfil', methods: ['GET'])]
    public function show2($id, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $restos = $usuariosRepository->findOneBy(['id' => $id]);

        $data_usuario = [
            'nombre' => $restos->getNombre(),
            'apellido' => $restos->getApellido(),
            'email' => $restos->getEmail()
        ];

        print_r($data_usuario);

        return new JsonResponse($data_usuario, Response::HTTP_OK);
    }


    #[Route('/{id}', name: 'app_usuarios_show', methods: ['GET'])]
    public function show(Usuarios $usuario): Response
    {
        return $this->render('usuarios/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_usuarios_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuarios $usuario, UsuariosRepository $usuariosRepository): Response
    {
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuariosRepository->add($usuario);
            return $this->redirectToRoute('app_usuarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuarios/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usuarios_delete', methods: ['POST'])]
    public function delete(Request $request, Usuarios $usuario, UsuariosRepository $usuariosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $usuariosRepository->remove($usuario);
        }

        return $this->redirectToRoute('app_usuarios_index', [], Response::HTTP_SEE_OTHER);
    }
}