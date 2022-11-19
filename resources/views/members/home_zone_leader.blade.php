<x-app-layout>
  @section('title', 'Members')

@if (session()->has('new_member'))
  <div id="new_member_added" class="flex justify-between my-6 mr-5 px-2 py-1 border border-green-500 rounded">
    <span class="text-base font-semibold text-green-500">{{session()->get('new_member')}}</span>
    <i class="fa fa-close text-gray-600 hover:text-red-600 hover:cursor-pointer pt-1" onclick="document.getElementById('new_member_added').remove();"></i>
  </div>  
@endif

  <div class="flex justify-end mt-12 pl-3 pr-6">  
    <form id="importForm" action="{{route('members.import')}}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="file" id="import_file" name="import_file" onchange="document.getElementById('importForm').submit();" hidden>
    </form>
  </div>
  <div class="flex mt-10 pl-5 pr-10">
    @php
      $headings = ['Fullname', 'Phone Number', 'Occupation', 'Zone', 'Baptized'];
    @endphp
    <x-table :headings="$headings">
      @foreach ($catchments as $catchment)
        @foreach ($catchment->members as $member)
          @if ($loop->odd)
            <tr class="group bg-white border-b border-red-300 hover:bg-gray-50 hover:cursor-pointer" onclick="window.location.href='{{route('members.edit', [$member])}}';">
          @else
            <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100 hover:cursor-pointer" onclick="window.location.href='{{route('members.edit', [$member])}}';">
          @endif
            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</th>
            <td class="py-4 px-6">{{$member->phone_number}}</td>
            <td class="py-4 px-6">{{$member->occupation}}</td>
            <td class="py-4 px-6">{{$member->catchment->zone->name ?? 'No Zone Assigned'}}</td>
            <td class="py-4 px-6">{{$member->baptized ? 'Yes' : 'No'}}</td>
          </tr>
        @endforeach
      @endforeach
    </x-table> 
  </div>
</x-app-layout>
