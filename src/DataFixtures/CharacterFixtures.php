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
            ['Rat des Mines', '1', '25', '25', '25', '25', 1, ''],
            ['Ver Luisant', '1', '35', '35', '35', '35', 1, ''],
            ['Chauve-souris Toxique', '50', '50', '50', '50', '50', 1, ''],
            ['Salamandre Enragée', '75', '75', '75', '75', '75', 1, ''],
            ['The Boss', '1', '100', '100', '100', '100', 1, ''],
        ];

        $tabCharacMonster = [
            ['Rat des Mines', '1', '25', '25', '25', '25', 0, 'admin'],
            ['Ver Luisant', '1', '35', '35', '35', '35', 0, 'admin'],
            ['Chauve-souris Toxique', '50', '50', '50', '50', '50', 0, 'admin'],
            ['Salamandre Enragée', '75', '75', '75', '75', '75', 0, 'admin'],
            ['The Boss', '1', '100', '100', '100', '100', 0, 'admin'],
        ];

        $tabCharacMatt = [
            ['Zabek', '1', '75', '25', '60', '60', 0, 'matt'],
            ['Torti', '1', '60', '60', '50', '35', 0, 'matt'],
            ['Ecclès', '1', '80', '15', '60', '80', 0, 'matt'],
            ['Kaplopi', '1', '50', '70', '30', '50', 0, 'matt'],
            ['Lovdisc', '1', '80', '30', '30', '50', 0, 'matt'],
        ];

        $tabCharacKrikri = [
            ['Ecclès', '1', '80', '15', '60', '80', 0, 'krikri'],
            ['Milly', '1', '50', '50', '50', '50', 0, 'krikri'],
            ['Kaplopi', '1', '50', '70', '30', '50', 0, 'krikri'],
            ['Pifou', '1', '35', '70', '60', '50', 0, 'krikri'],
            ['Lovdisc', '1', '80', '30', '30', '50', 0, 'krikri'],
        ];

        $tabCharacTest = [
            ['Lovdisc', '1', '80', '30', '30', '50', 0, 'test'],
            ['Rat des Mines', '1', '25', '25', '25', '25', 0, 'test'],
            ['Ver Luisant', '1', '35', '35', '35', '35', 0, 'test'],
            ['Chauve-souris Toxique', '50', '50', '50', '50', '50', 0, 'test'],
            ['Salamandre Enragée', '75', '75', '75', '75', '75', 0, 'test'],
        ];


        $tabCharac = array_merge($tabCharacModel, $tabCharacMonster, $tabCharacMatt, $tabCharacKrikri, $tabCharacTest);

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
