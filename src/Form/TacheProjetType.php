<?php

namespace App\Form;

use App\Entity\MembreEquipe;
use App\Entity\Projet;
use App\Entity\TacheProjet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('snom')
            ->add('status')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('dateCreation')
            ->add('dateAchevement')
            ->add('achevement')
            ->add('assigne', EntityType::class, [
                'class' => MembreEquipe::class,
                'choice_label' => 'id',
            ])
            ->add('assignant', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TacheProjet::class,
        ]);
    }
}
