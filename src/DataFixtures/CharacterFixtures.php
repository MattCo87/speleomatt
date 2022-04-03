<?php

namespace App\DataFixtures;

use App\Entity\Character;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CharacterFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabCharacModel = [
// Team Rat
            ['Rat des Mines 1', '1', '25', '25', '25', '25', 0, 'admin'],
            ['Rat des Mines 2', '1', '25', '25', '25', '25', 0, 'admin'],
            ['Rat des Mines 3', '1', '25', '25', '25', '25', 0, 'admin'],
            ['Rat des Mines 4', '1', '25', '25', '25', '25', 0, 'admin'],
            ['Splinter', '1', '100', '100', '100', '100', 0, 'admin'],
// Team Ver
            ['Ver Luisant 1', '1', '35', '35', '35', '35', 0, 'admin'],
            ['Ver Luisant 2', '1', '35', '35', '35', '35', 0, 'admin'],
            ['Ver Luisant 3', '1', '35', '35', '35', '35', 0, 'admin'],
            ['Ver Luisant 4', '1', '35', '35', '35', '35', 0, 'admin'],
            ['Vertigo', '1', '100', '100', '100', '100', 0, 'admin'],
// Team Chauve-souris
            ['Chauve-souris Toxique 1', '50', '50', '50', '50', '50', 0, 'admin'],
            ['Chauve-souris Toxique 2', '50', '50', '50', '50', '50', 0, 'admin'],
            ['Chauve-souris Toxique 3', '50', '50', '50', '50', '50', 0, 'admin'],
            ['Chauve-souris Toxique 4', '50', '50', '50', '50', '50', 0, 'admin'],
            ['Batboy', '1', '100', '100', '100', '100', 0, 'admin'],
// Team Salamandre
            ['Salamandre Enragée 1', '75', '75', '75', '75', '75', 0, 'admin'],
            ['Salamandre Enragée 2', '75', '75', '75', '75', '75', 0, 'admin'],
            ['Salamandre Enragée 3', '75', '75', '75', '75', '75', 0, 'admin'],
            ['Salamandre Enragée 4', '75', '75', '75', '75', '75', 0, 'admin'],
            ['KingLouis', '1', '100', '100', '100', '100', 0, 'admin'],
// Team Mille-Pattes
            ['Mille-Pattes vénimeux 1', '100', '100', '100', '100', '100', 0, 'admin'],
            ['Mille-Pattes vénimeux 2', '100', '100', '100', '100', '100', 0, 'admin'],
            ['Mille-Pattes vénimeux 3', '100', '100', '100', '100', '100', 0, 'admin'],
            ['Mille-Pattes vénimeux 4', '100', '100', '100', '100', '100', 0, 'admin'],
            ['The Boss', '1', '100', '100', '100', '100', 0, 'admin'],
// Character 26 
            ['Zabek', '1', '75', '25', '60', '60', 1, ''],
            ['Cradou', '1', '35', '80', '75', '25', 1, ''],
            ['Torti', '1', '60', '60', '50', '35', 1, ''],
            ['Ecclès', '1', '80', '15', '60', '80', 1, ''],
            ['Milly', '1', '50', '50', '50', '50', 1, ''],
            ['Kaplopi', '1', '50', '70', '30', '50', 1, ''],
            ['Pifou', '1', '35', '70', '60', '50', 1, ''],
            ['Lovdisc', '1', '80', '30', '30', '50', 1, ''],
            ['Holt', '1', '50', '70', '30', '70', 1, ''],
            ['Piccolo', '1', '50', '70', '30', '50', 1, ''],
            ['Slimgo', '1', '35', '70', '60', '50', 1, ''],
            ['Kartboy', '1', '80', '30', '30', '50', 1, ''],
            ['Hercule', '1', '50', '70', '30', '70', 1, ''],
// // Character 38            
        ];

        $tabCharac = array_merge($tabCharacModel);

        $z = 0;
        foreach ($tabCharac as list($a, $b, $c, $d, $e, $f, $g, $h)) {
            $z++;
            $character = new Character();
            $character->setName($a)
                ->setLevel($b)
                ->setAttack($c)
                ->setDefense($d)
                ->setResistance($e)
                ->setSpeed($f)
                ->setIspremade($g);

            if ($h) {
                $character->setUser($this->getReference($h));
            }

            $manager->persist($character);
            $this->addReference('character' . $z, $character);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
