<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\CharacterStrategy;
use App\Entity\Fight;
use App\Entity\Strategy;
use Doctrine\ORM\Mapping\Id;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlayController extends AbstractController
{
    /**
     * @Route("/play", name="app_play")
     */
    public function index(): Response
    {
        $fights = $this->getDoctrine()->getRepository(Fight::class)->findBy(['id' => 1]);

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
}
