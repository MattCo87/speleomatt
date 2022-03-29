<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\User;
use App\Entity\CharacterFormation;
use App\Entity\Formation;
use App\Repository\CharacterFormationRepository;
use App\Repository\FormationRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Security as CoreSecurity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;

class FormationType extends AbstractType
{
    private $security;

    public function __construct(CoreSecurity $security, ManagerRegistry $registry)
    {
        $this->security = $security;
        $this->doctrine = $registry;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            // On affiche la liste des Formations
            ->add('formations', EntityType::class, array(
                'class' => Formation::class,

                'query_builder' => function (FormationRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.user = :val')
                        ->setParameter('val', $this->security->getUser());
                },

                'choice_label' => 'name',
            ))


            // On affiche la liste des Characters
            ->add('characters', EntityType::class, array(
                'class' => Character::class,

                'query_builder' => function (CharacterRepository $er) {
                    $qb = $er->createQueryBuilder('c')
                            ->where('c.user = :val')
                        /*         
                        ->andWhere('c.id NOT IN ( SELECT f.characters_id FROM character_formation f)')
                        */
                            ->setParameter('val', $this->security->getUser());
                        
                    return $qb->andWhere($qb->expr()->notIn('c.characterFormations', ));

                },

                'choice_label' => 'name',

            ))

            /*
            // On choisit sa localisation
            ->add('positionCharacter', ChoiceType::class, array(
                'choices'  => [
                    'Devant' => 0,
                    'Milieu' => 1,
                    'Derrière' => 2,
                ],
            ))
*/

            // Bouton pour valider la création de la CharacterFormation
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'OK'
                ],
            );;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterFormation::class,
        ]);
    }
}
