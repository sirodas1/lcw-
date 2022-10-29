<x-guest-layout>
    <x-auth-card>
        <div class="flex justify-center mb-0">
            <span class="font-bold text-gray-800" style="font-size:10px;"><strong>LOVE CENTER WORLWIDE</strong></span>
        </div>
        <div class="flex justify-center mt-0">
            <span class="text-xl font-extrabold text-black"><strong>USER LOGIN</strong></span>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-5 px-8">
                <div class="flex flex-row group bg-red-400 hover:bg-red-600 focus:bg-red-600 rounded-l-full rounded-r-full px-8 py-2" style="">
                    <div class="basis-1/12 mt-2">
                      <img src="/img/id-card@2x.png" class="self-center w-full h-auto">
                    </div>
                    <div class="basis-11/12 ml-2 px-0">
                      <input id="username" type="text" class="bg-red-400  group-hover:bg-red-600 text-white outline-none border-none w-full placeholder:text-white placeholder:font-bold placeholder:text-lg focus:outline-none focus:border-none" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                    </div>
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-6 px-8">
                <div class="flex flex-row group bg-red-400 hover:bg-red-600 focus:bg-red-600 rounded-l-full rounded-r-full px-8 py-2">
                    <div class="basis-1/12 mt-2">
                        <img src="/img/padlock@2x.png" class="self-center w-9/12 h-auto">
                    </div>
                    <div class="basis-11/12 ml-2 px-0">
                        <input id="password" type="password" class="bg-red-400  group-hover:bg-red-600 text-white outline-none border-none w-full placeholder:text-white placeholder:font-bold placeholder:text-lg focus:outline-none focus:border-none" name="password" required autocomplete="current-password" placeholder="Password">
                    </div>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
