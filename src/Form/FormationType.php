<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\CharacterFormation;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            // On affiche la liste des Formations
            ->add('formations', TextType::class, array(
                'label' => 'Donne un nom à ton équipe '
            ))

            
            // On affiche la liste des Characters
            ->add('characters', EntityType::class, array(
                'class' => Character::class,
                'choice_label' => 'name',
            ))
            
/*
            // On affiche la liste des Characters
            ->add('characters', EntityType::class, [
                'class' => Character::class,
                'multiple' => true,
                'expanded' => true,
            ])
*/
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
