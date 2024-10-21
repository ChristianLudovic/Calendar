<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $cutoffDate = $today->copy()->addDays(20);

        $upcomingBirthdays = Person::all()
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

        return view('app', compact('upcomingBirthdays'));
    }

    private function calculateAge($birthDate, $nextBirthday)
    {
        $age = $nextBirthday->year - $birthDate->year;
        if ($nextBirthday->format('md') < $birthDate->format('md')) {
            $age--;
        }
        return $age;
    }

    
}
