<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();;
    }

    public function handleProviderCallback($provider)
    {
        
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => $socialUser->getName(),
            'password' => bcrypt(Str::random(16)),
            $provider . '_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
        ]);

        Auth::login($user, true);

        return redirect()->intended('/home');
    }

    
}
