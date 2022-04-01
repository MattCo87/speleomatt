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
                    $characterFormation = new CharacterFormation();
                    $characterFormation->setCharacters($this->getReference('character14'));                  
                    $characterFormation->setFormations($formation);

                    break;
                case 2:
                    $characterFormation = new CharacterFormation();
                    $characterFormation->setCharacters($this->getReference('character15'));                  
                    $characterFormation->setFormations($formation);
                    
                    break;
                case 3:
                    $characterFormation = new CharacterFormation();
                    $characterFormation->setCharacters($this->getReference('character16'));                  
                    $characterFormation->setFormations($formation);                   
                    break;
                case 4:
                    $characterFormation = new CharacterFormation();
                    $characterFormation->setCharacters($this->getReference('character17'));                  
                    $characterFormation->setFormations($formation);       
                    break;
                case 5:
                    $characterFormation = new CharacterFormation();
                    $characterFormation->setCharacters($this->getReference('character18'));                  
                    $characterFormation->setFormations($formation);               
                    break;
                default:
                    exit;
                    break;

            }
            $manager->persist($characterFormation);
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
