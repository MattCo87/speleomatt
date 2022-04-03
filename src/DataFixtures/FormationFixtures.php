<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\Formation;
use App\Repository\CharacterRepository;
use App\Repository\FormationRepository;
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


            switch ($z) {
                case 1:
                    for ($j = 1; $j < 6; $j++) {
                        $characterFormation = new CharacterFormation();
                        $characterFormation->setCharacters($this->getReference('character' . $j));
                        $characterFormation->setFormations($formation);
                        $manager->persist($characterFormation);
                    }
                    break;
                case 2:
                    for ($j = 6; $j < 11; $j++) {
                        $characterFormation = new CharacterFormation();
                        $characterFormation->setCharacters($this->getReference('character' . $j));
                        $characterFormation->setFormations($formation);
                        $manager->persist($characterFormation);
                        $manager->flush();
                    }
                    break;
                case 3:
                    for ($j = 11; $j < 16; $j++) {
                        $characterFormation = new CharacterFormation();
                        $characterFormation->setCharacters($this->getReference('character' . $j));
                        $characterFormation->setFormations($formation);
                        $manager->persist($characterFormation);
                        $manager->flush();
                    }
                    break;
                case 4:
                    for ($j = 16; $j < 21; $j++) {
                        $characterFormation = new CharacterFormation();
                        $characterFormation->setCharacters($this->getReference('character' . $j));
                        $characterFormation->setFormations($formation);
                        $manager->persist($characterFormation);
                        $manager->flush();
                    }
                    break;
                case 5:
                    for ($j = 21; $j < 26; $j++) {
                        $characterFormation = new CharacterFormation();
                        $characterFormation->setCharacters($this->getReference('character' . $j));
                        $characterFormation->setFormations($formation);
                        $manager->persist($characterFormation);
                        $manager->flush();
                    }
                    break;
                default:
                    exit;
                    break;
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
