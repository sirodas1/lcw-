<x-app-layout>
    @section('title', 'Dashboard')

    @if(isset($new_reports) && $new_reports->isNotEmpty())
        <div class="flex justify-start mt-12 pl-3 pr-6">
            <span class="text-lg text-gray-700 font pt-2">Notifications</span>
        </div>
        @foreach ($new_reports as $report)
            <div id="new_member_added" class="flex justify-between my-6 mr-20 ml-5 px-2 py-1 border border-green-500 rounded">
                <span class="text-sm text-green-500">{{$report->zone_leader->name.' Report for '.$report->zone_leader->zone->name.' Ready'}}</span>
                <a class="mt-1 text-xs text-red-400 hover:text-green-400 hover:cursor-pointer" href="{{route('reports.view', [$report])}}">View Report</a>
            </div>
        @endforeach
    @endif

    <div class="flex justify-start mt-12 pl-3 pr-6">
        <span class="text-lg text-gray-700 font pt-2">Members Statistics</span>
    </div>
    <div class="flex overflow-auto lg:grid lg:grid-cols-5 gap-6 mt-10 pl-5 pr-5 lg:pr-10">
        @foreach ($statistics as $statistic)
            @if(array_key_exists('link', $statistic))
                <x-statistic-tab-option name="{{$statistic['name']}}"  number="{{$statistic['number']}}" onclick="window.location.href='{{$statistic['link']}}';"/>
            @else
            <x-statistic-tab-option name="{{$statistic['name']}}"  number="{{$statistic['number']}}"/>
            @endif
        @endforeach
    </div>
    <div class="flex justify-between mt-12 pl-3 pr-6">
        <span class="text-lg text-gray-700 font pt-2">Zones</span>
        <button class="bg-red-400 text-white rounded-lg px-3 lg:w-2/12 py-1 hover:bg-red-500"  data-modal-toggle="addZone"><i class="fa fa-plus"></i>&nbsp; Add Zone</button>
    </div>
    <div class="flex flex-wrap lg:grid lg:grid-cols-3 gap-6 mt-10 pl-5 pr-5 lg:pr-10">
        @foreach ($zones as $zone)
            <x-zone-tab-option name="{{$zone->name}}" catchment="{{count($zone->catchments)}}" members="{{$zone->catchments->loadCount('members')->sum('members_count')}}" leader="{{$zone->leader->name ?? 'Unassigned'}}" onclick="window.location.href='{{route('dashboard.zone.view', ['zone' => $zone ])}}';"/>
        @endforeach
    </div>
    <div class="grid grid-cols-2 gap-8 my-8 pl-3 pr-3">
        <div class="col-span-2 lg:col-span-1">
            <div class="flex justify-start mb-8">
                <span class="text-lg text-gray-700 pt-2">Statistics & Attendance</span>
            </div>
            <div class="flex">
                @php
                    $headings = ['Title', 'Count'];
                @endphp
                <x-table :headings="$headings">
                    @foreach ($attendance as $group => $number)
                        @if ($loop->odd)
                            <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
                        @else
                            <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
                        @endif
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{$group}}</th>
                            <td class="py-4 px-6 text-center">{{$number}}</td>
                        </tr>  
                    @endforeach
                </x-table> 
            </div>
        </div>
    </div>
    @push('modals')
        <!-- Add Zone modal -->
        <div id="addZone" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t">
                        <h3 class="text-xl font-semibold text-red-700 ">
                            Add Zone
                        </h3>
                        <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="addZone">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form action="{{route('dashboard.zone.add')}}" method="post">
                            @csrf
                            <div class="flex justify-center mb-8">
                                <div class="basis-10/12">
                                    <x-text-input name="name" type="text" required/>
                                </div>
                            </div>
                            <div class="flex justify-center mb-4">
                                <div class="basis-8/12">
                                    <x-primary-button type="submit">Save</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
</x-app-layout>
