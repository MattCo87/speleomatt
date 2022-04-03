<?php

namespace App\Controller;


use App\Entity\CharacterFormation;
use App\Repository\CharacterRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormationType;
use Symfony\Component\Security\Core\Security;


class PlayController extends AbstractController
{
    private $security;
    private $emf;
    private $emc;

    public function __construct(Security $security, FormationRepository $emf, CharacterRepository $emc)
    {
        $this->security = $security;
        $this->emf = $emf;
        $this->emc = $emc;
    }

    /**
     * @Route("/play", name="app_play")
     */
    public function play(): Response
    {

        return $this->render('play/index.html.twig', [
            //'board' => $board,
        ]);
    }


    /**
     * @Route("/play/new", name="app_play_new")
     */

    public function index(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        $var_user = $this->security->getUser();

        // On récupére toutes les formations de l'utilisateur courant
        $var_formation = $this->emf->findByUser($var_user);

        // On récupére tous les personnages de la formation
        foreach ($var_formation as $formation) {
            $tab_formation = $this->emc->findByFormation($formation->getId());
        }

        // *************************************************** FORMULAIRE *********************************************

        // On crée une CharacterFormation
        $characterFormation = new CharacterFormation();

        //On crée le formulaire de création de CharacterFormation
        $form = $this->createForm(FormationType::class, $characterFormation);
        $form->handleRequest($request);

        // *************************************************** VERIFICATION FORMULAIRE *********************************************
        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute la CharacterFormation 
            $manager->persist($characterFormation);
            $manager->flush();

            return $this->redirectToRoute('app_play_new');
        }

        // *************************************************** RENDU *********************************************
        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),
            'formations' => $var_formation,
            'tabformations' => $tab_formation,
        ]);
    }
}
