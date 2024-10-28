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
    <body 
        class=" text-[#F2F2F2] px-4  h-screen bg-cover bg-no-repeat" 
        style="
            font-family: 'Clash Display', sans-serif;
            background-image: url('/bg.svg');
    ">
        <main class="max-w-7xl w-full mx-auto h-screen flex flex-col justify-between py-6">
            <header class="flex items-center justify-between ">
                <div>
                    <img src="/logo.svg" alt="Logo" class="w-40">
                </div>
                <form action="{{ route('auth.redirect', ['provider' => 'google']) }}" method="GET" class="inline">
                    <button 
                        type="submit"
                        class="flex items-center justify-center px-3 py-2 rounded-md bg-white text-black font-semibold"
                    >
                        Get started now
                    </button>
                </form>

            </header>
            <div>
                <h1 class="max-w-[935px] text-[70px] font-semibold leading-[100px]">Your <span class="text-black px-1 py-2 bg-[#DDFB24]">Moments,</span> Your Memories, Your <span class="text-black px-1 py-2 bg-[#DDFB24]">Calendar.</span></h1>
            </div>
        </main>
        
        @livewireScripts
    </body>
</html>
