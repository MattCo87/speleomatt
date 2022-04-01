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
            ['Log du combat N°1', $now, 'formation1'],
            ['Log du combat N°2', $now, 'formation2'],
            ['Log du combat N°3', $now, 'formation3'],
            ['Log du combat N°4', $now, 'formation4'],
            ['Log du combat N°5', $now, 'formation5'],
        ];

        $z = 0;
        foreach ($tabFight as list($a, $b, $c)) {
            $z++;
            $fight = new Fight();
            $fight->setLog($a)
                ->setCreatedat($b)
                ->addFormation($this->getReference($c));
            $manager->persist($fight);
        }

        $manager->flush();
        unset($z, $a, $b, $c);

    }

    public function getOrder()
    {
        return 6;
    }
}
