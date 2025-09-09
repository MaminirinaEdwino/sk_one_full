<?php

namespace App\Twig\Components;

use App\Repository\ProjetRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListProjet
{
    use DefaultActionTrait;

    #[LiveProp(writable:true)]
    public int $page=1;
    #[LiveProp(writable:true)]
    public int $limit=10;

    #[LiveProp(writable:true)]
    public int $total;
    public array $list;
    public ProjetRepository $projetRepository;

    public function __construct(ProjetRepository $projetRepository){
        $this->projetRepository = $projetRepository;
        $this->total = ceil($this->projetRepository->count()/$this->limit);
        $this->list = $this->projetRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }

    #[LiveAction]
    public function nextPage(#[LiveArg] int $page){
        $this->page = $page;
        $this->total = ceil($this->projetRepository->count()/$this->limit);
        $this->list = $this->projetRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }
}
