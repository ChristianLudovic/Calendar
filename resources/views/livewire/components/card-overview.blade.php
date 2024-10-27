<div>
    @if($isOpen)
        <div class="bg-[#0F131D] rounded-[50px] w-full space-y-4 flex flex-col items-center justify-center h-[410px] relative">
            <button wire:click="closeCard">
                <svg class="close absolute top-8 right-8 cursor-pointer" width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 3.00338e-06L14 14M2.6974e-05 14L7.00003 7L14 0" stroke="#EEEEEE" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
            <img src="/1.svg" alt="1" class="w-18 h-18 rounded-full">
            <div class="text-center">
                <h2 class="text-2xl font-semibold tracking-[1px]">Samuelle Maeva</h2>
                <p class="text-md text-[#797B80] font-medium">October 14</p>
            </div>
            <p class="text-lg font-semibold tracking-[0.8px]">22 years old</p>
        
        </div>
    @endif
</div>

