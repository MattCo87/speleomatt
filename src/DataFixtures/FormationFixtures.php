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

        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'matt'
        for ($i = 19; $i <= 23; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation5'))
                ->setPositionCharacter('une position du perso')
                ->setStrategyUser('une donnée qui ne sert à rien !');

            $manager->persist($characterFormation);
            $manager->flush();
            unset($characterFormation);
        }
        // ******************************************************************************************************************************
        // ***************************************************************************************************************************
        // On implémente les characterFormation de 'admin'
        for ($i = 14; $i <= 18; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            $characterFormation = new CharacterFormation();
            $characterFormation->setCharacters($this->getReference($var_character))
                ->setFormations($this->getReference('formation7'))
                ->setPositionCharacter('une position du perso')
                ->setStrategyUser('une donnée qui ne sert à rien !');

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
