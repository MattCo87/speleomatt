<?php

namespace App\DataFixtures;

use App\Entity\Fight;
use App\Entity\User;
use App\Repository\FightRepository;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures
extends Fixture
implements OrderedFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $var_fight = new Fight();
        $var_fight->setLog("Tutorial");

        // Client administrator account
        $admin = new User();
        $admin->setPseudo('Mr X')
            ->setEmail('87700p@gmail.com')
            ->setPassword($this->encoder->encodePassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN']);

        $var_createdat = new DateTime('now');
        $admin->setCreatedAt($var_createdat);

        $admin->setFight($var_fight->setCreatedat(new DateTime('now')))
            ->setExperience(1000);

        $this->addReference('admin', $admin);

        $manager->persist($admin);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
