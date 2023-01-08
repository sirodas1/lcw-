<x-app-layout>
  @section('title', $zone->name)
  @section('back-check', true)
  @section('page-back', route('dashboard.home'))

  <div class="bg-white rounded-lg border border-red-400 shadow-md flex mt-10 ml-5 mr-20 py-5 px-3">
    <div class="flex justify-around my-3 w-full">
      <div>
        <span class="text-base text-gray-600 font-semibold">Zonal Head : </span>&emsp;
        <span class="text-base text-red-500">{{$zone->leader->name ?? 'Unassigned'}}</span>
      </div>
      <button type="button" class="bg-red-400 rounded-md text-white hover:bg-red-500 py-1 w-44" data-modal-toggle="editZone"><i class="fa fa-edit"></i>&nbsp;Edit Zone</button>
    </div>
  </div>

  <div class="bg-white rounded-lg border border-red-400 shadow-md mt-5 ml-5 mr-20 py-5 px-3">
    <div class="flex justify-between w-full my-3">
      <span class="text-base text-gray-600 font-semibold">Catchments </span>
      <button type="button" class="bg-red-400 rounded-md text-white hover:bg-red-500 py-1 w-44" data-modal-toggle="addCatchment"><i class="fa fa-plus" t></i>&nbsp;Add Catchment</button>
    </div>
    <div class="flex w-full my-5">
      @php
        $headings = ['Location', 'Number of Members', 'Number of First Timers', '', ''];
      @endphp
      <x-table :headings="$headings">
        @foreach ($zone->catchments as $catchment)
          @if ($loop->odd)
            <tr class="group bg-white border-b border-red-300 hover:bg-gray-50 hover:cursor-pointer">
          @else
            <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100 hover:cursor-pointer">
          @endif
            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{$catchment->location}}</th>
            <td class="py-4 px-6">{{count($catchment->members)}}</td>
            <td class="py-4 px-6">{{count($catchment->visitors)}}</td>
            <td class="py-4 px-6 hover:text-indigo-300">
              <i onclick="editCatchment({{$catchment->id}}, '{{$catchment->location}}')" class="fa fa-edit"></i>
            </td>
            <td class="py-4 px-6 hover:text-red-500">
              <i class="fa fa-trash" onclick="document.getElementById('deleteCatchmentForm_{{$catchment->id}}').submit();"></i>
              <form id="deleteCatchmentForm_{{$catchment->id}}" action="{{route('dashboard.zone.catchment.delete', [$catchment])}}" method="post">
                @csrf
                @method('delete')
              </form>
            </td>
          </tr>
        @endforeach
      </x-table>
    </div>
  </div>
    
  @push('modals')
    <!-- Edit Zone modal -->
    <div id="editZone" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Edit Zone
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editZone">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form action="{{route('dashboard.zone.edit', [$zone])}}" method="post">
              @csrf
              @method('put')
              <div class="flex justify-center mb-8">
                <div class="basis-10/12">
                  <x-text-input name="name" type="text" value="{{$zone->name}}" required/>
                </div>
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit">Edit</x-primary-button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Catchment modal -->
    <div id="addCatchment" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Add Catchment
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="addCatchment">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form id="addCatchmentForm" action="{{route('dashboard.zone.catchment.add', ['zone' => $zone])}}" method="post">
              @csrf
              <div class="flex justify-center mb-8">
                <div class="basis-10/12">
                  <x-text-input name="location" placeholder="Enter Location" type="text" required/>
                </div>
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit" form="addCatchmentForm">Save</x-primary-button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Catchment modal -->
    <div id="editCatchment" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Edit Catchment
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" onclick="modal.hide();">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form id="editCatchmentForm" action="{{route('dashboard.zone.catchment.edit')}}" method="post">
              @csrf
              @method('PUT')
              <input id="catchment_id" name="catchment_id" type="hidden" required>
              <div class="flex justify-center mb-8">
                <div class="basis-10/12">
                  <x-text-input id="edit_location" name="location" placeholder="Enter Location" type="text" required/>
                </div>
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit" form="editCatchmentForm">Edit</x-primary-button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endpush

  @push('scripts')
    <script>
      var modal;
      function editCatchment(catchmentId, location) {
        // set the modal menu element
        const targetEl = document.getElementById('editCatchment');

        // options with default values
        const options = {
          onHide: () => {
            console.log('modal is hidden');
            document.getElementById('catchment_id').value = "";
            document.getElementById('edit_location').value = "";
          },
          onShow: () => {
            document.getElementById('catchment_id').value = catchmentId;
            document.getElementById('edit_location').value = location;
            console.log('modal is shown');
          },
        };

        modal = new Modal(targetEl, options);
        modal.show();
      }
    </script>
  @endpush
</x-app-layout>
