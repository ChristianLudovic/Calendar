<?php

namespace App\Livewire\Components;

use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OverviewCalendar extends Component
{
    public $birthdaysByMonth;

    protected $listeners = ['personAdded' => 'loadBirthdays'];

    public function mount()
    {
        $this->loadBirthdays();
    }

    public function loadBirthdays()
    {
        $this->birthdaysByMonth = Person::where('user_id', Auth::user()->id)
            ->select('avatarId', 'birthDate')
            ->get()
            ->map(function ($person) {
                $date = new \DateTime($person->birthDate);
                return [
                    'avatarId' => $person->avatarId,
                    'month' => $date->format('n')
                ];
            })
            ->groupBy('month')
            ->map(function ($group) {
                return [
                    'avatars' => $group->pluck('avatarId')->take(3),
                    'count' => $group->count()
                ];
            });
    }

    public function render()
    {
        return view('livewire.components.overview-calendar');
    }
}
