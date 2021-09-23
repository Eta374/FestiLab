<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'news' => $newsRepository->findAll(),
            'newsFilter' => $newsRepository->findBy([],['id'=>'DESC'],3)
        ]);
    }
}
