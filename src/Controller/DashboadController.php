<?php

namespace App\Controller;

use App\Entity\Places;
use App\Repository\ArtistsRepository;
use App\Repository\CitiesRepository;
use App\Repository\ContactUsRepository;
use App\Repository\DepartmentsRepository;
use App\Repository\FestivalsRepository;
use App\Repository\KindsRepository;
use App\Repository\NewsRepository;
use App\Repository\PatnersRepository;
use App\Repository\PlacesRepository;
use App\Repository\PublicsRepository;
use App\Repository\UserRepository;
use Countable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboadController extends AbstractController
{
    /**
     * @Route("/dashboad", name="dashboad")
     */
    public function index(ContactUsRepository $contactUsRepository, NewsRepository $newsRepository, FestivalsRepository $festivalsRepository, ArtistsRepository $artistsRepository, PatnersRepository $patnersRepository, UserRepository $userRepository, KindsRepository $kindsRepository, PublicsRepository $publicsRepository, PlacesRepository $placesRepository, CitiesRepository $citiesRepository, DepartmentsRepository $departmentsController): Response
    {
        return $this->render('dashboad/index.html.twig', [
            'contactUs_filter' => $contactUsRepository->findBy([], ['id'=>'DESC'],3),
            'news_filter' => $newsRepository->findBy([], ['id'=>'DESC'],3),
            'festivals_filter' => $festivalsRepository->findBy([], ['id'=>'DESC'],3),
            'artists_filter' => $artistsRepository->findBy([],['id'=>'DESC'],3),
            'partner_filter' => $patnersRepository->findBy([],['id'=>'DESC'],3),
            'users_filter' => $userRepository->findBy([],['id'=>'DESC'],3),
            'kinds_filter' => $kindsRepository->findBy([],['id'=>'DESC'],3),
            'publics_filter' => $publicsRepository->findBy([],['id'=>'DESC'],3),
            'places_filter' => $placesRepository->findBy([],['id'=>'DESC'],3),
            'citis_filter' => $citiesRepository->findBy([],['id'=>'DESC'],3),
            'departement_filter' => $departmentsController->findBy([],['id'=>'DESC'],3),
        ]);
    }
}
