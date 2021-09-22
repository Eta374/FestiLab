<?php

namespace App\Controller;

use App\Entity\Publics;
use App\Form\PublicsType;
use App\Repository\PublicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/publics")
 * @isGranted("ROLE_ADMIN")
 */
class PublicsController extends AbstractController
{
    /**
     * @Route("/", name="publics_index", methods={"GET"})
     * @isGranted("ROLE_ADMIN")
     */
    public function index(PublicsRepository $publicsRepository): Response
    {
        return $this->render('publics/index.html.twig', [
            'publics' => $publicsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="publics_new", methods={"GET","POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $public = new Publics();
        $form = $this->createForm(PublicsType::class, $public);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($public);
            $entityManager->flush();

            return $this->redirectToRoute('publics_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publics/new.html.twig', [
            'public' => $public,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="publics_show", methods={"GET"})
     * @isGranted("ROLE_ADMIN")
     */
    public function show(Publics $public): Response
    {
        return $this->render('publics/show.html.twig', [
            'public' => $public,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publics_edit", methods={"GET","POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Publics $public): Response
    {
        $form = $this->createForm(PublicsType::class, $public);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publics_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publics/edit.html.twig', [
            'public' => $public,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="publics_delete", methods={"POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Publics $public): Response
    {
        if ($this->isCsrfTokenValid('delete'.$public->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($public);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publics_index', [], Response::HTTP_SEE_OTHER);
    }
}
