<?php

namespace App\Twig\Components;

use App\Repository\DemandeInterneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListeDemandeInterne
{
    use DefaultActionTrait;


    #[LiveProp(writable: true)]
    public int $page = 1;

    #[LiveProp(writable: true)]
    public int $limit = 10;
    #[LiveProp(writable: true)]
    public int $total;


    public array $list = [];
    public DemandeInterneRepository $demande_interne;
    public EntityManagerInterface $entity_manager;

    public function __construct(DemandeInterneRepository $demande_interne, EntityManagerInterface $entity_manager)
    {
        $this->demande_interne = $demande_interne;
        $this->entity_manager = $entity_manager;
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function nextPage(#[LiveArg()] int $page)
    {
        $this->page = $page;
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function pending(#[LiveArg()] int $id) {
        $demande = $this->demande_interne->find($id);
        $demande->setStatus('En attente');
        $this->entity_manager->flush();
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function progressing(#[LiveArg()] int $id) {
        $demande = $this->demande_interne->find($id);
        $demande->setStatus('En cours');
        $this->entity_manager->flush();
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function rejected(#[LiveArg()] int $id) {
        $demande = $this->demande_interne->find($id);
        $demande->setStatus('Rejetée');
        $this->entity_manager->flush();
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function completed(#[LiveArg()] int $id) {
        $demande = $this->demande_interne->find($id);
        $demande->setStatus('Traitée');
        $this->entity_manager->flush();
        $this->total = ceil($this->demande_interne->count() / $this->limit);
        $this->list = $this->demande_interne->findBy([], ['id' => 'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }
}
