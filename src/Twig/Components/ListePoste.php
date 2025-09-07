<?php

namespace App\Twig\Components;

use App\Repository\PosteRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListePoste
{
    use DefaultActionTrait;

    #[LiveProp(writable:true)]
    public $item_per_page = 10;

    #[LiveProp(writable:true)]
    public $page = 1;
    
    #[LiveProp(writable:true)]
    public string $searchValue = '';
    public array $postes;
    
    #[LiveProp(writable:true)]
    public int $max_pages;
    public PosteRepository $posteRepository;
    public function __construct(PosteRepository $posteRepository){
        $this->posteRepository = $posteRepository;
        $this->ListePost();
    }
    public function ListePost(){
        $this->max_pages = ceil($this->posteRepository->count()/$this->item_per_page);
        $this->postes =  $this->posteRepository->findBy([], ['id'=>'desc'], $this->item_per_page, ($this->page - 1) * $this->item_per_page);
    }
    #[LiveAction()]
    public function SearchPost(){
        $this->max_pages = ceil($this->posteRepository->count(['nom'=>$this->searchValue])/$this->item_per_page);
        if ($this->searchValue != "") {
            $this->postes =  $this->posteRepository->findBy(['nom'=>$this->searchValue], ['id'=>'desc'], $this->item_per_page, ($this->page - 1) * $this->item_per_page);
        }else{
            $this->postes =  $this->posteRepository->findBy([], ['id'=>'desc'], $this->item_per_page, ($this->page - 1) * $this->item_per_page);
        }
        
    }
    #[LiveAction()]
    public function NextPage(#[LiveArg] int $page){
        $this->max_pages = ceil($this->posteRepository->count()/$this->item_per_page);
        $this->page = $page;
        $this->ListePost();
    }
}
