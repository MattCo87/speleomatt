<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\CharacterStrategy;
use App\Entity\Fight;
use App\Entity\Formation;
use App\Entity\Strategy;
use App\Repository\CharacterRepository;
use App\Repository\FightRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping\Id;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MCM;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormationType;


class PlayController extends AbstractController
{
    /**
     * @Route("/play", name="app_play")
     */
    public function play(FormationRepository $emf): Response
    {
        $fights = $this->getDoctrine()->getRepository(Fight::class)->findBy(['id' => 2]);
        //$fights = $emf->findByFight(1);

        $tabFormation = $fights[0]->getFormations();

        // Gestion de la formation challenger
        // On récupére la formation
        $formation0 = $tabFormation[0];
        // On récupére les personnages de la formation
        $characters0 = $formation0->getCharacterFormations();

        // Pour chaque personnage
        foreach ($characters0 as $character) {
            // On récupére l'id du personnage
            $characters = $character->getCharacters();
            $var_characters = $characters->getId();
            // On met dans un tableau les stratégies de chaque joueur
            $strategies0[] = $this->getDoctrine()->getRepository(CharacterStrategy::class)->findBy(['characters' => $var_characters]);
        }

        /*
        $i = 0;
        foreach ($strategies0 as $var_strategy) {
            $actions0 = $var_strategy[$i]->getStrategies();
            foreach ($actions0 as $action) {
                $actions = $action->getActions();
                $var_actions = $actions->getId();
                $tab[] = $var_actions;
                $actions0[] = $this->getDoctrine()->getRepository(CharacterStrategy::class)->findBy(['actions' => $var_actions]);
            }
            $i++;
        }
        dd($tab);
        */

        // Gestion de la formation adverse
        // On récupére la formation
        $formation1 = $tabFormation[1];
        // On récupére les personnages de la formation
        $characters1 = $formation1->getCharacterFormations();

        // Pour chaque personnage
        foreach ($characters1 as $character) {
            // On récupére l'id du personnage
            $characters = $character->getCharacters();
            $var_characters = $characters->getId();
            // On met dans un tableau les stratégies de chaque joueur
            $strategies1[] = $this->getDoctrine()->getRepository(CharacterStrategy::class)->findBy(['characters' => $var_characters]);
        }

        return $this->render('play/index.html.twig', [
            'fight' => $fights[0],
            'formation0' => $formation0,
            'formation1' => $formation1,
            'characters0' => $characters0,
            'characters1' => $characters1,
            'strategies0' => $strategies0,
            'strategies1' => $strategies1,
        ]);
    }

    /**
     * @Route("/play/board", name="app_play_board")
     */

    
    public function board(FormationRepository $var_fight, CharacterRepository $var_character): Response
    {

        $motor = new MCM;
        $board = $motor->getMotor($var_fight, $var_character);

        return $this->render('play/board.html.twig', [
            'board' => $board,
        ]);
    }


    /**
     * @Route("/play/new", name="app_play_new")
     */    
    public function index(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        // On crée une CharacterFormation
        $characterFormation = new CharacterFormation();

        //On crée le formulaire de création de CharacterFormation
        $form = $this->createForm(FormationType::class, $characterFormation);
        $form->handleRequest($request);
        
        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $formation = new Formation;
            
            dd($form);
            // On ajoute la CharacterFormation 
            $manager->persist($characterFormation);
            $manager->flush();

            return $this->redirectToRoute('app_play_new');
        }
        
        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),           
        ]);
    }



}
