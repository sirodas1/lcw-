<x-app-layout>
  @section('title', 'Edit Report')
  @section('back-check', true)
  @section('page-back', route('reports.home'))

  <div class="bg-gray-50 border border-red-300 rounded-lg shadow-md mt-12 ml-5 mr-5 lg:mr-20 mb-10">
    <div class="flex justify-center mt-12 px-6">
      <span class="text-red-600 text-lg">Edit Report</span>
    </div>
    @if(session()->has('error_message'))
      <div class="flex justify-center mt-12 px-6">
        <span class="text-red-900 text-lg">[[ERROR]] ::: {{session()->get('error_message')}}</span>
      </div>
    @endif
    @if(count($errors) > 0)
      <div class="flex justify-center mt-12 px-6">
        <span class="text-red-900 text-lg">[[ERROR]] ::: {{$errors}}</span>
      </div>
    @endif
    <form action="{{route('reports.update', [$report])}}" method="post">
      @csrf
      <div class="flex flex-wrap lg:flex-nowrap justify-center gap-6 mt-8 px-6 mb-5">
        <div class="basis-full lg:basis-1/2">
          <div class="flex lg:justify-center gap-4">
            <span class="text-lg text-red-400 font-semibold">Sunday Date : {{$report->sunday_date}}</span>
          </div>
        </div>
        <div class="basis-full lg:basis-1/2">
          <div class="flex lg:justify-center gap-4">
            <x-input-label for="arrival_time" class=" pt-2 text-base">Enter Arrival Time * : </x-input-label>
            <x-text-input class="w-2/5 lg:w-1/2" name="arrival_time" type="time" value="{{$report->arrival_time}}" required/>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="number_of_new_souls" class="my-2">Number of New Souls Brought * :</x-input-label>
          <x-text-input name="number_of_new_souls" type="number" value="{{$report->number_of_new_souls}}" min="0" step="1" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="means_of_transport" class="my-2">Means of Transport * :</x-input-label>
          <x-text-input name="means_of_transport" type="text" value="{{$report->means_of_transport}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="number_of_vehicles_brought" class="my-2">Number of Vehicles Brought * :</x-input-label>
          <x-text-input name="number_of_vehicles_brought" type="number" value="{{$report->number_of_vehicles_brought}}" min="1" step="1" required/>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-6 px-3 lg:px-6 mb-5 mt-10">
        <div class="flex justify-start">
          <div class="basis-full lg:px-5">
            <div class="flex justify-center my-3">
              <span class="text-base block font-medium text-red-400">Check Attendance for Members</span>
            </div>
            @php
              $headings = ['', 'Member Name', 'Note'];
            @endphp
            <x-table :headings="$headings">
              @foreach ($report->members_attendance as $member)
                @if ($loop->odd)
                  <tr class="group bg-white border-b border-red-300 hover:bg-gray-50">
                @else
                  <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100">
                @endif
                  <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                    @if($member->pivot->attendance) 
                      <x-check-box name="attendance[members][{{$member->id}}][status]" value="true" onchange="toggleTextArea('reason_{{$member->id}}');" checked/>
                    @else
                      <x-check-box name="attendance[members][{{$member->id}}][status]" value="true" onchange="toggleTextArea('reason_{{$member->id}}');" />
                    @endif
                  </th>
                  <td class="py-4 px-6">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</td>
                  <td class="py-2 px-4">
                    @if($member->pivot->attendance) 
                      <x-text-area id="reason_{{$member->id}}" name="attendance[members][{{$member->id}}][reason]" rows="1" :disabled="true"></x-text-area>
                    @else
                      <x-text-area id="reason_{{$member->id}}" name="attendance[members][{{$member->id}}][reason]" rows="1">{{$member->pivot->reason}}</x-text-area>
                    @endif
                  </td>
                </tr>  
              @endforeach
            </x-table> 
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-6 px-3 lg:px-6 mb-5 mt-10">
        <div class="flex flex-wrap lg:flex-nowrap justify-start">
          <div class="basis-full lg:basis-1/2 lg:px-5">
            <div class="flex justify-center my-3">
              <span class="text-base block font-medium text-red-400">Check Attendance for First Timers</span>
            </div>
            @php
              $headings = ['', 'First Timer Name'];
              $catchments = auth()->user()->zone->catchments->load('visitors');
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
                      @if ($report->visitors_attendance->contains($visitor)) 
                        <x-check-box name="attendance[visitors][]" value="{{$visitor->id}}" checked/>
                      @else
                        <x-check-box name="attendance[visitors][]" value="{{$visitor->id}}"/>
                      @endif
                    </th>
                    <td class="py-4 px-6">{{$visitor->firstname.' '.$visitor->lastname.' '.$visitor->othername}}</td>
                  </tr>  
                @endforeach
              @endforeach
            </x-table> 
          </div>
          <div class="basis-full lg:basis-1/2 lg:px-5">
            <div class="flex justify-start flex-col">
              <x-input-label for="recommendations" class="my-2">Recommend Solutions for Absentees :</x-input-label>
              <x-text-area name="recommendations" rows="5">{{$report->recommendations}}</x-text-area>
            </div>
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-6 px-6 my-10">
        <div class="w-5/12">
          <x-primary-button>Update Report</x-primary-button>
        </div>
      </div>
    </form>
  </div>
  @push('scripts')
    <script>
      function toggleTextArea(elementID) {
        var tarea = document.getElementById(elementID);
        tarea.toggleAttribute("disabled");
        tarea.classList.toggle("border-red-300");
        tarea.classList.toggle("bg-gray-200");
      }
    </script>
  @endpush
</x-app-layout>
