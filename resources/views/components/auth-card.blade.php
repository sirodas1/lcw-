<div class="h-screen flex justify-center md:justify-end pt-6 sm:pt-0 items-center">
    <div class="w-2/6 pr-20">
        <div class="w-full sm:max-w-md mt-6 px-6 py-20 bg-white shadow-2xl overflow-hidden rounded-3xl z-20 ">
            {{ $slot }}
        </div>
        <div class="w-full sm:max-w-md mt-0">
            <div class="flex justify-center">
                <button type="submit" form="loginForm" class="bg-red-400 hover:bg-red-600 text-white text-lg py-2 font-bold w-4/5 rounded-b-full">LOGIN</button>
            </div>
        </div>
    </div>
</div>
