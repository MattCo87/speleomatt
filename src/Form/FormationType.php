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

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Security\Core\Security as CoreSecurity;
use Doctrine\Persistence\ManagerRegistry;


class FormationType extends AbstractType
{
    private $security;

    public function __construct(CoreSecurity $security, ManagerRegistry $registry)
    {
        $this->security = $security;
        $this->registry = $registry;
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
                
                'query_builder' => function () {
                    // Une sous requête affichant la liste des personnages appartenant à une formation
                    $ecf = new CharacterFormationRepository($this->registry);
                    $subQueryBuilder = $ecf->createQueryBuilder('cf');
                    $subQuery = $subQueryBuilder
                        ->select('IDENTITY(cf.characters)')            
                    ;

                    // Une requête retournant les personnages appartenants à l'utilisateur et qui ne sont pas dans une formation
                    $er = new CharacterRepository($this->registry);
                    $queryBuilder = $er->createQueryBuilder('c');
                    $query = $queryBuilder
                        ->where($queryBuilder->expr()->notIn('c.id', $subQuery->getDQL()))
                        ->andwhere('c.user = :val')                       
                        ->setParameter('val', $this->security->getUser())    
                    ;
                    
                    return $query;           
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
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterFormation::class,
        ]);
    }
}
