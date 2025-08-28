<?php

namespace App\Form;

use App\Entity\BU;
use App\Entity\Employee;
use App\Entity\Poste;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('emailpro')
            ->add('telephone')
            ->add('addresse')
            ->add('dateEntree')
            // ->add('dateSortie')
            ->add('poste', EntityType::class, [
                'class' => Poste::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('BU', EntityType::class, [
                'class' => BU::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
