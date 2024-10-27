<div 
    style="background-image: url('/login-card-bg.svg'); background-size: cover; background-position: center; background-repeat: no-repeat;"
    class="flex flex-col items-center max-w-sm rounded-[12px] text-center py-8 px-6 space-y-6"
>
    <div class="space-y-2" >
        <h1 class="text-2xl font-bold tracking-[0.7px]">Login</h1>
        <p class="leading-[130%] text-md">Please enter your credentials to access your account</p>
    </div>
    
    <button wire:click="redirectToProvider('google')" class=" text-sm py-3 w-full text-center bg-white text-[#0F131D] rounded-md text-sm font-semibold">Connexion with Google</button>
</div>
