<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function redirectToProvider($provider)
    {
        return redirect()->route('socialite.redirect', ['provider' => $provider]);
    }
    public function index()
    {
        return view('index');
    }
}
