<x-app-layout>
  @section('title', 'Members')

@if (session()->has('new_member'))
  <div id="new_member_added" class="flex justify-between my-6 mr-5 px-2 py-1 border border-green-500 rounded">
    <span class="text-base font-semibold text-green-500">{{session()->get('new_member')}}</span>
    <i class="fa fa-close text-gray-600 hover:text-red-600 hover:cursor-pointer pt-1" onclick="document.getElementById('new_member_added').remove();"></i>
  </div>  
@endif
@if (auth()->user()->user_type == 'Admin')
  <div class="flex justify-between mt-12 pl-3 pr-6">
    <div class="w-6/12">
      <x-search-bar criteria="members"/>
    </div>
    <div class="flex justify-end w-6/12 gap-4">
      <a href="{{asset('templates/Members_Template.xlsx')}}" download="template.xlsx" class="text-sm text-indigo-300 hover:text-red-400 mt-2">Download Excel Template</a>
      <a href="javascript: uploadSpreadSheet();" class="bg-red-400 text-center self-center text-white rounded-lg px-2 py-2 hover:bg-red-500"><i class="fa fa-upload"></i>&nbsp; Import</a>
      <a href="{{route('members.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 px-2 hover:bg-red-500"><i class="fa fa-plus"></i>&nbsp; Add Member</a>
    </div>
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
      @foreach ($members as $member)
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
    </x-table> 
  </div>
  <div class="flex justify-center mt-10 pl-5 pr-10">
    {{$members->links()}}
  </div> 
@else
  <div class="flex justify-end mt-12 pl-3 pr-6">
    <div class="flex justify-end w-6/12 gap-4">
      <a href="{{asset('templates/Members_Template.xlsx')}}" download="template.xlsx" class="text-sm text-indigo-300 hover:text-red-400 mt-2">Download Excel Template</a>
      <a href="javascript: uploadSpreadSheet();" class="bg-red-400 text-center self-center text-white rounded-lg px-2 py-2 hover:bg-red-500"><i class="fa fa-upload"></i>&nbsp; Import</a>
      <a href="{{route('members.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 px-2 hover:bg-red-500"><i class="fa fa-plus"></i>&nbsp; Add Member</a>
    </div>
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
@endif

  @push('scripts')
    <script>
      function uploadSpreadSheet() {
        document.getElementById('import_file').click();
      }
    </script>
  @endpush
</x-app-layout>
