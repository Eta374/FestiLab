<?php

namespace App\Controller;

use App\Entity\Cities;
use App\Form\CitiesType;
use App\Repository\CitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/cities")
 * isGranted("ROLE_ADMIN")
 */
class CitiesController extends AbstractController
{
    /**
     * @Route("/", name="cities_index", methods={"GET"})
     */
    public function index(CitiesRepository $citiesRepository): Response
    {
        return $this->render('cities/index.html.twig', [
            'cities' => $citiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cities_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $city = new Cities();
        $form = $this->createForm(CitiesType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();

            return $this->redirectToRoute('cities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cities/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cities_show", methods={"GET"})
     */
    public function show(Cities $city): Response
    {
        return $this->render('cities/show.html.twig', [
            'city' => $city,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cities_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cities $city): Response
    {
        $form = $this->createForm(CitiesType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cities/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cities_delete", methods={"POST"})
     */
    public function delete(Request $request, Cities $city): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($city);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cities_index', [], Response::HTTP_SEE_OTHER);
    }
}
