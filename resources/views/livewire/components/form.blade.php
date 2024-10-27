<div x-data="{ isOpen: @entangle('isOpen') }">
    <button @click="isOpen = true" class="cursor-pointer">
        <div class="flex items-center justify-center p-2 rounded-full bg-[#DDFB24] ">
            <svg class="vuesax-outline-add2" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5 13.8125H6.5C6.05583 13.8125 5.6875 13.4442 5.6875 13C5.6875 12.5558 6.05583 12.1875 6.5 12.1875H19.5C19.9442 12.1875 20.3125 12.5558 20.3125 13C20.3125 13.4442 19.9442 13.8125 19.5 13.8125Z" fill="#161618" />
                <path d="M13 20.3125C12.5558 20.3125 12.1875 19.9442 12.1875 19.5V6.5C12.1875 6.05583 12.5558 5.6875 13 5.6875C13.4442 5.6875 13.8125 6.05583 13.8125 6.5V19.5C13.8125 19.9442 13.4442 20.3125 13 20.3125Z" fill="#161618" />
            </svg>
        </div>
    </button>
    

    <div x-show="isOpen" 
         class="fixed inset-0 flex items-center justify-center z-50"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-[#0F131D] bg-opacity-85"></div>
        
        <div class="bg-[#0A0E17] rounded-[20px] max-w-sm w-full space-y-4 relative py-8 px-8 z-10">
            <div class="space-y-1">
                <h2 class="text-xl font-medium tracking-[0.7px]">New birth date</h2>
               
            </div>
            <div class="space-y-4">
                <div class="space-y-1">
                    <label for="name" class="text-sm">Name</label>
                    <input type="text" id="name" wire:model="name" autocomplete="off" class="w-full rounded-lg bg-transparent p-3 border border-solid border-[#1F242F] text-sm">
                </div>
                <div>
                    <div x-data="dateInput()" class="space-y-1">
                        <label for="birth-date" class="text-sm">Date de naissance</label>
                        <input 
                            type="text" 
                            id="birth-date" 
                            x-model="inputDate" 
                            x-on:input="validateInput"
                            x-on:blur="formatDate"
                            wire:model="birthDate"
                            placeholder="jj-mm-aaaa"
                            class="w-full rounded-lg bg-transparent p-3 border border-solid border-[#1F242F] text-sm"
                            maxlength="10" 
                            autocomplete="off"
                        >
                    </div>
                    <script>
                    function dateInput() {
                        return {
                            inputDate: '',
                            formattedDate: '',
                            errorMessage: '',
                            validateInput(e) {
                                this.inputDate = this.inputDate.replace(/[^\d-]/g, '');
                                if (this.inputDate.length === 2 || this.inputDate.length === 5) {
                                    this.inputDate += '-';
                                }
                                if (this.inputDate.length === 10) {
                                    this.formatDate();
                                } else {
                                    this.formattedDate = '';
                                    this.errorMessage = '';
                                }
                            },
                            formatDate() {
                                const parts = this.inputDate.split('-');
                                if (parts.length === 3) {
                                    const [day, month, year] = parts.map(Number);
                                    const date = new Date(year, month - 1, day);
                                    if (date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day) {
                                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                                        this.formattedDate = date.toLocaleDateString('fr-FR', options);
                                        this.errorMessage = '';
                                    } else {
                                        this.formattedDate = '';
                                        this.errorMessage = 'Date invalide';
                                    }
                                } else {
                                    this.formattedDate = '';
                                    this.errorMessage = 'Format invalide (jj-mm-aaaa)';
                                }
                            }
                        };
                    }
                    </script>
                </div>
                
                <div class="space-y-2">
                    <p class="text-sm">Choose an avatar</p>
                    <div class="flex flex-wrap gap-2 justify-center">
                        @for ($i = 1; $i <= 31; $i++)
                            <img src="/{{ $i }}.svg" alt="{{ $i }}" id="{{ $i }}" wire:click="$set('avatarId', {{ $i }})" class="w-8 h-8 rounded-full cursor-pointer {{ $avatarId == $i ? 'border-2 border-blue-500' : '' }}">
                        @endfor
                    </div>
                </div>
            </div>
            <div class="pt-6">
                <button wire:click="addPerson" class="py-[10px] w-full text-center bg-[#DDFB24] text-[#0F131D] rounded-md text-sm font-semibold">Add</button>
            </div>
            <button @click="isOpen = false" class="absolute top-8 right-8 cursor-pointer">
                <svg class="close" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 3.00338e-06L14 14M2.6974e-05 14L7.00003 7L14 0" stroke="#EEEEEE" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>
</div>
