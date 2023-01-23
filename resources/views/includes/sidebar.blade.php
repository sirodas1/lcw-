<div class="h-screen w-72 fixed z-40 top-0 left-0 bg-white overflow-x-hidden pt-4 md:pt-5">
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