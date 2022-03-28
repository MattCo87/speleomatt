<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Fight;
use App\Entity\Formation;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\FightRepository;
use App\Repository\CharacterRepository;
use App\Security\UserAuthenticator;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(ManagerRegistry $emf, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setExperience(1);
            $user->setRoles(['ROLE_USER']);
            $var_createdat = new DateTime('now');
            $user->setCreatedAt($var_createdat);

            // On lui affecte un combat correspondant à son niveau d'avancement, donc le tutoriel
            $var_fight_repo = new FightRepository($emf);
            $var_fight = $var_fight_repo->find(1);
            $user->setFight($var_fight);

            // On lui affecte une formation
            $var_formation = new Formation;
            $var_formation_name = 'Speleo_' . $user->getPseudo();
            $var_formation->setName($var_formation_name);
            $var_formation->setUser($user);

            // On affecte 5 personnages à l'utilisateur
            for ($i = 0; $i < 5; $i++) {
                $var_character = new Character;
                $alea = rand(1, 9);
                $var_character_repo = new CharacterRepository($emf);
                $clone = $var_character_repo->find($alea);
                $var_character = clone $clone;
                $var_character->setUser($user);
                $var_character->setIspremade(0);
                $entityManager->persist($var_character);
            }
            $entityManager->flush();

            $entityManager->persist($user);
            $entityManager->flush();

            $entityManager->persist($var_formation);
            $entityManager->flush();




            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
