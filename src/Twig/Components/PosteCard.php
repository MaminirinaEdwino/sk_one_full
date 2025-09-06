<?php

namespace App\Twig\Components;

use App\Entity\Poste;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class PosteCard
{
    use DefaultActionTrait;

    #[LiveProp()]
    public Poste $poste;
}
