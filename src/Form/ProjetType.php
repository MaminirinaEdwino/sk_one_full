<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Projet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
            ])
            // ->add('status_achevement')
            // ->add('archive')
            // ->add('dateDebut')
            ->add('dateFin', null, [
                'label'=>"DeadLine",
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('responsable', EntityType::class, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'class' => User::class,
                'choice_label' => fn(User $user)=> $user->getEmployee()->getNom().' '. $user->getEmployee()->getPrenom(),
            ])
            ->add('equipe', EntityType::class, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'class' => Equipe::class,
                'choice_label' => 'nom',
            ])
            // ->add('assignant', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
