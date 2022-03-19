<?php

namespace App\DataFixtures;

use App\Entity\Formation;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class FormationFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabFormation = [
            ['Bersekers'],
            ['Explorers'],
            ['Sneak team'],
            ['Snipers'],
            ['SpeleoBoyz'],
            ['Justice league'],
            ['JYM'],
            ['ArcheoWinners'],
            ['Gunners'],
        ];

        $z = 0;
        foreach ($tabFormation as list($a)) {
            $z++;
            $formation = new Formation();
            $formation->setName($a);

            $manager->persist($formation);
            $this->addReference('formation' . $z, $formation);
        }

        $manager->flush();
        unset($z, $a);
    }

    public function getOrder()
    {
        return 3;
    }
}
