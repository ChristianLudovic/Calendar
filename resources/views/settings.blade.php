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
    <body class="bg-[#0A0E17] text-[#F2F2F2] px-4 py-14 max-sm:py-9" style="font-family: 'Clash Display', sans-serif;">
        <main class="mx-auto max-w-2xl w-full">
            <div class="flex items-center justify-between mb-11">
                <h1 class="text-2xl font-bold tracking-[2px]">Settings</h1>
                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-11 h-11 rounded-full border border-solid border-[#1F242F]">
            </div>
            <div class="space-y-6">
                <div class="space-y-3">
                    <h2 class="text-lg font-medium tracking-[0.7px]">General</h2>
                    <div class="w-full flex p-4 space-x-4 rounded-[20px] border border-solid border-[#1F242F]">
                        <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="w-14 h-14 rounded-full border border-solid border-[#1F242F]">
                        <div class="space-y-[2px]">
                            <h2 class="text-lg font-semibold tracking-[0.7px]">{{Auth::user()->name}}</h2>
                            <p class="text-sm text-[#797B80]">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="w-full rounded-[20px] border border-solid border-[#1F242F]">
                        <div class="px-[20px] py-4 space-y-[3px] border-b border-solid border-[#1F242F]">
                            <h2 class="text-lg font-semibold tracking-[0.7px]">Appearance</h2>
                            <p class="text-[#797B80] text-md">Change how this app looks like.</p>
                        </div>
                        <div class="p-3 pr-[20px] flex justify-end">
                            <button class="flex items-center justify-center px-3 py-2 rounded-md border border-solid border-[#1F242F]">
                                <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="currentColor" fill="none">
                                    <path d="M21.5 14.0784C20.3003 14.7189 18.9301 15.0821 17.4751 15.0821C12.7491 15.0821 8.91792 11.2509 8.91792 6.52485C8.91792 5.06986 9.28105 3.69968 9.92163 2.5C5.66765 3.49698 2.5 7.31513 2.5 11.8731C2.5 17.1899 6.8101 21.5 12.1269 21.5C16.6849 21.5 20.503 18.3324 21.5 14.0784Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="w-full rounded-[20px] border border-solid border-[#1F242F]">
                        <div class="px-[20px] py-4 space-y-[3px] border-b border-solid border-[#1F242F]">
                            <h2 class="text-lg font-semibold tracking-[0.7px]">Language</h2>
                            <p class="text-[#797B80] text-md">Change the language of this app.</p>
                        </div>
                        <div class="p-3 pr-[20px] flex justify-end">
                            <button class="flex items-center justify-center px-4 py-2 rounded-md border border-solid border-[#1F242F]">
                                <span>En</span>
                            </button>
                        </div>
                    </div>
                    
                </div>
                <div class="space-y-3">
                    <div class="w-full rounded-[20px] border border-solid border-[#1F242F]">
                        <div class="px-[20px] py-4 space-y-[3px] border-b border-solid border-[#1F242F]">
                            <h2 class="text-lg font-semibold tracking-[0.7px]">Disconnect</h2>
                            <p class="text-[#797B80] text-md">Log from this account out.</p>
                        </div>
                        <div class="p-3 pr-[20px] flex justify-end">
                            @livewire('components.logout-button')
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    
                </div>
            </div>
            
            
        </main>
        @livewire('components.nav-bar')
        @livewireScripts
    </body>
</html>
