<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CalendarViewer extends Component
{
    public $currentDate;
    public $dates = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    public $birthdayData = [];
    
    protected $listeners = [
        'personAdded' => 'loadBirthdayData',
        'setMonth' => 'setMonth'
    ];

    #[On('set-month')] 
    public function setMonth(int $monthNumber)  // Changement ici
    {
        $this->currentDate = Carbon::now()->month($monthNumber);
    }

    public function mount()
    {
        $this->currentDate = Carbon::now();
        $this->loadBirthdayData();
    }

    #[On('person-added')]
    public function loadBirthdayData()
    {
        // Charger tous les anniversaires une seule fois
        $persons = Person::where('user_id', Auth::user()->id)
            ->select('avatarId', 'birthDate')
            ->get();

        // Organiser les données par mois-jour pour un accès facile
        $this->birthdayData = $persons
            ->groupBy(function ($person) {
                return Carbon::parse($person->birthDate)->format('m-d');
            })
            ->map(function ($group) {
                return [
                    'avatars' => $group->pluck('avatarId')->take(3)->toArray(),
                    'count' => $group->count()
                ];
            })
            ->toArray();
    }

    public function previousMonth()
    {
        $this->currentDate = Carbon::parse($this->currentDate)->subMonth();
    }

    public function nextMonth()
    {
        $this->currentDate = Carbon::parse($this->currentDate)->addMonth();
    }

    #[Computed]
    public function calendarDays()
    {
        $firstDay = Carbon::parse($this->currentDate)->startOfMonth();
        $lastDay = Carbon::parse($this->currentDate)->endOfMonth();
        
        $days = [];
        $currentDay = $firstDay->copy();

        // Ajouter des cases vides pour les jours avant le début du mois
        for ($i = 0; $i < $firstDay->dayOfWeek; $i++) {
            $days[] = [
                'day' => '',
                'date' => null,
                'isCurrentMonth' => false,
                'isToday' => false,
                'birthdays' => null
            ];
        }

        // Ajouter tous les jours du mois
        while ($currentDay <= $lastDay) {
            $dateKey = $currentDay->format('m-d');
            
            $days[] = [
                'day' => $currentDay->day,
                'date' => $currentDay->copy(),
                'isCurrentMonth' => true,
                'isToday' => $currentDay->isToday(),
                'birthdays' => $this->birthdayData[$dateKey] ?? null
            ];
            $currentDay->addDay();
        }

        return $days;
    }

    #[Computed]
    public function currentMonthYear()
    {
        return [
            'month' => $this->currentDate->format('F'),
            'year' => $this->currentDate->format('Y')
        ];
    }

    public function closeCalendar()
    {
        $this->dispatch('closeCalendar');
    }

    public function render()
    {
        return view('livewire.components.calendar-viewer');
    }
}