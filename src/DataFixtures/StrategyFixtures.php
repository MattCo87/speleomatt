<?php

namespace App\DataFixtures;

use App\Entity\Strategy;

use App\Entity\ActionStrategy;
use App\Entity\Action;

use App\Entity\CharacterStrategy;
use App\Entity\Character;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StrategyFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // On implémente les stratégies
        $tabStrategy = [
            ['TrankilUp'],
            ['OKLM'],
            ['Présent'],
            ['Losange'],
            ['Carré'],
            ['Rond'],
            ['Tortue'],
            ['Brésilienne'],
            ['Remoise'],
            ['ASM'],
        ];

        $z = 0;
        foreach ($tabStrategy as list($a)) {
            $z++;
            $strategy = new Strategy();
            $strategy->setName($a);

            $manager->persist($strategy);
            $this->addReference('strategy' . $z, $strategy);
        }

        $manager->flush();
        unset($z, $a);

        // On implémente les actionStrategy
        for ($i = 1; $i <= 10; $i++) {
            // Pour les 10 stratégies
            $var_strategy = 'strategy' . $i;

            for ($j = 1; $j <= 5; $j++) {
                // On choisit une action aléatoire de 1 à 20
                $alea = rand(1, 20);
                $var_action = 'action' . $alea;

                $actionStrategy = new ActionStrategy();
                $actionStrategy->setActions($this->getReference($var_action))
                    ->setStrategies($this->getReference($var_strategy))
                    ->setPositionAction($j);

                $manager->persist($actionStrategy);
                $manager->flush();
                unset($actionStrategy);
            }
        }

        // On implémente les characterStrategy de 'matt'
        for ($i = 19; $i <= 23; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            for ($j = 1; $j <= 4; $j++) {
                // On choisit une stratégie aléatoire de 1 à 10
                $alea = rand(1, 10);
                $var_strategy = 'strategy' . $alea;

                $characterStrategy = new CharacterStrategy();
                $characterStrategy->setCharacters($this->getReference($var_character))
                    ->setStrategies($this->getReference($var_strategy))
                    ->setPositionStrategie($j);

                $manager->persist($characterStrategy);
                $manager->flush();
                unset($characterStrategy);
            }
        }

        // On implémente les characterStrategy de 'krikri'
        for ($i = 24; $i <= 28; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            for ($j = 1; $j <= 4; $j++) {
                // On choisit une stratégie aléatoire de 1 à 10
                $alea = rand(1, 10);
                $var_strategy = 'strategy' . $alea;

                $characterStrategy = new CharacterStrategy();
                $characterStrategy->setCharacters($this->getReference($var_character))
                    ->setStrategies($this->getReference($var_strategy))
                    ->setPositionStrategie($j);

                $manager->persist($characterStrategy);
                $manager->flush();
                unset($characterStrategy);
            }
        }

        // On implémente les characterStrategy de 'test'
        for ($i = 29; $i <= 33; $i++) {
            // Pour les 5 persos
            $var_character = 'character' . $i;

            for ($j = 1; $j <= 4; $j++) {
                // On choisit une stratégie aléatoire de 1 à 10
                $alea = rand(1, 10);
                $var_strategy = 'strategy' . $alea;

                $characterStrategy = new CharacterStrategy();
                $characterStrategy->setCharacters($this->getReference($var_character))
                    ->setStrategies($this->getReference($var_strategy))
                    ->setPositionStrategie($j);

                $manager->persist($characterStrategy);
                $manager->flush();
                unset($characterStrategy);
            }
        }

    }

    public function getOrder()
    {
        return 5;
    }
}
