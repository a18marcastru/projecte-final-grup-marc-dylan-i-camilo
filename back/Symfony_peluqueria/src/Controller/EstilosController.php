<?php

namespace App\Controller;

use App\Entity\Estilos;
use App\Form\EstilosType;
use App\Repository\EstilosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/estilos')]
class EstilosController extends AbstractController
{
    #[Route('/', name: 'app_estilos_index', methods: ['GET'])]
    public function index(EstilosRepository $estilosRepository): Response
    {
        return $this->render('estilos/index.html.twig', [
            'estilos' => $estilosRepository->findAll(),
        ]);
    }

    #[Route('/catalogo', name: 'app_estilos_mostrar', methods: ['GET'])]
    public function mostrar(EstilosRepository $estilosRepository): JsonResponse
    {
        $restos = $estilosRepository->findAll();
        $i = 0;

        foreach ($restos as $rest) {
            $data_estilos[$i] = [
                'imagenes' => $rest->getImagen(),
            ];
            $i++;
        }

        return new JsonResponse($data_estilos, Response::HTTP_OK);
    }

    #[Route('/new', name: 'app_estilos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EstilosRepository $estilosRepository): Response
    {
        $estilo = new Estilos();
        $form = $this->createForm(EstilosType::class, $estilo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estilosRepository->add($estilo);
            return $this->redirectToRoute('app_estilos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estilos/new.html.twig', [
            'estilo' => $estilo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estilos_show', methods: ['GET'])]
    public function show(Estilos $estilo): Response
    {
        return $this->render('estilos/show.html.twig', [
            'estilo' => $estilo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_estilos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Estilos $estilo, EstilosRepository $estilosRepository): Response
    {
        $form = $this->createForm(EstilosType::class, $estilo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estilosRepository->add($estilo);
            return $this->redirectToRoute('app_estilos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estilos/edit.html.twig', [
            'estilo' => $estilo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estilos_delete', methods: ['POST'])]
    public function delete(Request $request, Estilos $estilo, EstilosRepository $estilosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estilo->getId(), $request->request->get('_token'))) {
            $estilosRepository->remove($estilo);
        }

        return $this->redirectToRoute('app_estilos_index', [], Response::HTTP_SEE_OTHER);
    }
}
