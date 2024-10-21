<?php

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class LoginCard extends Component
{
    public function redirectToProvider($provider)
    {
        return redirect()->route('socialite.redirect', ['provider' => $provider]);
    }

    /*public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }*/

    public function render()
    {
        return view('livewire.components.login-card');
    }
}
