<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Form\ContactUsType;
use App\Repository\ContactUsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/us")
 */
class ContactUsController extends AbstractController
{
    /**
     * @Route("/", name="contact_us_index", methods={"GET"})
     */
    public function index(ContactUsRepository $contactUsRepository): Response
    {
        return $this->render('contact_us/index.html.twig', [
            'contactuses' => $contactUsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contact_us_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contactU = new ContactUs();
        $form = $this->createForm(ContactUsType::class, $contactU);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $contactU-> setCreatedAt(new DateTime());
            $entityManager->persist($contactU);
            $entityManager->flush();

            return $this->redirectToRoute('contact_us_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_us/new.html.twig', [
            'contact_u' => $contactU,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_us_show", methods={"GET"})
     */
    public function show(ContactUs $contactU): Response
    {
        return $this->render('contact_us/show.html.twig', [
            'contact_u' => $contactU,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_us_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContactUs $contactU): Response
    {
        $form = $this->createForm(ContactUsType::class, $contactU);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_us_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_us/edit.html.twig', [
            'contact_u' => $contactU,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_us_delete", methods={"POST"})
     */
    public function delete(Request $request, ContactUs $contactU): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactU->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactU);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_us_index', [], Response::HTTP_SEE_OTHER);
    }
}
