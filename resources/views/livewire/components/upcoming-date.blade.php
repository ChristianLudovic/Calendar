<div x-data="{ isExpanded: @entangle('isExpanded') }" 
     class="relative cursor-pointer"
     @click="isExpanded = !isExpanded"
     x-bind:class="{ 'h-[410px]': isExpanded }">
    <div x-show="!isExpanded"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="flex justify-between items-center py-4 px-6 rounded-full bg-[#0F131D] w-full">
        <div class="flex space-x-4 items-center">
            <img src="{{ $imagePath }}" alt="{{ $name }}" class="w-12 h-12 rounded-full">
            <div class="">
                <h2 class="text-lg font-medium">{{ $name }}</h2>
                <p class="text-md text-[#797B80]">{{ $date }}</p>
            </div>
        </div>
        <p class="text-lg font-semibold">{{ $age }}y</p>
    </div>

    <div x-show="isExpanded"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="bg-[#0F131D] rounded-[50px] w-full space-y-4 flex flex-col items-center justify-center h-full relative">
        <img src="{{ $imagePath }}" alt="{{ $name }}" class="w-18 h-18 rounded-full">
        <div class="text-center">
            <h2 class="text-2xl font-semibold tracking-[1px]">{{ $name }}</h2>
            <p class="text-md text-[#797B80] font-medium">{{ $date }}</p>
        </div>
        <p class="text-lg font-semibold tracking-[0.8px]">{{ $age }} years old</p>
    </div>
</div>
