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
// Character 13
            ['Rat des Mines', '1', '25', '25', '25', '25', 1, 'admin'],
            ['Ver Luisant', '1', '35', '35', '35', '35', 1, 'admin'],
            ['Chauve-souris Toxique', '50', '50', '50', '50', '50', 1, 'admin'],
            ['Salamandre Enragée', '75', '75', '75', '75', '75', 1, 'admin'],
            ['Mille-Pattes vénimeux', '100', '100', '100', '100', '100', 1, 'admin'],
// Character 19
            ['Splinter', '1', '100', '100', '100', '100', 1, 'admin'],
            ['Vertigo', '1', '100', '100', '100', '100', 1, 'admin'],
            ['Batboy', '1', '100', '100', '100', '100', 1, 'admin'],
            ['KingLouis', '1', '100', '100', '100', '100', 1, 'admin'],
            ['The Boss', '1', '100', '100', '100', '100', 1, 'admin'],
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
