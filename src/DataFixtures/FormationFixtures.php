<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\Formation;
use App\Repository\CharacterRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ManagerRegistry;

class FormationFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabFormation = [
            ['Explorers', 'admin'],
            ['Bersekers', 'admin'],
            ['Snipers', 'admin'],
            ['ArcheoWinners', 'admin'],
            ['JYM', 'admin'],
        ];

        $z = 0;
        foreach ($tabFormation as list($a, $b)) {
            $z++;
            $formation = new Formation();
            $formation->setName($a);

            if ($b) {
                $formation->setUser($this->getReference($b));
            }

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
