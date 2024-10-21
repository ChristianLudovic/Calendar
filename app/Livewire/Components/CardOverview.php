<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CardOverview extends Component
{
    public $isOpen = true;

    public function closeCard(){
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.components.card-overview');
    }
}
