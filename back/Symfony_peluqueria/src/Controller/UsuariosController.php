<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\UsuariosType;
use App\Repository\ReservasRepository;
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

    #[Route('/buscar', name: 'app_usuarios_index2', methods: ['POST','GET'])]
    public function search(UsuariosRepository $usuariosRepository): Response
    {
        $data_usuario = $usuariosRepository->findOneBy(['email' => $_POST['email']]);
        return $this->render('usuarios/resultado.html.twig', [
            'usuario' => $data_usuario,
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

    #[Route('/nuevo/usuario', name: 'app_usuarios_new2', methods: ['POST','GET'])]
    public function new2(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $data = $request->request->all();
        $nombre = test_input($data['nombre']);
        $apellido = test_input($data['apellido']);
        $email = test_input($data['email']);
        $telefono = test_input($data['telefono']);
        $contrasena = password_hash(test_input($data['contrasena']), PASSWORD_DEFAULT);

        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        if(empty($data_usuario)) {
            $usuariosRepository->save($nombre, $apellido, $email, $contrasena, $telefono);
            return new JsonResponse("Bienvenido", Response::HTTP_OK);
        }
        return new JsonResponse("Existe un usuario", Response::HTTP_OK);
    }

    #[Route('/login', name: 'app_usuarios_login', methods: ['POST', 'GET'])]
    public function login(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $data = $request->request->all();
        $email = test_input($data['email']);
        $contra = test_input($data['contrasena']);
        $data_usuario = $usuariosRepository->findOneBy(['email' => $email]);
        if(!empty($data_usuario)) {
            $data_contras = $data_usuario->getContrasena();
            if (password_verify($contra, $data_contras)) {
                $id_usuario = $data_usuario->getId();
                return new JsonResponse($id_usuario, Response::HTTP_OK);
            }
            else {
                $id_usuario = false;
                return new JsonResponse($id_usuario, Response::HTTP_OK);
            }
        }

        return new JsonResponse("No existe usuario", Response::HTTP_OK);
    }

    #[Route('/perfil/{id}', name: 'app_usuarios_perfil', methods: ['GET'])]
    public function mostrar($id, UsuariosRepository $usuariosRepository, ReservasRepository $reservasRepository): JsonResponse
    {
        $restos = $usuariosRepository->findOneBy(['id' => $id]);
        $reservas = $reservasRepository->buscar_usuario_reservas($id);
        $data_usuario = [
            'nombre' => $restos->getNombre(),
            'apellido' => $restos->getApellido(),
            'email' => $restos->getEmail(),
            'telefono' => $restos->getTelefono(),
            'reservas' => $reservas
        ];

        return new JsonResponse($data_usuario, Response::HTTP_OK);
    }

    #[Route('/cambiar/contrasena/{id}', name: 'app_usuarios_perfil2', methods: ['POST','GET'])]
    public function actual($id, Request $Request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $restos = $usuariosRepository->findOneBy(['id' => $id]);
        $data = $Request->request->all();

        $contrasena = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        empty($data['contrasena']) ? true : $restos->setContrasena($contrasena);

        $usuariosRepository->update($restos);

        return new JsonResponse("Fue cambiado la contrasena con exito", Response::HTTP_OK);
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
