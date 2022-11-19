<x-app-layout>
  @section('title', 'View Reports')
  @section('back-check', true)
  @section('page-back', route('reports.home'))

  <div class="bg-gray-50 border border-red-300 rounded-lg shadow-md mt-12 ml-5 mr-20 mb-10">
    <div class="flex justify-center mt-12 px-6">
      <span class="text-red-600 text-lg">Add New Sunday Report</span>
    </div>
    @if(session()->has('error_message'))
      <div class="flex justify-center mt-12 px-6">
        <span class="text-red-900 text-lg">[[ERROR]] ::: {{session()->get('error_message')}}</span>
      </div>
    @endif
    <div class="flex justify-center gap-6 mt-8 px-6 mb-5">
      <div class="basis-1/2">
        <div class="flex justify-center gap-4">
          <span class="text-gray-500">Sunday Date :</span>
          <span class="text-base text-red-400 font-semibold">{{$report->sunday_date}}</span>
        </div>
      </div>
      <div class="basis-1/2">
        <div class="flex justify-center gap-4">
          <span class="text-gray-500">Arrival Time :</span>
          <span class="text-base text-red-400 font-semibold">{{$report->arrival_time}}</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-6 px-6 mb-5">
      <div>
        <div class="flex justify-center">
          <span class="text-gray-500">Number of New Souls Brought :</span>
        </div>
        <div class="flex justify-center">
          <span class="text-base text-red-400 font-semibold">{{$report->number_of_new_souls}}</span>
        </div>
      </div>
      <div>
        <div class="flex justify-center">
          <span class="text-base text-gray-500">Means of Transport :</span>
        </div>
        <div class="flex justify-center">
          <span class="text-base text-red-400 font-semibold">{{$report->means_of_transport}}</span>
        </div>
      </div>
      <div>
        <div class="flex justify-center">
          <span class="text-base text-gray-500">Number of Vehicles Brought :</span>
        </div>
        <div class="flex justify-center">
          <span class="text-base text-red-400 font-semibold">{{$report->number_of_vehicles_brought}}</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-6 px-6 mb-5 mt-10">
      <div class="flex justify-start">
        <div class="basis-full px-5">
          <div class="flex justify-center my-3">
            <span class="text-base block font-medium text-gray-500">Attendance for Members</span>
          </div>
          @php
            $headings = ['Member Name', 'Attended', 'Report'];
          @endphp
          <x-table :headings="$headings">
            @foreach ($report->members_attendance as $member)
              @if ($loop->odd)
                <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
              @else
                <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
              @endif
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                  {{$member->firstname.' '.$member->lastname.' '.$member->othername}}
                </th>
                <td class="py-4 px-6">
                  @if ($member->pivot->attendance) PRESENT @else  ABSENT @endif
                </td>
                <td class="py-4 px-6">
                  @isset($member->pivot->reason){{$member->pivot->reason}}@endisset
                </td>
              </tr>  
            @endforeach
          </x-table> 
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-6 px-6 mb-5 mt-10">
      <div class="flex justify-start">
        <div class="basis-1/2 px-5">
          <div class="flex justify-center my-3">
            <span class="text-base block font-medium text-gray-500">Check Attendance for Visitors</span>
          </div>
          @php
            $headings = ['Visitor Name', 'Attended'];
            $catchments = $report->zone_leader->zone->catchments->load('visitors');
          @endphp
          <x-table :headings="$headings">
            @foreach ($catchments as $catchment)
              @foreach ($catchment->visitors as $visitor)
                @if ($loop->odd)
                  <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
                @else
                  <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
                @endif
                  <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                    {{$visitor->firstname.' '.$visitor->lastname.' '.$visitor->othername}}
                  </th>
                  <td class="py-4 px-6">
                    @if ($report->visitors_attendance->contains($visitor)) PRESENT @else  ABSENT @endif
                  </td>
                </tr>  
              @endforeach
            @endforeach
          </x-table> 
        </div>
        <div class="basis-1/2 px-5">
          <div class="flex justify-start flex-col">
            <span class="text-sm text-gray-500 block my-3">Recommended Solutions :</span>
            <span class="text-lg text-red-400 font-semibold text-wrap w-full">{{$report->recommendations}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-6 px-6 mb-5"></div>
    <div class="flex justify-center gap-6 px-6 my-10">
      <a href="{{route('reports.reviewed', [$report])}}" class="bg-blue-600 rounded-lg text-gray-100 hover:bg-blue-500 py-2 self-center items-center text-center w-5/12">Reviewed</a>
    </div>
  </div>
</x-app-layout>
