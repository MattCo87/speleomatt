<?php

namespace App\DataFixtures;

use App\Entity\Action;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ActionFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabAction = [
            ['Coup de pied enfantin', '15'],
            ['Coup de pied sincère', '30'],
            ['Coup de pied sarccastique', '50'],
            ['Coup de pied Fury', '75'],
            ['Coup de pied démoniaque', '100'],
            ['Gifle', '15'],
            ['Coup de poing', '30'],
            ['Coup de poing de la honte', '50'],
            ['Coup de poing des Etoiles', '75'],
            ["Coup de poing de l'Enfer", '100'],
            ['Pichenette', '15'],
            ['Coup de boule', '30'],
            ['Fléchette', '50'],
            ['Lancer de Biche', '75'],
            ['Poing du Dragon Blanc', '100'],
            ['Sourire irakien', '15'],
            ['Coup de poing frontal', '30'],
            ['Coup de boule Sonics', '50'],
            ['Pêcheur du Dimanche', '75'],
            ["Chasseur du Temple", '100'],            
        ];

        $z = 0;
        foreach ($tabAction as list($a, $b)) {
            $z++;
            $action = new Action();
            $action->setName($a)
                ->setPower($b);
            $manager->persist($action);
            $this->addReference('action' . $z, $action);
        }

        $manager->flush();
        unset($z, $a, $b);
    }

    public function getOrder()
    {
        return 4;
    }
}
