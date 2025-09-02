<?php

namespace App\Form;

use App\Entity\TacheNormale;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheNormaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr'=>['class'=>'form-control'],
                'label_attr'=>['class'=>'form-label']
            ])
            ->add('description', TextType::class, [
                'attr'=>['class'=>'form-control'],
                'label_attr'=>['class'=>'form-label']
            ])
            // ->add('dateDebut')
            ->add('dateFin', null, [
                'label'=>'Deadline',
                'attr'=>['class'=>'form-control'],
                'label_attr'=>['class'=>'form-label']
            ])
            // ->add('dateCreation')
            // ->add('dateAchevement')
            // ->add('achevement')
            // ->add('status')
            ->add('assigne', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user)=>$user->getEmployee()->getNom().' '.$user->getEmployee()->getPrenom(),
                'attr'=>['class'=>'form-control mb-2'],
                'label_attr'=>['class'=>'form-label']
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
            'data_class' => TacheNormale::class,
        ]);
    }
}
