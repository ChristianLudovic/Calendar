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
    <body class="relative bg-black text-white px-4 py-14 max-sm:py-9 flex justify-center items-center h-screen" style="font-family: 'Clash Display', sans-serif;">
        @livewire('components.login-card')
        
        @livewireScripts
    </body>
</html>
