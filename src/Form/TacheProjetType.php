<?php

namespace App\Form;

use App\Entity\MembreEquipe;
use App\Entity\Projet;
use App\Entity\TacheProjet;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheProjetType extends AbstractType
{
     
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // $projet = $options['projet'];
        $projet = $options['data']->getProjet();
        $equipe = $projet->getEquipe();

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
            
            ->add('dateFin', null, [
                'label'=>"DeadLine",
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
            ])
            ->add('assigne', EntityType::class, [
                'class' => MembreEquipe::class,
                'choice_label' => fn(MembreEquipe $membre) => $membre->getMembre()->getEmployee()->getNom(). ' '. $membre->getMembre()->getEmployee()->getPrenom(),
                'attr'=>[
                    'class'=>'form-control mb-3'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'query_builder'=> function (EntityRepository $entityRepository) use ($equipe) {
                    return $entityRepository->createQueryBuilder('m')
                        ->select('m', 'u', 'e')
                        ->join('m.membre','u')
                        ->join('u.employee', 'e')
                        ->where('m.equipe = :equipe')
                        ->setParameter('equipe', $equipe);
                }
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
