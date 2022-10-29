<div class="h-screen w-80 fixed z-50 top-0 left-0 bg-white overflow-x-hidden pt-4 md:pt-5">
    <div class="flex justify-center mt-2">
        <img src="{{asset('img/LCW.png')}}" class="self-center h-auto w-50">
    </div>
    <div class="flex justify-center mt-3">
        <div class="basis-9/12">
            <button class="bg-red-400 rounded-lg text-gray-200 hover:bg-red-600 hover:text-light py-2 px-2 w-full" style="border-radius: 12px" onclick="window.location.href = '{{route('home')}}';">
                <img src="{{asset('img/menu.png')}}" class="self-center w-9/12 h-auto" width="12%">&emsp; 
                <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="mt-3 flex justify-start">
        <div class="basis-10/12">
            <a href="#" class="mt-3 w-full">
                <span class="text-red-400"><i class="fa fa-user-tie"></i></span>&emsp; 
                Zones & Zone Head 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-red-400"><i class="fa fa-archive"></i></span>&emsp; 
                Medical Inventory 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-red-400"><i class="fa fa-user-injured"></i></span>&emsp; 
                Patients 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-red-400"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        </div>
    </div>
</div>