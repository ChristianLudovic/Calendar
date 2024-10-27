<div>
    <h2 class="mb-4 text-md font-medium text-[#797B80]">UPCOMING</h2>
    @if($upcomingBirthdays->isEmpty())
        <div class="flex flex-col items-center justify-center space-y-4 rounded-[50px] w-full h-[280px]">
            <img src="/17.svg" alt="17" class="w-24 h-24 rounded-full">
            <div class="text-center">
                <h2 class="text-xl text-center font-semibold tracking-[1px] text-[#797B80]">No upcoming birthdays</h2>
            </div>
        </div>
    @else
    <div class="space-y-3">
        @foreach($upcomingBirthdays as $person)
            @livewire('components.upcoming-date', [
                'imagePath' => "/{$person->avatarId}.svg",
                'name' => $person->name,
                'date' => $person->nextBirthdayDate,
                'age' => $person->age
            ], key($person->id))
        @endforeach
    </div>
    @endif
</div>
