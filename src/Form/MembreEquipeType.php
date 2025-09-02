<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\MembreEquipe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreEquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('membre', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $membre) => $membre->getEmployee()->getNom(). ' '.$membre->getEmployee()->getPrenom(),
                'attr'=>['class'=>'form-control'],
                'label_attr'=>['class'=>'form-label'],
            ])
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => 'nom',
                'attr'=>['class'=>'form-control'],
                'label_attr'=>['class'=>'form-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MembreEquipe::class,
        ]);
    }
}
