<?php

namespace App\Twig\Components;

use App\Repository\TacheNormaleRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListTacheNormal
{
    use DefaultActionTrait;

    #[LiveProp(writable:true)]
    public int $page = 1;
    #[LiveProp(writable:true)]
    public int $total;

    #[LiveProp(writable:true)]
    public int $limit = 10;

    public array $list= [];

    public TacheNormaleRepository $tacheNormaleRepository;
    public EntityManagerInterface $entityManager;
    
    public function __construct(TacheNormaleRepository $tacheNormaleRepository, EntityManagerInterface $entity_manager){
        $this->tacheNormaleRepository = $tacheNormaleRepository;
        $this->entityManager = $entity_manager;
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);
        
    }
    #[LiveAction]
    public function nextPage(#[LiveArg] int $page){
        $this->page = $page;
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);
    }

    #[LiveAction]
    public function changeStatusBlock(#[LiveArg] int $id){
        $tache = $this->tacheNormaleRepository->find($id);
        $tache->setStatus('bloquée');
        $this->entityManager->flush();
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);
    }
    #[LiveAction]
    public function changeStatusInProgress(#[LiveArg] int $id){
        $tache = $this->tacheNormaleRepository->find($id);
        $tache->setStatus('en cours');
        $tache->setDateDebut(new DateTime('now'));
        $this->entityManager->flush();
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);

    }
    #[LiveAction]
    public function changeStatusCompleted(#[LiveArg] int $id){
        $tache = $this->tacheNormaleRepository->find($id);
        $tache->setStatus('terminée');
        $tache->setDateAchevement(new DateTime('now'));

        if ($tache->getDateFin() < $tache->getDateAchevement()) {
            $tache->setAchevement("en retard");
        }else{
            $tache->setAchevement("a temps");
        }

        $this->entityManager->flush();
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);
    }
    #[LiveAction]
    public function changeStatusPending(#[LiveArg] int $id){
        $tache = $this->tacheNormaleRepository->find($id);
        $tache->setStatus('en attente');
        $this->entityManager->flush();
        $this->list = $this->tacheNormaleRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        $this->total = ceil($this->tacheNormaleRepository->count()/$this->limit);
    }
}
