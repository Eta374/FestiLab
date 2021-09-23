<?php

namespace App\Controller;

use App\Entity\Patners;
use App\Form\PatnersType;
use App\Repository\PatnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patners")
 */
class PatnersController extends AbstractController
{
    /**
     * @Route("/", name="patners_index", methods={"GET"})
     * @isGranted("ROLE_EDITOR")
     */
    public function index(PatnersRepository $patnersRepository): Response
    {
        return $this->render('patners/index.html.twig', [
            'patners' => $patnersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="patners_new", methods={"GET","POST"})
     * @isGranted("ROLE_EDITOR")
     */
    public function new(Request $request): Response
    {
        $patner = new Patners();
        $form = $this->createForm(PatnersType::class, $patner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $picture = $form->get('picture')->getData();
            $name = $form->get('name')->getData();
            // On génère un nouveau nom de fichier
            $fichier = $name.'.'.$picture->guessExtension();
            
            // On copie le fichier dans le dossier uploads
            $picture->move(
                $this->getParameter('artists_pictures_directory'),
                $fichier
            );
            $entityManager = $this->getDoctrine()->getManager();
            $patner->setPicture($fichier);
            $entityManager->persist($patner);
            $entityManager->flush();

            return $this->redirectToRoute('patners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patners/new.html.twig', [
            'patner' => $patner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="patners_show", methods={"GET"})
     */
    public function show(Patners $patner): Response
    {
        return $this->render('patners/show.html.twig', [
            'patner' => $patner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="patners_edit", methods={"GET","POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Patners $patner): Response
    {
        $form = $this->createForm(PatnersType::class, $patner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $picture = $form->get('picture')->getData();
            $name = $form->get('name')->getData();
            // On génère un nouveau nom de fichier
            $fichier = $name.'.'.$picture->guessExtension();
            
            // On copie le fichier dans le dossier uploads
            $picture->move(
                $this->getParameter('artists_pictures_directory'),
                $fichier
            );
            $patner->setPicture($fichier);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patners/edit.html.twig', [
            'patner' => $patner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="patners_delete", methods={"POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Patners $patner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patners_index', [], Response::HTTP_SEE_OTHER);
    }
}
