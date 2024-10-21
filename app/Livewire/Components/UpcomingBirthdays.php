<?php

namespace App\Livewire\Components;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpcomingBirthdays extends Component
{

    public $upcomingBirthdays;

    protected $listeners = ['personAdded' => 'refreshList'];

    public function mount()
    {
        $this->refreshList();
    }

    public function refreshList()
    {
        $today = Carbon::today();
        $cutoffDate = $today->copy()->addDays(20);

        $this->upcomingBirthdays = Person::where('user_id', Auth::user()->id)
            ->get()
            ->map(function ($person) use ($today) {
                $birthDate = Carbon::parse($person->birthDate);
                $nextBirthday = $birthDate->copy()->year($today->year);
                if ($nextBirthday->isPast()) {
                    $nextBirthday->addYear();
                }
                $person->daysUntilBirthday = $today->diffInDays($nextBirthday, false);
                $person->age = $this->calculateAge($birthDate, $nextBirthday);
                $person->nextBirthdayDate = $nextBirthday->format('F d');
                return $person;
            })
            ->filter(function ($person) {
                return $person->daysUntilBirthday >= 0 && $person->daysUntilBirthday <= 20;
            })
            ->sortBy('daysUntilBirthday');
    }

    private function calculateAge($birthDate, $nextBirthday)
    {
        $age = $nextBirthday->year - $birthDate->year;
        if ($nextBirthday->format('md') < $birthDate->format('md')) {
            $age--;
        }
        return $age;
    }

    public function isEmpty()
    {
        return $this->upcomingBirthdays->isEmpty();
    }

    public function render()
    {
        return view('livewire.components.upcoming-birthdays');
    }
}
