<?php

namespace App\Form;

use App\Entity\BU;
use App\Entity\Employee;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BUType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('manager', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user) => $user->getEmployee()->getNom(). ' '. $user->getEmployee()->getPrenom(),
            ])
            // ->add('employees', EntityType::class, [
            //     'class' => Employee::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BU::class,
        ]);
    }
}
