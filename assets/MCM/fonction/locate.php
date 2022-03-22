<?php
/*
Fonction 'locate' : retourne un tableau représentant la localisation des personnages de droite (devant) à gauche (derrière)
                    sur un plateau 3*3
Fonction 'rlocate' : retourne un tableau représentant la localisation des personnages de gauche (devant) à droite (derrière)
                    sur un plateau 3*3
*/

function locate($board)
{
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

    /*
    // On affiche la statégie de la formation
    echo "<p>STRATEGY</p>";
    echo "<p>" . var_dump($tabnblocalisation) . "</p><hr>";
    */

    // On retourne le tableau des joueurs et leur placement sur la carte
    return $tablocate;
}


function rlocate($board)
{
    // On positionne les monstres sur la carte
    $board = locate($board);
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

?>