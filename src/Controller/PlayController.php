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
use App\Repository\FightRepository;
use Symfony\Component\Security\Core\Security;


class PlayController extends AbstractController
{
    private $security;
    private $emf;
    private $emc;
    private $emff;

    public function __construct(Security $security, FormationRepository $emf, CharacterRepository $emc, FightRepository $emff)
    {
        $this->security = $security;
        $this->emf = $emf;
        $this->emc = $emc;
        $this->emff = $emff;
    }

    /**
     * @Route("/play", name="app_play")
     */
    public function play(): Response
    {
        // On récupére l'utilisateur courant
        $var_user = $this->security->getUser();

        // On récupére toutes les formations de l'utilisateur courant
        $var_formation = $this->emf->findByUser($var_user);
        //dd($var_formation);
        // On récupére l'adversaire
        $statusUser = $var_user->getfight();
        
        $versus = "'TO DO'";
        //dd($statusUser);
        //$versus = $this->emff->findVersus($statusUser);
        //dd($versus);


        return $this->render('play/index.html.twig', [
            'userformation' => $var_formation,
            'challengerformation' => $versus,
        ]);
    }


    /**
     * @Route("/play/new", name="app_play_new")
     */

    public function index(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        // On récupére l'utilisateur courant
        $var_user = $this->security->getUser();

        // On définit que l'équipe n'est pas complète tant qu'il n'y a pas 5 personnages attribués
        $teamOK = 0;

        // On récupére toutes les formations de l'utilisateur courant
        $var_formation = $this->emf->findByUser($var_user);

        // On récupére tous les personnages de la formation
        foreach ($var_formation as $formation) {
            $tab_formation = $this->emc->findByFormation($formation->getId());
        }

        // On compte le nombre de personnage dans la formation
        $nb_character = count($tab_formation);

        // S'il y'en a 5, c'est parti
        if ($nb_character == 5) {
            $teamOK = 1;

            // On lui affecte un combat correspondant à son niveau d'avancement, donc le Niveau 1
            $var_fight = $this->emff->find(2);
            $var_user->setFight($var_fight);
            $manager->persist($var_user);
            $manager->flush();

            return $this->render('formation/index.html.twig', [
                'formations' => $var_formation,
                'tabformations' => $tab_formation,
                'teamOK' => $teamOK,
            ]);

            // Sinon on affiche le formulaire d'ajout de personnage à une formation
        } else {

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
        }

        // *************************************************** RENDU *********************************************
        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),
            'formations' => $var_formation,
            'tabformations' => $tab_formation,
            'teamOK' => $teamOK,
        ]);
    }
}
