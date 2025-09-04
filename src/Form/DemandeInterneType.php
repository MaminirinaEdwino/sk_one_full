<?php

namespace App\Form;

use App\Entity\CategorieFonctionnelle;
use App\Entity\DemandeInterne;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeInterneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ]
            ])
            ->add('niveau', ChoiceType::class, [
                'choices'=>[
                    'Bas'=>'Bas',
                    'Moyen'=>'Moyen',
                    'Elevé'=>'Elevé',
                    'Urgent'=>'Urgent'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ]
            ])
            // ->add('dateEnvoi')
            // ->add('dateModif')
            ->add('categorie', EntityType::class, [
                'class' => CategorieFonctionnelle::class,
                'choice_label' => 'nom',
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ]
            ])
            // ->add('auteur', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeInterne::class,
        ]);
    }
}
