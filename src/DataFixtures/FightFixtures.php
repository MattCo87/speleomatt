<?php

namespace App\DataFixtures;

use App\Entity\Fight;
use App\Entity\Formation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Validator\Constraints\Date;

class FightFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $now = new DateTime('now');
        $tabFight = [
            ['Log du combat N°1', $now],
            ['Log du combat N°2', $now],
            ['Log du combat N°3', $now],
            ['Log du combat N°4', $now],
            ['Log du combat N°5', $now],
        ];

        $z = 0;
        foreach ($tabFight as list($a, $b)) {
            $z++;
            $fight = new Fight();
            $fight->setLog($a)
                ->setCreatedat($b);

            if ($z == 1) {
                $fight->addFormation($this->getReference('formation5'));
                $fight->addFormation($this->getReference('formation7'));
            }
            $manager->persist($fight);
            $this->addReference('fight' . $z, $fight);
        }

        $manager->flush();
        unset($z, $a, $b);
    }

    public function getOrder()
    {
        return 6;
    }
}
