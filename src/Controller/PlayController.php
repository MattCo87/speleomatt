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
    public function play(): Response
    {

        return $this->render('play/index.html.twig', [
            //'board' => $board,
        ]);
    }


    /**
     * @Route("/play/new", name="app_play_new")
     */
    public function index(CharacterRepository $emc, FormationRepository $emf, Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        $var_user = $this->getUser();

        // On récupére toutes les formations de l'utilisateur courant
        $var_formation = $emf->findByUser($this->getUser());
        $var_id_formation = $emf->findIdByUser(2);

        // On récupére tous les personnages de chaque formation
        foreach ($var_id_formation as $formation) {
            $tab_formation[] = $emc->findByFormation($formation['id']);
        }

        $i = 0;
        foreach ($tab_formation as $temp_character) {
            foreach ($temp_character as $character) {
                //dd($character);
                
                $temp_var[$i][] = $emc->find($character['characters_id']);
                //$tab_character[] = $emc->find($character['characters_id']);
            }
            $i++;
        }
        //dd($temp_var);


        // On crée une CharacterFormation
        $characterFormation = new CharacterFormation();

        //On crée le formulaire de création de CharacterFormation
        $form = $this->createForm(FormationType::class, $characterFormation);
        $form->handleRequest($request);

        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute la CharacterFormation 
            $manager->persist($characterFormation);
            $manager->flush();

            return $this->redirectToRoute('app_play_new');
        }

        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),
            'formations' => $var_formation,
            'tabformation0' => $temp_var[0],
            'tabformation1' => $temp_var[1],
        ]);
    }
}
