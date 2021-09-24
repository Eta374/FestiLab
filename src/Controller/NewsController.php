<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news_index", methods={"GET"})
     * isGranted("ROLE_EDITOR")
     */
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="news_new", methods={"GET","POST"})
     * isGranted("ROLE_EDITOR")
     */
    public function new(Request $request): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // On récupère les images transmises
             $picture = $form->get('picture')->getData();
             $name = $form->get('name')->getData();
             // On génère un nouveau nom de fichier
             $fichier = $name.'.'.$picture->guessExtension();
             
             // On copie le fichier dans le dossier uploads
             $picture->move(
                 $this->getParameter('news_pictures_directory'),
                 $fichier
             );

            $entityManager = $this->getDoctrine()->getManager();
            $news -> setPicture($fichier)
            -> setCreatedAt(new DateTime());
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news/new.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="news_show", methods={"GET"})
     */
    public function show(News $news): Response
    {
        return $this->render('news/show.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_edit", methods={"GET","POST"})
     * isGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // On récupère les images transmises
             $picture = $form->get('picture')->getData();
             $name = $form->get('name')->getData();
             // On génère un nouveau nom de fichier
             $fichier = $name.'.'.$picture->guessExtension();
             
             // On copie le fichier dans le dossier uploads
             $picture->move(
                 $this->getParameter('news_pictures_directory'),
                 $fichier
             );
             $news -> setPicture($fichier);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="news_delete", methods={"POST"})
     * isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('news_index', [], Response::HTTP_SEE_OTHER);
    }
}
