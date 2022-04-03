<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\FightRepository;
use App\Service\MG;

class HomeController extends AbstractController
{

    private $security;
    private $emf;

    public function __construct(Security $security, FightRepository $emf)
    {
        $this->security = $security;
        $this->emf = $emf;
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        // On récupére la position de l'utilisateur dans la progression du jeu
        $status = $this->security->getUser()->getFight();

        // On récupére la liste de tout le parcours
        $fights = $this->emf->findAll();

        return $this->render('home/index.html.twig', [
            'progress' => $fights,
            'status' => $status,
        ]);
    }
    
}
