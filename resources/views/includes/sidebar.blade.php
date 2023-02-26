<div class="invisible lg:visible h-screen w-72 fixed z-40 top-0 left-0 bg-white overflow-x-hidden pt-4 md:pt-5">
    <div class="flex justify-center mt-2">
        <img src="{{asset('img/logo.png')}}" class="self-center h-auto w-48">
    </div>
    <div class="flex flex-col justify-center rounded mx-5 my-5">
        @php
            $type = (auth()->user()->user_type == 'Admin')? auth()->user()->user_type : "Zonal Head";
        @endphp
        <span class="text-red-500 text font-semibold text-center">{{strtoUpper($type)}}</span>
        <span class="text-gray-600 text-sm text-center">{{auth()->user()->name}}</span>
    </div>
    <div class="flex justify-center mt-10">
        <div class="basis-9/12">
            <button class="bg-red-400 rounded-lg text-gray-50 hover:bg-red-600 hover:text-light py-2 px-2 w-full" onclick="window.location.href = '{{route('dashboard.home')}}';">
                <img src="{{asset('img/menu.png')}}" class="self-center inline w-6 h-auto" width="12%">&emsp; 
                <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="mt-8 flex justify-center">
        <div class="basis-10/12">
            <div class="flex flex-col">
                @if (auth()->user()->user_type == 'Admin')
                    <a href="{{route('leaders.home')}}" class="mt-3 text-gray-800 hover:text-red-400">
                        <span class="text-red-400"><i class="fa fa-street-view"></i></span>&emsp;&nbsp;
                        Zonal Heads 
                        <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                    </a>
                @endif
                <a href="{{route('members.home')}}" class="mt-3 text-gray-800 hover:text-red-400">
                    <span class="text-red-400"><i class="fa fa-user-group"></i></span>&emsp; 
                    Members 
                    <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                </a>
                @if (auth()->user()->user_type == 'Admin')
                    <a href="{{route('visitors.home')}}" class="mt-3 text-gray-800 hover:text-red-400">
                        <span class="text-red-400"><i class="fa fa-user-plus"></i></span>&emsp; 
                        First Timers 
                        <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                    </a>
                @endif
                <a href="{{route('ztp.home')}}" class="mt-3 text-gray-800 hover:text-red-400">
                    <span class="text-red-400"><i class="fa fa-upload"></i></span>&emsp;&nbsp;
                    ZTP 
                    <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                </a>
                {{-- @if (auth()->user()->user_type == 'Admin')
                    <a href="#" class="mt-3 text-gray-800 hover:text-red-400">
                        <span class="text-red-400"><i class="fa fa-calendar-days"></i></span>&emsp; 
                        Programs 
                        <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                    </a>
                @endif --}}
                <a href="{{route('reports.home')}}" class="mt-3 text-gray-800 hover:text-red-400">
                    <span class="text-red-400"><i class="fa fa-file-invoice"></i></span>&emsp;&nbsp;&nbsp;
                    Reports 
                    <span class="float-right"><i class="fa fa-chevron-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Mobile Navbar --}}
<nav class="lg:hidden col-span-12 bg-white">
    <div class="flex justify-between pl-2">
        <div class="px-0 py-1">
            <img src="{{asset('img/logo.png')}}" class="self-center h-auto w-36">
        </div>
        <div class="w-20 flex justify-center align-middle py-4 group hover:bg-red-400 cursor-pointer" onclick="document.getElementById('mobile_menu').classList.toggle('hidden');">
            <span class="text-red-400 group-hover:text-white"><i class="fa fa-bars fa-2x"></i></span>
        </div>
    </div>
</nav>

<div id="mobile_menu" class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 transition ease-in duration-150 bg-white">
    <div class="flex justify-end my-5 md:my-10 px-6 md:px-14">
        <button type="button" class="text-gray-700 text-2xl hover:text-red-400" onclick="document.getElementById('mobile_menu').classList.toggle('hidden');"><i class="fa fa-times"></i></button>
    </div>
    <div class="flex justify-center my-10">
        <a href="{{route('dashboard.home')}}" class="text-2xl text-gray-700 hover:text-red-400">Dashboard</a>
    </div>
    @if (auth()->user()->user_type == 'Admin')
        <div class="flex justify-center my-10">
            <a href="{{route('leaders.home')}}" class="text-2xl text-gray-700 hover:text-red-400">Zonal Heads</a>
        </div>
    @endif
    <div class="flex justify-center my-10">
        <a href="{{route('members.home')}}" class="text-2xl text-gray-700 hover:text-red-400">Members</a>
    </div>
    @if (auth()->user()->user_type == 'Admin')
        <div class="flex justify-center my-10">
            <a href="{{route('visitors.home')}}" class="text-2xl text-gray-700 hover:text-red-400">First Timers</a>
        </div>
    @endif
    <div class="flex justify-center my-10">
        <a href="{{route('ztp.home')}}" class="text-2xl text-gray-700 hover:text-red-400">ZTP</a>
    </div>
    <div class="flex justify-center my-10">
        <a href="{{route('reports.home')}}" class="text-2xl text-gray-700 hover:text-red-400">Reports</a>
    </div>
    <div class="flex justify-center my-12">
        <a href="#" class="text-2xl text-red-600 hover:text-red-500"onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>&nbsp;Logout
        </a>
    </div>
</div>