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
            $var_formation_name = 'Speleo' . ucfirst(str_replace(' ', '', $user->getPseudo()));
            $var_formation->setName($var_formation_name);
            $var_formation->setUser($user);            
            $entityManager->persist($var_formation);

            // Puis une deuxième pour l'exemple
            $var_formation2 = new Formation;
            $var_formation2_name = ucfirst(str_replace(' ', '', $user->getPseudo())). "Boyz";
            $var_formation2->setName($var_formation2_name);
            $var_formation2->setUser($user);            
            $entityManager->persist($var_formation2);

            // On affecte 10 personnages à l'utilisateur
            $var_character_repo = new CharacterRepository($emf);
            $var_tab_character = $var_character_repo->findPremade();

            for ($i = 0; $i < 10; $i++) {

                $alea = rand(0, 8);
                while (!(isset($var_tab_character[$alea]))) {
                    $alea = rand(0, 12);
                };

                $clone = $var_tab_character[$alea];

                $var_character = new Character;
                $var_character->setName($clone['name'])
                    ->setLevel($clone['level'])
                    ->setAttack($clone['attack'])
                    ->setDefense($clone['defense'])
                    ->setResistance($clone['resistance'])
                    ->setSpeed($clone['speed'])
                    ->setUser($user)
                    ->setIspremade(0)
                ;
                $entityManager->persist($var_character);

                $tab_clone[] = $var_tab_character[$alea];
                unset($var_tab_character[$alea]);
            }

            $entityManager->persist($user);
            $entityManager->flush();



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
