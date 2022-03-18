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
        ];

        $z = 0;
        foreach ($tabCharacModel as list($a, $b, $c, $d, $e, $f, $g)) {
            $z++;
            $character = new Character();
            $character->setName($a)
                ->setLevel($b)
                ->setAttack($c)
                ->setDefense($d)
                ->setResistance($e)
                ->setSpeed($f)
                ->setIspremade($g);
            //->setUser($this->getReference($h));
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
