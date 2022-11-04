<x-app-layout>
  @section('title', 'Visitors')

  <div class="flex justify-between mt-12 pl-3 pr-6">
    <div class="w-6/12">
      <x-search-bar criteria="visitors"/>
    </div>
    <div class="w-2/12">
      <a href="{{route('visitors.add')}}" class="bg-red-400 text-center self-center text-white rounded-lg py-2 hover:bg-red-500"><i class="fa fa-plus"></i>&nbsp; Add Visitor</a>
    </div>
  </div>
  <div class="flex mt-10 pl-5 pr-10">
    @php
        $headings = ['Fullname', 'Phone Number', 'Occupation', 'Days Attended', 'Baptized'];
    @endphp
    <x-table :headings="$headings"/> 
  </div>
  <div class="flex justify-center mt-10 pl-5 pr-10">
    {{$members->links()}}
  </div>
</x-app-layout>
