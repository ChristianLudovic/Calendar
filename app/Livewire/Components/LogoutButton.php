<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutButton extends Component
{

    function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.components.logout-button');
    }
}
