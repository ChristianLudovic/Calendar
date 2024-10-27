<?php

namespace App\Livewire\Components;

use Livewire\Component;

class NavBar extends Component
{
    public $activeTab;

    public function redirectToPage($page){
        $this->activeTab = $page;
        return redirect()->route($page) ;
    }


    public function render()
    {
        return view('livewire.components.nav-bar');
    }
}
