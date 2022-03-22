<h2>Moteur de jeu</h2>
<?php

include 'fonction/locate.php';
include 'fonction/draw.php';
include 'fonction/screen.php';


// Tableau des stats du ver sanguinaire des mers
$skills = array(
    "dexterity" => 27,
    "force" => 34,
    "armor" => 28,
    "perception" => 12,
    "intelligence" => 8,
    "volition" => 19,
    "lucky" => 14,
    "rapidity" => 17,
    "endurance" => 37,
);

// Tableau des héros
$heroes = array(
    array('position' => 0, 'name' => 'Zabek', 'rapidity' => 12, 'alea' => 0, 'localisation' => 0),
    array('position' => 0, 'name' => 'Torti', 'rapidity' => 14, 'alea' => 0, 'localisation' => 1),
    array('position' => 0, 'name' => 'Milly', 'rapidity' => 18, 'alea' => 0, 'localisation' => 0),
    array('position' => 0, 'name' => 'Cradou', 'rapidity' => 8, 'alea' => 0, 'localisation' => 2),
    array('position' => 0, 'name' => 'Eccles', 'rapidity' => 20, 'alea' => 0, 'localisation' => 2),
);

// Tableau des monstres
$monsters = array(
    array('position' => 0, 'name' => 'Rat sanguinaire 1', 'rapidity' => 16, 'alea' => 0, 'localisation' => 0),
    array('position' => 0, 'name' => 'Rat sanguinaire 2', 'rapidity' => 16, 'alea' => 0, 'localisation' => 1),
    array('position' => 0, 'name' => 'Rat sanguinaire 3', 'rapidity' => 16, 'alea' => 0, 'localisation' => 0),
    array('position' => 0, 'name' => 'Ver toxique 1', 'rapidity' => 10, 'alea' => 0, 'localisation' => 2),
    array('position' => 0, 'name' => 'Ver toxique 2', 'rapidity' => 10, 'alea' => 0, 'localisation' => 2),
);

/*
// On initialise le plateau des heros à gauche
echo "<p>HEROES</p><hr>";
$heroeslocated = locate($heroes);
echo "<p>LOCATION</p>";
echo "<p>" . var_dump($heroeslocated) . "</p><hr>";

// On initialise le plateau des monstres à droite
echo "<p>MONSTERS</p><hr>";
$monsterslocated = rlocate($monsters);
echo "<p>LOCATION</p>";
echo "<p>" . var_dump($monsterslocated) . "</p><hr>";
*/


// On initialise le plateau de jeu
$heroeslocated = locate($heroes);
$monsterslocated = rlocate($monsters);

// Mise en place du plateau
echo "<p>BOARD GAME</p><hr>";
$boardgame = cboard(array_merge($heroeslocated, $monsterslocated));

/*
// On initialise la ligne de départ des personnages
echo "<p>START LINE</p><hr>";
$board = clienstart(draw(array_merge($heroes, $monsters)));
*/
?>