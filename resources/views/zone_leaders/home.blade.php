<x-app-layout>
  @section('title', 'Zone Leaders')

  <div class="flex justify-end w-full mt-12 pl-3 pr-6">
    <div class="w-3/12 flex pt-1">
      <button class="bg-red-400 text-center text-white rounded-lg py-2 hover:bg-red-500 px-3" data-modal-toggle="addZoneLeader"><i class="fa fa-plus"></i>&nbsp; Add Zonal Head</button>
    </div>
  </div>
  <div class="flex mt-10 pl-5 pr-10">
    @php
        $headings = ['Fullname', 'Username', 'Zone'];
    @endphp
    <x-table :headings="$headings">
      @foreach ($zone_leaders as $leader)
        @if ($loop->odd)
          <tr class="group bg-white border-b border-red-300 hover:bg-gray-50 hover:cursor-pointer" onclick="editZoneLeader({{$leader->id}}, {{$leader->member_id}}, {{$leader->zone->id}}, '{{$leader->username}}')">
        @else
          <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100 hover:cursor-pointer" onclick="editZoneLeader({{$leader->id}}, {{$leader->member_id}}, {{$leader->zone->id}}, '{{$leader->username}}')">
        @endif
          <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{$leader->name}}</th>
          <td class="py-4 px-6">{{$leader->username}}</td>
          <td class="py-4 px-6">{{$leader->zone->name}}</td>
        </tr>
      @endforeach
    </x-table>  
  </div>

  @push('modals')
    <!-- Add Zone Leader modal -->
    <div id="addZoneLeader" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Create Zonal Head Account
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="addZoneLeader">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form id="addLeaderForm" action="{{route('leaders.save')}}" method="post">
              @csrf
              <input type="hidden" name="user_type" value="Zone Leader">
              <div class="grid grid-cols-2 gap-6 mb-5">
                <div class="flex justify-start flex-col">
                  <x-input-label for="member_id">Select Member : </x-input-label>
                  <x-select-option name="member_id"  required>
                    @foreach ($members as $member)
                      <option value="{{$member->id}}">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</option>
                    @endforeach
                  </x-select-option>
                </div>
                <div class="flex justify-start flex-col">
                  <x-input-label for="zone_id">Select Zone : </x-input-label>
                  <x-select-option name="zone_id"  required>
                    @foreach ($zones as $zone)
                      <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endforeach
                  </x-select-option>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-6 mb-5">
                <div class="flex justify-start flex-col">
                  <x-input-label for="username">Enter Username : </x-input-label>
                  <x-text-input name="username" type="text" required/>
                </div>                
                <div class="flex justify-start flex-col">
                  <x-input-label for="password">Enter password : </x-input-label>
                  <x-text-input name="password" type="password" required/>
                </div>
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit" form="addLeaderForm">Create</x-primary-button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Zone Leader modal -->
    <div id="editZoneLeader" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Edit Zonal Head Account
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"  onclick="modal.hide();">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form id="editLeaderForm" action="{{route('leaders.update')}}" method="post">
              @csrf
              @method('put')
              <input type="hidden" name="user_type" value="Zone Leader">
              <input id="leader_id" type="hidden" name="leader_id">
              <div class="grid grid-cols-2 gap-6 mb-5">
                <div class="flex justify-start flex-col">
                  <x-input-label for="member_id">Select Member : </x-input-label>
                  <x-select-option id="member_id" name="member_id"  required>
                    @foreach ($members as $member)
                      <option value="{{$member->id}}">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</option>
                    @endforeach
                  </x-select-option>
                </div>
                <div class="flex justify-start flex-col">
                  <x-input-label for="zone_id">Select Zone : </x-input-label>
                  <x-select-option id="zone_id" name="zone_id"  required>
                    @foreach ($zones as $zone)
                      <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endforeach
                  </x-select-option>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-6 mb-5">
                <div class="flex justify-start flex-col">
                  <x-input-label for="username">Enter Username : </x-input-label>
                  <x-text-input id="username" name="username" type="text" required/>
                </div>                
                <div class="flex justify-start flex-col">
                  <x-input-label for="password">Enter password : </x-input-label>
                  <x-text-input name="password" type="password" required/>
                </div>
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit" form="editLeaderForm">Update</x-primary-button>
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
    function editZoneLeader(leaderID, memberID, zoneID, username) {
      // set the modal menu element
      const targetEl = document.getElementById('editZoneLeader');
      console.log(username);
      // options with default values
      const options = {
        onHide: () => {
          console.log('modal is hidden');
          document.getElementById('leader_id').value = "";
          document.getElementById('member_id').value = "";
          document.getElementById('zone_id').value = "";
          document.getElementById('username').value = "";
        },
        onShow: () => {
          document.getElementById('leader_id').value = leaderID;
          document.getElementById('member_id').value = memberID;
          document.getElementById('zone_id').value = zoneID;
          document.getElementById('username').value = username;
          console.log('modal is shown');
        },
      };

      modal = new Modal(targetEl, options);
      modal.show();
    }
  </script>
  @endpush
</x-app-layout>
