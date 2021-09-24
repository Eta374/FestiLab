<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Form\ArtistsType;
use App\Repository\ArtistsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/artists")
 */
class ArtistsController extends AbstractController
{
    /**
     * @Route("/", name="artists_index", methods={"GET"})
     * @isGranted("ROLE_EDITOR")
     */
    public function index(ArtistsRepository $artistsRepository): Response
    {
        return $this->render('artists/index.html.twig', [
            'artists' => $artistsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artists_new", methods={"GET","POST"})
     * @isGranted("ROLE_EDITOR")
     */
    public function new(Request $request): Response
    {
        $artist = new Artists();
        $form = $this->createForm(ArtistsType::class, $artist);
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
            $artist->setPicture($fichier);
            $entityManager->persist($artist);
            
            $entityManager->flush();
            return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artists/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artists_show", methods={"GET"})
     */
    public function show(Artists $artist): Response
    {
        return $this->render('artists/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artists_edit", methods={"GET","POST"})
     * @isGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, Artists $artist): Response
    {
        $form = $this->createForm(ArtistsType::class, $artist);
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
            
            $artist->setPicture($fichier);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artists/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artists_delete", methods={"POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Artists $artist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
    }
}
