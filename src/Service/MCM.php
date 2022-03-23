<?php

namespace App\Service;

use App\Entity\Character;
use App\Entity\Fight;
use App\Entity\Formation;
use App\Repository\CharacterRepository;
use app\Repository\FormationRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;


class MCM
{
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                       LOCATE ET RLOCATE                                                        *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/

    /*
Fonction 'locate' : retourne un tableau représentant la localisation des personnages de droite (devant) à gauche (derrière)
                    sur un plateau 3*3
Fonction 'rlocate' : retourne un tableau représentant la localisation des personnages de gauche (devant) à droite (derrière)
                    sur un plateau 3*3
*/

    function locate($board)
    {


    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                          INIT TABLEAUX                                                         *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/



        // Tableau final de positionnement des personnages
        $tablocate = array(
            '', '', '',
            '', '', '',
            '', '', ''
        );

        /*
        Tableau de suite de position:
            - devant (0) : cases 2, 5 et 8
            - milieu (1) : cases 1, 4 et 7
            - derrière (2) : cases 0, 3 et 6
    */
        $tabpositionlocate = array(
            array(2, 5, 8),
            array(1, 4, 7),
            array(0, 3, 6)
        );

        // Tableau contenant le nombre de personnage par colonne (devant, milieu, derrière)
        $tabnblocalisation = array(0, 0, 0);

        // On compte le nombre de personnage par colonne (devant, milieu, derrière) dans la formation
        foreach ($board as $charlocation) {
            switch ($charlocation['localisation']) {
                case 0:
                    $tabnblocalisation[0]++;
                    break;
                case 1:
                    $tabnblocalisation[1]++;
                    break;
                case 2:
                    $tabnblocalisation[2]++;
                    break;
            }
        }



    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                     POSITIONNEMENT DES PERSOS                                                  *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/


        // Pour chaque personnage du tableau passé en paramétre
        foreach ($board as $character) {
            // Selon la position du personnage dans la formation
            switch ($character['localisation']) {
                    // Si le personnage est placé devant
                case 0:
                    // Selon le nombre de personnage à placer dans la carte
                    switch ($tabnblocalisation[0]) {
                            // 1 personnage placé devant
                        case 1:
                            $cell = 1;
                            break;
                            // 2 personnages placés devant
                        case 2:
                            // On teste si la position verticale haute est occupée
                            if (!$tablocate[$tabpositionlocate[0][0]]) {
                                $cell = 0;
                                // Si oui on place le personnage en position verticale basse
                            } else {
                                $cell = 2;
                            }
                            break;
                            // 3 personnages placés devant
                        case 3:
                            // On teste si la position verticale haute est occupée
                            if (!$tablocate[$tabpositionlocate[0][0]]) {
                                $cell = 0;
                                // Sinon on teste si la position verticale centre est occupée
                            } elseif (!$tablocate[$tabpositionlocate[0][1]]) {
                                $cell = 1;
                                // Si oui on place le personnage en position verticale basse
                            } else {
                                $cell = 2;
                            }
                            break;
                            // Sinon impossible
                        default:
                            echo "Personnage impossible à placer<br>";
                            break;
                    }
                    // On enregistre le nom du personnage à sa position
                    $tablocate[$tabpositionlocate[0][$cell]] = $character['name'];
                    break;

                    // Si le personnage est placé au milieu
                case 1:
                    switch ($tabnblocalisation[1]) {
                        case 1:
                            $cell = 1;
                            break;
                        case 2:
                            if (!$tablocate[$tabpositionlocate[1][0]]) {
                                $cell = 0;
                            } else {
                                $cell = 2;
                            }
                            break;
                        case 3:
                            if (!$tablocate[$tabpositionlocate[1][0]]) {
                                $cell = 0;
                            } elseif (!$tablocate[$tabpositionlocate[1][1]]) {
                                $cell = 1;
                            } else {
                                $cell = 2;
                            }
                            break;
                        default:
                            echo "Personnage impossible à placer<br>";
                            break;
                    }
                    // On enregistre le nom du personnage à sa position
                    $tablocate[$tabpositionlocate[1][$cell]] = $character['name'];
                    break;

                    // Si le personnage est placé derrière
                case 2:
                    switch ($tabnblocalisation[2]) {
                        case 1:
                            $cell = 1;
                            break;
                        case 2:
                            if (!$tablocate[$tabpositionlocate[2][0]]) {
                                $cell = 0;
                            } else {
                                $cell = 2;
                            }
                            break;
                        case 3:
                            if (!$tablocate[$tabpositionlocate[2][0]]) {
                                $cell = 0;
                            } elseif (!$tablocate[$tabpositionlocate[2][1]]) {
                                $cell = 1;
                            } else {
                                $cell = 2;
                            }
                            break;
                        default:
                            echo "Personnage impossible à placer<br>";
                            break;
                    }
                    // On enregistre le nom du personnage à sa position
                    $tablocate[$tabpositionlocate[2][$cell]] = $character['name'];
                    break;
            }
        }


        // On retourne le tableau des joueurs et leur placement sur la carte
        return $tablocate;
    }



    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                          FUNCTION RELOCATE                                                     *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/



    function rlocate($board)
    {
        // On positionne les monstres sur la carte
        $board = $this->locate($board);
        // On copie le tableau des positions
        $rboard = $board;

        // On inverse la carte pour l'affichage à la droite de l'écran
        $rboard[0] = $board[2];
        $rboard[2] = $board[0];
        $rboard[3] = $board[5];
        $rboard[5] = $board[3];
        $rboard[6] = $board[8];
        $rboard[8] = $board[6];

        return $rboard;
    }




    /* **************************************************************************************************************************
    /* **************************************************************************************************************************

    /* **************************************************************************************************************************
    /* **************************************************************************************************************************




    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                       MOTEUR DE JEU                                                            *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/



    public function getMotor(FormationRepository $doctrine, CharacterRepository $emc)
    {
        // Fonction personnelle dans le FormationRepository
        $req_fight = $doctrine->findByFight(1);


    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                       EQUIPE USER                                                              *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/
        // Gestion de la formation challenger

        // On récupére la formation
        $formation_num = $req_fight[0]['formation_id'];
        // On récupére les ID des personnages de la formation
        $req_formation0 = $emc->findByFormation($formation_num);

        foreach ($req_formation0 as $var_character) {
            // On récupére les infos du personnage de la formation
            $unperso = $emc->find($var_character['characters_id']);
            // On alimente le tableau temporaire contenant le nom des personnages de l'équipe des 'heroes'
            $var_heroes[] = $unperso->getName();
        }



    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                       EQUIPE ADMIN                                                             *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/


        // Gestion de la formation adverse
        // On récupére la formation
        $formation_num = $req_fight[1]['formation_id'];
        // On récupére les ID des personnages de la formation
        $req_formation1 = $emc->findByFormation($formation_num);

        foreach ($req_formation1 as $var_character) {
            // On récupére les infos du personnage de la formation
            $unperso = $emc->find($var_character['characters_id']);
            // On alimente le tableau temporaire contenant le nom des personnages de l'équipe des 'monsters'
            $var_monsters[] = $unperso->getName();
        }


    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                    ASSOCIATION DES DONNES                                                      *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/

    
        // On associe le tableau des formations issues des fixtures + un random sur la position des joueurs (devant, milieu, derriere)
        
        // Tableau des héros
        $heroes = array(
            array('position' => 0, 'name' => $var_heroes[0], 'rapidity' => 12, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_heroes[1], 'rapidity' => 14, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_heroes[2], 'rapidity' => 18, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_heroes[3], 'rapidity' => 8, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_heroes[4], 'rapidity' => 20, 'alea' => 0, 'localisation' => rand(0,2)),
        );

        // Tableau des monstres
        $monsters = array(
            array('position' => 0, 'name' => $var_monsters[0], 'rapidity' => 16, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_monsters[1], 'rapidity' => 16, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_monsters[2], 'rapidity' => 16, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_monsters[3], 'rapidity' => 10, 'alea' => 0, 'localisation' => rand(0,2)),
            array('position' => 0, 'name' => $var_monsters[4], 'rapidity' => 10, 'alea' => 0, 'localisation' => rand(0,2)),
        );



    /* **************************************************************************************************************************
    /* **************************************************************************************************************************
    /* *****                                                                                                                *****
    /* *****                                            INITIALISATION                                                      *****
    /* *****                                                                                                                *****
    /* *****                                                                                                                *****
    /* **************************************************************************************************************************
    /* **************************************************************************************************************************/
        
        // On initialise le plateau de jeu
        $heroeslocated = $this->locate($heroes);
        $monsterslocated = $this->rlocate($monsters);

        return array_merge($heroeslocated, $monsterslocated);
    }
}
