<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Client administrator account
        $admin = new User();
        $admin->setPseudo('Mr X')
            ->setEmail('87700p@gmail.com')
            ->setPassword($this->encoder->encodePassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $matt = new User();
        $matt->setPseudo('Lord Aixois')
            ->setEmail('87700a@gmail.com')
            ->setPassword($this->encoder->encodePassword($matt, 'matthieu'))
            ->setRoles(['ROLE_USER']);

        $manager->persist($matt);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}