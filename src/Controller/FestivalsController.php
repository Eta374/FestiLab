<?php

namespace App\Controller;

use App\Entity\Festivals;
use App\Entity\Pictures;
use App\Form\FestivalsType;
use App\Repository\FestivalsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/festivals")
 */
class FestivalsController extends AbstractController
{
    /**
     * @Route("/", name="festivals_index", methods={"GET"})
     */
    public function index(FestivalsRepository $festivalsRepository): Response
    {
        return $this->render('festivals/index.html.twig', [
            'festivals' => $festivalsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="festivals_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user= $this->getUser();
        
        $festival = new Festivals();
        $form = $this->createForm(FestivalsType::class, $festival);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $images = $form->get('images')->getData();
            
            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('festivals_pictures_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Pictures();
                $img->setName($fichier)
                    ->setDescription($fichier)
                    ->setLink($image);
                $festival->addPicture($img);
            }

            $entityManager = $this->getDoctrine()->getManager();

            $festival->setCreatedAt(new DateTime())
                     ->setModifiedAt(new DateTime())
                     ->setEditor($user);
            $entityManager->persist($festival);
            $entityManager->flush();

            return $this->redirectToRoute('festivals_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('festivals/new.html.twig', [
            'festival' => $festival,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="festivals_show", methods={"GET"})
     */
    public function show(Festivals $festival): Response
    {
        return $this->render('festivals/show.html.twig', [
            'festival' => $festival,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="festivals_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Festivals $festival): Response
    {
        $form = $this->createForm(FestivalsType::class, $festival);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('festivals_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('festivals/edit.html.twig', [
            'festival' => $festival,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="festivals_delete", methods={"POST"})
     */
    public function delete(Request $request, Festivals $festival): Response
    {
        if ($this->isCsrfTokenValid('delete'.$festival->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($festival);
            $entityManager->flush();
        }

        return $this->redirectToRoute('festivals_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/supprime/image/{id}", name="festivals_delete_image", methods={"DELETE"})
     */
    // public function deleteImage(Pictures $pictures, Request $request){
    //     $data = json_decode($request->getContent(), true);

    //     // On vérifie si le token est valide
    //     if($this->isCsrfTokenValid('delete'.$pictures->getId(), $data['_token'])){
    //         // On récupère le nom de l'image
    //         $nom = $pictures->getName();
    //         // On supprime le fichier
    //         unlink($this->getParameter('festivals_pictures_directory').'/'.$nom);

    //         // On supprime l'entrée de la base
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($pictures);
    //         $em->flush();

    //         // On répond en json
    //         return new JsonResponse(['success' => 1]);
    //     }else{
    //         return new JsonResponse(['error' => 'Token Invalide'], 400);
    //     }
    // }
}
