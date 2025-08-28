<?php

namespace App\Form;

use App\Entity\TacheNormale;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheNormaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('dateCreation')
            ->add('dateAchevement')
            ->add('achevement')
            ->add('status')
            ->add('assigne', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('assignant', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TacheNormale::class,
        ]);
    }
}
