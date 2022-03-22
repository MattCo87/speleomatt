<?php

// Fonction 'draw' : retourne le tableau de ligne de départ des personnages de la partie

function draw($characters)
{
    // Compteur de boucle
    $i = 0;

    foreach ($characters as $key) {
        // Chiffre aléatoire de 1 à 20
        $alea = rand(1, 20);
        // On enregistre dans le tableau le chiffre aléatoire tiré
        $characters[$i]['alea'] = $alea;
        // On enregistre dans le tableau la nouvelle position du personnage (sa rapidité + le chiffre aléatoire)
        $characters[$i]['position'] = $key['rapidity'] + $alea;

        $i++;
    }

    // On trie le tableau dans l'ordre décroissant des 'position'
    rsort($characters);

    // On retourne le tableau trié
    return $characters;
}

?>