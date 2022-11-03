<x-app-layout>
    @section('title', 'Dashboard')

    <div class="flex justify-between mt-12 pl-3 pr-6">
        <span class="text-lg text-gray-700 font pt-2">Zones</span>
        <button class="bg-red-400 text-white rounded-lg w-2/12 py-1 hover:bg-red-500"><i class="fa fa-plus"></i>&nbsp; Add Zone</button>
    </div>
    <div class="grid grid-cols-3 gap-6 mt-10 pl-5 pr-10">
        @for ($i = 1; $i < 7; $i++)
            <x-zone-tab-option name="{{'Zone '.$i}}" catchment="6" members="20" leader="Donald Trump"/>
        @endfor
    </div>
</x-app-layout>
