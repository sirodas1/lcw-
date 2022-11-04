<x-app-layout>
  @section('title', 'Members')

  <div class="flex justify-between mt-12 pl-3 pr-6">
    <div class="w-6/12">
      <x-search-bar criteria="members"/>
    </div>
    <div class="grid grid-cols-2 w-4/12 gap-4">
      <button class="bg-red-400 text-white rounded-lg py-1 hover:bg-red-500"><i class="fa fa-upload"></i>&nbsp; Import Members</button>
      <a href="{{route('members.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 hover:bg-red-500"><i class="fa fa-plus"></i>&nbsp; Add Member</a>
    </div>
  </div>
  <div class="flex mt-10 pl-5 pr-10">
    @php
      $headings = ['Fullname', 'Phone Number', 'Occupation', 'Zone', 'Baptized'];
    @endphp
    <x-table :headings="$headings">
      @foreach ($members as $member)
        @if ($loop->odd)
          <tr class="group bg-white border-b border-red-300 hover:bg-red-200 hover:text-white hover:cursor-pointer">
        @else
          <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-200 hover:text-white hover:cursor-pointer">
        @endif
          <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap group-hover:text-white">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</th>
          <td class="py-4 px-6">{{$member->phone_number}}</td>
          <td class="py-4 px-6">{{$member->occupation}}</td>
          <td class="py-4 px-6">{{$member->catchment->zone->name ?? 'No Zone Assigned'}}</td>
          <td class="py-4 px-6">{{$member->baptized ? 'Yes' : 'No'}}</td>
        </tr>
      @endforeach
    </x-table> 
  </div>
  <div class="flex justify-center mt-10 pl-5 pr-10">
    {{$members->links()}}
  </div>
</x-app-layout>
