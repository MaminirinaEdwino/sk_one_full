<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('chemin', FileType::class, [
                'label'=>'Document'
            ])
            // ->add('tags')
            ->add('type', ChoiceType::class, [
                'choices'=>[
                    'RH'=>'rh',
                    'Public'=>'public',
                    'Archive groupe'=>'archive'
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'choices'=>[
                    'RH'=>'rh',
                    'Juridique'=>'juridique',
                    'Projets'=>'projet',
                    'Partenariats'=>'partenariat',
                    'Communication'=>'communication',
                    'Rapport & activité'=>'rapport',
                    'IT'=>'it',
                    'Support'=>'support'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
