<?php

namespace App\DataFixtures;

use App\Entity\CharacterFormation;
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
            ['Bersekers', 'admin'],
            ['Explorers', 'admin'],
            ['Sneak team', 'admin'],
            ['Snipers', 'admin'],
            ['ArcheoWinners', 'admin'],
            ['Gunners', 'admin'],
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

        // ***************************************************************************************************************************
        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'admin'

        // Pour chaque formation
        for ($j = 1; $j <= 7; $j++) {
            $var_formation = 'formation' . $j;
            for ($i = 14; $i <= 18; $i++) {
                // Pour les 5 persos
                $alea = rand(14, 18);
                $var_character = 'character' . $alea;

                $tabPositionCharacter = array('Devant', 'Milieu', 'Derrière');
                $var_positionCharacter = array_rand($tabPositionCharacter, 1);
                $var_positionCharacter = $tabPositionCharacter[$var_positionCharacter];

                $characterFormation = new CharacterFormation();
                $characterFormation->setCharacters($this->getReference($var_character))
                    ->setFormations($this->getReference($var_formation))
                    ->setPositionCharacter($var_positionCharacter);

                $manager->persist($characterFormation);
                $manager->flush();
                unset($characterFormation);
            }
        }
        // ******************************************************************************************************************************


    }

    public function getOrder()
    {
        return 3;
    }
}
