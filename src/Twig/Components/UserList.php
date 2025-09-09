<?php

namespace App\Twig\Components;

use App\Repository\UserRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class UserList
{
    use DefaultActionTrait;

    #[LiveProp(writable:true)]
    public int $page=1;
    #[LiveProp(writable:true)]
    public int $total;
    #[LiveProp(writable:true)]
     
    public int $limit=10;

    public array $list = [];
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
        $this->list = $this->userRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page-1) * $this->limit);
        $this->total = ceil($this->userRepository->count()/$this->limit);
    }
    
    #[LiveAction]
    public function nextPage(#[LiveArg] int $page){
        $this->page = $page;
        $this->list = $this->userRepository->findBy([], ['id'=>'desc'], $this->limit, ($this->page-1) * $this->limit);
        $this->total = ceil($this->userRepository->count()/$this->limit);
    }
}
