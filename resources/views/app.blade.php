<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://api.fontshare.com/v2/css?f[]=clash-display@300,400,500,600,700&display=swap" rel="stylesheet">
        <title>Calendar</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-black text-white px-4 py-14 max-sm:py-9" style="font-family: 'Clash Display', sans-serif;">
        <main class="mx-auto max-w-2xl w-full">
            <div class="flex items-center justify-between mb-11">
                <h1 class="text-2xl font-bold tracking-[2px]">Birthdays</h1>
                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-11 h-11 rounded-full border border-solid border-[#161618]">
                <!--@livewire('components.logout-button')-->
                
            </div>
            @livewire('components.overview-calendar')
            @livewire('components.upcoming-birthdays')
            
        </main>
        @livewire('components.nav-bar')
        @livewireScripts
    </body>
</html>
