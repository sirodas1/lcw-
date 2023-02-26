<x-app-layout>
  @section('title', 'Reports')

  {{-- <div class="flex justify-end mt-12 pl-3 pr-6">
    <div class="w-2/12 flex pt-1">
      <a href="{{route('reports.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 hover:bg-red-500 px-3"><i class="fa fa-plus"></i>&nbsp; Add Report</a>
    </div>
  </div> --}}
  <div class="flex mt-10 pl-5 pr-5 lg:pr-10">
    @php
      $headings = ['Date', 'Zone', 'Status', ''];
    @endphp
    <x-table :headings="$headings">
      @foreach ($reports as $report)
        @if ($loop->odd)
          <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
        @else
          <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
        @endif
          <th scope="1" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{date("l d F Y",strtotime($report->sunday_date))}}</th>
          <td scope="2" class="py-4 px-6">{{$report->zone_leader->zone->name}}</td>
          <td scope="2" class="py-4 px-6 {{$report->status ? 'text-green-400' : 'text-red-400'}}">{{$report->status ? 'REVIEWED' : 'PENDING'}}</td>
          <td class="text-center">
            <a href="{{route('reports.view', [$report])}}" class="text-gray-500 hover:text-green-400"><i class="fa fa-search"></i></a>
          </td>
        </tr>  
      @endforeach
    </x-table> 
  </div>
</x-app-layout>
