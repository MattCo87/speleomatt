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
            ['Bersekers',''],
            ['Explorers','test'],
            ['Sneak team',''],
            ['Snipers',''],
            ['SpeleoBoyz','matt'],
            ['Justice league',''],
            ['JYM','admin'],
            ['ArcheoWinners','krikri'],
            ['Gunners',''],
        ];

        $z = 0;
        foreach ($tabFormation as list($a, $b)) {
            $z++;
            $formation = new Formation();
            $formation->setName($a);

            if($b){
                $formation->setUser($this->getReference($b));
            }

            $manager->persist($formation);
            $this->addReference('formation' . $z, $formation);
        }

        $manager->flush();
        unset($z, $a);

        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'matt'
        for ($i = 19; $i <= 23; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            $tabPositionCharacter = array('Devant', 'Milieu', 'Derrière');
            $var_positionCharacter = array_rand($tabPositionCharacter, 1);
            $var_positionCharacter = $tabPositionCharacter[$var_positionCharacter];

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation5'))
                ->setPositionCharacter($var_positionCharacter);

            $manager->persist($characterFormation);
            $manager->flush();
            unset($characterFormation);
        }
        // ******************************************************************************************************************************

        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'krikri'
        for ($i = 24; $i <= 28; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            $tabPositionCharacter = array('Devant', 'Milieu', 'Derrière');
            $var_positionCharacter = array_rand($tabPositionCharacter, 1);
            $var_positionCharacter = $tabPositionCharacter[$var_positionCharacter];

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation8'))
                ->setPositionCharacter($var_positionCharacter);

            $manager->persist($characterFormation);
            $manager->flush();
            unset($characterFormation);
        }
        // ******************************************************************************************************************************
        
        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'test'
        for ($i = 29; $i <= 33; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            $tabPositionCharacter = array('Devant', 'Milieu', 'Derrière');
            $var_positionCharacter = array_rand($tabPositionCharacter, 1);
            $var_positionCharacter = $tabPositionCharacter[$var_positionCharacter];

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation2'))
                ->setPositionCharacter($var_positionCharacter);

            $manager->persist($characterFormation);
            $manager->flush();
            unset($characterFormation);
        }
        // ******************************************************************************************************************************
        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'admin'
        for ($i = 14; $i <= 18; $i++) {
            // Pour les 5 persos
            $alea = rand(14, 18);
            $var_character = 'character' . $alea;

            $tabPositionCharacter = array('Devant', 'Milieu', 'Derrière');
            $var_positionCharacter = array_rand($tabPositionCharacter, 1);
            $var_positionCharacter = $tabPositionCharacter[$var_positionCharacter];

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation7'))
                ->setPositionCharacter($var_positionCharacter);

            $manager->persist($characterFormation);
            $manager->flush();
            unset($characterFormation);
        }
        // ******************************************************************************************************************************


    }

    public function getOrder()
    {
        return 3;
    }
}
