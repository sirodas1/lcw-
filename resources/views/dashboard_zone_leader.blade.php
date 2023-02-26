<x-app-layout>
    @section('title', 'Dashboard')

    @if (session()->has('new_member'))
        <div id="new_member_added" class="flex justify-between my-6 mr-5 px-2 py-1 border border-green-500 rounded">
            <span class="text-base font-semibold text-green-500">{{session()->get('new_member')}}</span>
            <i class="fa fa-close text-gray-600 hover:text-red-600 hover:cursor-pointer pt-1" onclick="document.getElementById('new_member_added').remove();"></i>
        </div>  
    @endif

    @if($report_ready)
    <div id="new_member_added" class="flex justify-between my-6 mx-16 px-2 py-1 border border-green-500 rounded">
        <span class="text-sm text-green-500">Please click link to send todays report</span>
        <a class="mt-1 text-xs text-red-400 hover:text-green-400 hover:cursor-pointer" href="{{route('reports.add')}}">Send Report</a>
    </div>
    @endif

    <div class="flex flex-wrap lg:grid lg:grid-cols-3 gap-6 mt-10 pl-5  pr-5 lg:pr-10">
        <x-zone-tab-option name="{{$zone->name}}" catchment="{{count($zone->catchments)}}" members="{{$zone->catchments->loadCount('members')->sum('members_count')}}" leader="{{$zone->leader->name ?? 'Unassigned'}}" onclick="window.location.href='{{route('dashboard.zone.view', ['zone' => $zone ])}}';"/>
    </div>
    <div class="flex justify-start mt-10 pl-5 pr-10">
        <span class="text-lg text-gray-600 font-semibold ">Statistics</span>
    </div>
    <div class="flex overflow-auto lg:grid lg:grid-cols-5 gap-6 mt-10 pl-5 pr-5 lg:pr-10">
        @foreach ($statistics as $statistic)
            <x-statistic-tab-option name="{{$statistic['name']}}"  number="{{$statistic['number']}}"/>
        @endforeach
    </div>
</x-app-layout>
