<x-app-layout>
  @section('title', 'Visitors')

<div class="flex justify-between w-full mt-12 pl-3 pr-6">
  <div class="w-6/12">
    <x-search-bar criteria="visitors"/>
  </div>
  <div class="w-2/12 flex pt-1">
    <a href="{{route('visitors.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 hover:bg-red-500 px-3"><i class="fa fa-plus"></i>&nbsp; Add Visitor</a>
  </div>
</div>
<div class="flex mt-10 pl-5 pr-10">
  @php
      $headings = ['Fullname', 'Phone Number', 'Occupation', 'Days Attended', 'Zone', 'Baptized', 'Edit'];
  @endphp
  <x-table :headings="$headings">
    @foreach ($visitors as $visitor)
      @if ($loop->odd)
        <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
      @else
        <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
      @endif
        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{$visitor->firstname.' '.$visitor->lastname.' '.$visitor->othername}}</th>
        <td class="py-4 px-6">{{$visitor->phone_number}}</td>
        <td class="py-4 px-6">{{$visitor->occupation}}</td>
        <td class="py-4 px-6">
          {{$visitor->attendance}} &emsp; 
          <a id="{{'visitor_'.$visitor->id}}" href="#" data-attendance="{{$visitor->attendance}}" data-route="{{route('visitors.log.attendance', [$visitor])}}" data-route-add-member="{{route('visitors.log.attendance.add.member', [$visitor])}}" class="bg-red-300 text-white rounded p-1 self-center justify-center hover:bg-red-500" onclick="addAttendance(this.id);"><i class="fa fa-plus"></i></a>
        </td>
        <td class="py-4 px-6">{{$visitor->catchment->zone->name ?? 'No Zone Assigned'}}</td>
        <td class="py-4 px-6">{{$visitor->baptized ? 'Yes' : 'No'}}</td>
        <td class="text-center"><i class="fa fa-edit hover:text-red-500 hover:cursor-pointer" onclick="window.location.href='{{route('visitors.edit', [$visitor])}}';"></i></td>
      </tr>
    @endforeach
  </x-table>  
</div>
<div class="flex justify-center mt-10 pl-5 pr-10">
  {{$visitors->links()}}
</div>

@push('scripts')
  <script>
    function addAttendance(id) {
      var button = document.getElementById(id);
      var attendance = button.dataset.attendance;
      var link = button.dataset.route;
      var link_addMember = button.dataset.routeAddMember;
      // console.log(attendance);
      if(attendance >= 4)
        if(confirm('Do you wish to add this visitor as a church member?'))
          window.location.href = link_addMember;
        else
          window.location.href = link;
      else
        window.location.href = link;
    }
  </script>
@endpush
</x-app-layout>
