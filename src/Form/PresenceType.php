<?php

namespace App\Form;

use App\Entity\JourDeTravail;
use App\Entity\Presence;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('status')
            ->add('heureArrive')
            ->add('heureDepart')
            ->add('Employee', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('jourdetravail', EntityType::class, [
                'class' => JourDeTravail::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
