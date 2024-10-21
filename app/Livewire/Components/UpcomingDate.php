<?php

namespace App\Livewire\Components;

use Livewire\Component;

class UpcomingDate extends Component
{

    public $imagePath;
    public $name;
    public $date;
    public $age;
    public $isExpanded = false;
    public $isEmpty = true;

    public function mount($imagePath, $name, $date, $age)
    {
        $this->imagePath = $imagePath;
        $this->name = $name;
        $this->date = $date;
        $this->age = $age;
    }

    public function toggleCard()
    {
        $this->isExpanded = !$this->isExpanded;
    }

    public function render()
    {
        return view('livewire.components.upcoming-date');
    }
}
