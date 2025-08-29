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
    private $listeMembre = []; 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('snom', null, [
                'label'=>'Nom',
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('dateDebut', null, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('dateFin', null, [
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('assigne', EntityType::class, [
                'class' => MembreEquipe::class,
                'choice_label' => 'id',
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'choices'=>fn(Projet $projet) => $projet->getEquipe()->getMembreEquipes(),
            ])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'nom',
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label '
                ],
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
