<?php

namespace App\DataFixtures;

use App\Entity\User;

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
        // Client administrator account
        $admin = new User();
        $admin->setPseudo('Mr X')
            ->setEmail('87700p@gmail.com')
            ->setPassword($this->encoder->encodePassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setExperience(1000);

        $this->addReference('admin', $admin);

        $manager->persist($admin);

        $matt = new User();
        $matt->setPseudo('Lord Aixois')
            ->setEmail('87700a@gmail.com')
            ->setPassword($this->encoder->encodePassword($matt, 'matthieu'))
            ->setRoles(['ROLE_USER'])
            ->setExperience(1);

        $this->addReference('matt', $matt);
        $manager->persist($matt);

        $krikri = new User();
        $krikri->setPseudo('Krikri')
            ->setEmail('87700k@gmail.com')
            ->setPassword($this->encoder->encodePassword($matt, 'krikri'))
            ->setRoles(['ROLE_USER'])
            ->setExperience(1);

        $this->addReference('krikri', $krikri);
        $manager->persist($krikri);

        $test = new User();
        $test->setPseudo('Test')
            ->setEmail('87700t@gmail.com')
            ->setPassword($this->encoder->encodePassword($test, 'test'))
            ->setRoles(['ROLE_USER'])
            ->setExperience(1);

        $this->addReference('test', $test);
        $manager->persist($test);


        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
