<div class="w-full space-y-6" 
    x-data="{ 
        showTransition: false,
        direction: 'right'
    }">
    <!-- the heading of the calendar -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button 
                wire:click="previousMonth"
                @click="direction = 'left'; showTransition = true; setTimeout(() => showTransition = false, 300)"
                class="flex items-center justify-center p-2 rounded-full bg-[#0F131D] hover:bg-[#363636] transition">
                <svg class="vuesax-outline-arrow-left2 max-sm:w-4 max-sm:h-4" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 20.67C14.81 20.67 14.62 20.6 14.47 20.45L7.95 13.93C6.89 12.87 6.89 11.13 7.95 10.07L14.47 3.55C14.76 3.26 15.24 3.26 15.53 3.55C15.82 3.84 15.82 4.32 15.53 4.61L9.01 11.13C8.53 11.61 8.53 12.39 9.01 12.87L15.53 19.39C15.82 19.68 15.82 20.16 15.53 20.45C15.38 20.59 15.19 20.67 15 20.67Z" fill="white" />
                </svg>
            </button>
            <button 
                wire:click="nextMonth"
                @click="direction = 'right'; showTransition = true; setTimeout(() => showTransition = false, 300)"
                class="flex items-center justify-center p-2 rounded-full bg-[#0F131D] hover:bg-[#363636] transition">
                <svg class="vuesax-outline-arrow-right2 max-sm:w-4 max-sm:h-4" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.91001 20.67C8.72001 20.67 8.53001 20.6 8.38001 20.45C8.09001 20.16 8.09001 19.68 8.38001 19.39L14.9 12.87C15.38 12.39 15.38 11.61 14.9 11.13L8.38001 4.61C8.09001 4.32 8.09001 3.84 8.38001 3.55C8.67001 3.26 9.15001 3.26 9.44001 3.55L15.96 10.07C16.47 10.58 16.76 11.27 16.76 12C16.76 12.73 16.48 13.42 15.96 13.93L9.44001 20.45C9.29001 20.59 9.10001 20.67 8.91001 20.67Z" fill="white" />
                </svg>
            </button>
            <h2 class="text-2xl md:text-3xl tracking-[1px] font-semibold">
            {{ $this->currentMonthYear['month'] }} 
            <span class="text-[#DDFB24]">{{ $this->currentMonthYear['year'] }}</span>
        </h2>
        </div>
        <button 
            wire:click="closeCalendar"
            @click="showCalendar = false"
            class="flex items-center justify-center p-2 rounded-full bg-[#0F131D] hover:bg-[#363636] transition">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.3 5.71a.996.996 0 00-1.41 0L12 10.59 7.11 5.7A.996.996 0 105.7 7.11L10.59 12 5.7 16.89a.996.996 0 101.41 1.41L12 13.41l4.89 4.89a.996.996 0 101.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" fill="white"/>
            </svg>
        </button>
    </div>
    <div class="space-y-4">
        <!-- dates here -->
        <div class="flex items-center space-x-2 md:space-x-4 justify-between">
            @foreach($dates as $date)
                <div class="flex items-center justify-center w-full py-1 rounded-full bg-[#0F131D]">
                    <span class="text-sm md:text-md font-medium">{{ $date }}</span>
                </div>
            @endforeach
        </div>
        <!-- days here -->
        <div class="grid grid-cols-7 gap-x-4 gap-y-3 max-sm:gap-x-2 max-sm:gap-y-2" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full">
            @foreach($this->calendarDays as $day)
                <div @class([
                    'flex flex-col items-center space-y-3 max-sm:space-y-1 justify-end h-20 max-sm:h-14 pb-1 rounded-xl',
                    'bg-[#0F131D]' => $day['isCurrentMonth'],
                    'bg-transparent' => !$day['isCurrentMonth'],
                    'ring-2 ring-blue-500' => $day['isToday']
                ])>
                    @if($day['isCurrentMonth'])
                        @if($day['birthdays'])
                            <div class="flex items-center">
                                @foreach($day['birthdays']['avatars'] as $avatarId)
                                    <div class="w-[26px] h-[26px] max-sm:w-[18px] max-sm:h-[18px] {{ !$loop->first ? '-ml-4 max-sm:-ml-2' : '' }}">
                                        <img src="/{{ $avatarId }}.svg" alt="{{ $avatarId }}" class="w-full h-full rounded-full">
                                    </div>
                                @endforeach
                                @if($day['birthdays']['count'] > 3)
                                    <div class="flex items-center justify-center w-[26px] h-[26px] max-sm:w-[18px] max-sm:h-[18px] rounded-full bg-[#0F131D] -ml-4 max-sm:-ml-2">
                                        <span class="text-xs">+{{ $day['birthdays']['count'] - 3 }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <span class="text-sm md:text-md font-medium">{{ $day['day'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>