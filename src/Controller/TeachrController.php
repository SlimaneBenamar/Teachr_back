<?php

namespace App\Controller;

use App\Entity\Teachr;
use App\Form\TeachrType;
use App\Repository\TeachrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/teachr')]
class TeachrController extends AbstractController
{
    #[Route('/', name: 'teachr_index', methods: ['GET'])]
    public function index(TeachrRepository $teachrRepository): Response
    {
        return $this->render('teachr/index.html.twig', [
            'teachrs' => $teachrRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'teachr_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $teachr = new Teachr();
        $form = $this->createForm(TeachrType::class, $teachr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($teachr);
            $entityManager->flush();

            return $this->redirectToRoute('teachr_index');
        }

        return $this->render('teachr/new.html.twig', [
            'teachr' => $teachr,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'teachr_show', methods: ['GET'])]
    public function show(Teachr $teachr): Response
    {
        return $this->render('teachr/show.html.twig', [
            'teachr' => $teachr,
        ]);
    }

    #[Route('/{id}/edit', name: 'teachr_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Teachr $teachr): Response
    {
        $form = $this->createForm(TeachrType::class, $teachr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teachr_index');
        }

        return $this->render('teachr/edit.html.twig', [
            'teachr' => $teachr,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'teachr_delete', methods: ['DELETE'])]
    public function delete(Request $request, Teachr $teachr): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teachr->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($teachr);
            $entityManager->flush();
        }

        return $this->redirectToRoute('teachr_index');
    }
}
