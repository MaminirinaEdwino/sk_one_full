<?php

namespace App\Twig\Components;

use App\Repository\EquipeRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListEquipe
{
    use DefaultActionTrait;

    #[LiveProp(writable:true)]
    public int $page = 1;

    #[LiveProp(writable:true)]
    public int $limit = 10;

    #[LiveProp(writable:true)]
    public int $total;

    
    public array $list = [];

    public EquipeRepository $equipe_repository;

    public function __construct(EquipeRepository $equipeRepository)
    {
        $this->equipe_repository = $equipeRepository;
        $this->total = ceil($this->equipe_repository->count()/$this->limit);
        $this->list = $this->equipe_repository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);

    }
    #[LiveAction]
    public function nextPage(#[LiveArg()] int $page){
        $this->page = $page;
        $this->total = ceil($this->equipe_repository->count()/$this->limit);
        $this->list = $this->equipe_repository->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }
}
