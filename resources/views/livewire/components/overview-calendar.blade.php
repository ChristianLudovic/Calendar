<div class="custom-scrollbar-container">
    <div class="overflow-x-auto custom-scrollbar">
        <div class="flex space-x-6 pb-2">
            @foreach(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'] as $index => $month)
                <div 
                    @click="showCalendar = true; 
                            $wire.dispatch('set-month', { monthNumber: {{ $index + 1 }} })"
                    class="cursor-pointer">
                        <div class="space-y-2">
                            <h2 class="text-[#797B80] text-md font-medium">{{ $month }}</h2>
                            <div class="flex items-center">
                                @php 
                                    $monthData = $birthdaysByMonth[$index + 1] ?? ['avatars' => collect(), 'count' => 0];
                                    $avatars = $monthData['avatars'];
                                    $count = $monthData['count'];
                                @endphp
                                @foreach($avatars as $avatarId)
                                    <div class="w-9 h-9 rounded-full {{ $loop->first ? '' : '-ml-4' }}">
                                        <img src="/{{ $avatarId }}.svg" alt="{{ $avatarId }}" class="w-9 h-9 rounded-full">
                                    </div>
                                @endforeach
                                @if($count > 3 || $avatars->isEmpty())
                                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-[#0F131D] {{ $avatars->isNotEmpty() ? '-ml-4' : '' }}">
                                        <span class="text-sm font-semibold">
                                            {{ $avatars->isEmpty() ? '0' : '+' . ($count - 3) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>
                
            @endforeach
        </div>
    </div>
    <style>
        .custom-scrollbar {
            overflow: hidden; 
            position: relative; 
            height: 100%;
        }

        .custom-scrollbar-container {
            position: relative;
            padding-bottom: 30px; 
        }

    </style>
    <script>
        const scrollbar = document.querySelector('.custom-scrollbar');
        let isDown = false;
        let startX, scrollLeft;

        scrollbar.addEventListener('mousedown', (e) => {
            isDown = true;
            scrollbar.classList.add('active');
            startX = e.pageX - scrollbar.offsetLeft;
            scrollLeft = scrollbar.scrollLeft;
        });

        scrollbar.addEventListener('mouseleave', () => {
            isDown = false;
            scrollbar.classList.remove('active');
        });

        scrollbar.addEventListener('mouseup', () => {
            isDown = false;
            scrollbar.classList.remove('active');
        });

        scrollbar.addEventListener('mousemove', (e) => {
            if (!isDown) return; // Ne rien faire si pas en mode défilement
            e.preventDefault();
            const x = e.pageX - scrollbar.offsetLeft;
            const walk = (x - startX) * 2; // Ajuste la vitesse de défilement
            scrollbar.scrollLeft = scrollLeft - walk;
        });
    </script>

</div>