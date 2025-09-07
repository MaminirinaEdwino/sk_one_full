<?php

namespace App\Twig\Components;

use App\Repository\EmployeeRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListEmployee
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $limit = 10;

    #[LiveProp(writable: true)]
    public int $page = 1;

    #[LiveProp(writable: true)]
    public int $total;

    #[LiveProp(writable:true)]
    public string $searchValue="";
    public array $employees;
    public EmployeeRepository $empolyeeReposiotory;

    public function __construct(EmployeeRepository $employeeRepository){
        
        $this->empolyeeReposiotory = $employeeRepository;
        $this->ListEmploye();
    }

    public function ListEmploye(){
        $this->total = ceil($this->empolyeeReposiotory->count() / $this->limit);
        $this->employees = $this->empolyeeReposiotory->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
    }
    #[LiveAction()]
    public function nextPage(#[LiveArg()] int $page){
        $this->page = $page;
        $this->ListEmploye();
    }

    #[LiveAction()]
    public function SearchPost(){
        $this->max_pages = ceil($this->empolyeeReposiotory->count(['nom'=>$this->searchValue])/$this->limit);
        if ($this->searchValue != "") {
            $this->postes =  $this->empolyeeReposiotory->findBy(['nom'=>$this->searchValue], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        }else{
            $this->postes =  $this->empolyeeReposiotory->findBy([], ['id'=>'desc'], $this->limit, ($this->page - 1) * $this->limit);
        }
        
    }

}
