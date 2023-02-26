<x-app-layout>
  @section('title', 'Add Members')
  @section('back-check', true)
  @section('page-back', route('members.home'))

  <div class="bg-gray-50 border border-red-300 rounded-lg shadow-md mt-12 ml-5 mr-5 lg:mr-20 mb-10">
    <div class="flex justify-center mt-12 px-6">
      <span class="text-red-600 text-base">Add New Church Member</span>
    </div>
    @if(session()->has('error_message'))
      <div class="flex justify-center mt-12 px-6">
        <span class="text-red-900 text-lg">[[ERROR]] ::: {{session()->get('error_message')}}</span>
      </div>
    @endif
    <form action="{{route('members.save')}}" method="post">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="firstname">Enter Firstname * : </x-input-label>
          <x-text-input name="firstname" type="text" value="{{old('firstname')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="lastname">Enter Lastname * : </x-input-label>
          <x-text-input name="lastname" type="text" value="{{old('lastname')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="othername">Enter Othername : </x-input-label>
          <x-text-input name="othername" value="{{old('othername')}}" type="text"/>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-6 mb-5">
        @php
          $genders = ['Male', 'Female'];
          $maritals = ['Single','Married', 'Divorced'];
          $titles = ['Pastor','Deacon','Deaconess','E-Pastor','Steward','Dr.','Mr.','Mrs.','Miss'];
        @endphp
        <div class="flex justify-start flex-col">
          <x-input-label for="gender">Gender * : </x-input-label>
          <x-select-option name="gender"  required>
            @foreach ($genders as $option)
              <option>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="marital_status">Marital Status * : </x-input-label>
          <x-select-option name="marital_status" required>
            @foreach ($maritals as $option)
              <option>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="title">Title * : </x-input-label>
          <x-select-option name="title" required>
            @foreach ($titles as $option)
              <option>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="dob">Date of Birth * :</x-input-label>
          <x-text-input name="dob" type="date" value="{{old('dob')}}" required/>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="phone_number">Phone Number * :</x-input-label>
          <x-text-input name="phone_number" type="text" value="{{old('phone_number')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="whatsapp_number">WhatsApp Number (<small><i>if different</i></small>) :</x-input-label>
          <x-text-input name="whatsapp_number" type="text" value="{{old('whatsapp_number')}}"/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="occupation">Occupation * :</x-input-label>
          <x-text-input name="occupation" type="text" value="{{old('occupation')}}" required/>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="position">Position In Church : </x-input-label>
          <x-text-input name="position" type="text" value="{{old('position')}}" placeholder="eg. Usher or Chorister"/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="previous_church_bg">Previous Church Background : </x-input-label>
          <x-text-input name="previous_church_bg" type="text" value="{{old('previous_church_bg')}}"/>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="location">Location * :</x-input-label>
          <x-text-input name="location" type="text" value="{{old('location')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="catchment_id">Catchment :</x-input-label>
          <x-select-option name="catchment_id">
            @foreach ($catchments as $catchment)
              <option value="{{$catchment->id}}">{{$catchment->location}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="invited_by">Was Invited By :</x-input-label>
          <x-text-input name="invited_by" type="text" value="{{old('invited_by')}}"/>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:flex gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col lg:w-4/12">
          <x-input-label for="any_relations">Any Relations in the Church * :</x-input-label>
          <x-select-option id="any_relations" name="any_relations" onchange="toggleRelationDiv('any_relations')">
            <option value="null">No One</option>
            <option>Parent</option>
            <option>Sibling</option>
            <option>Friend</option>
          </x-select-option>
        </div>
        <div class="flex justify-start">
          <x-check-box name="baptized" class="mt-8"/>
          <x-input-label for="baptized" class="mt-7">&nbsp;&nbsp;Is Member Baptized? </x-input-label>
        </div>
        <div class="flex justify-start">
          <x-check-box name="foundation_sch_status" class="mt-8"/>
          <x-input-label for="foundation_sch_status" class="mt-7">&nbsp;&nbsp;Completed Foundation Sch? </x-input-label>
        </div>
        <div class="flex justify-start">
          <x-check-box name="sld_subscription" class="mt-8"/>
          <x-input-label for="sld_subscription" class="mt-7">&nbsp;&nbsp;SLD Subscription? </x-input-label>
        </div>
      </div>
      <div id="related_id_div" class="grid grid-cols-3 gap-6 px-6 mb-5 hidden">
        <div class="flex justify-start flex-col">
          <x-input-label for="relation_id">Select Relation in the Church:</x-input-label>
          <x-select-option id="related_id" name="relation_id" :disabled="true">
            @foreach ($members as $member)
              <option value="{{$member->id}}">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</option>
            @endforeach
          </x-select-option>
        </div>
      </div>
      <div class="flex justify-center gap-6 px-6 my-10">
        <div class="w-5/12">
          <x-primary-button>Save Member</x-primary-button>
        </div>
      </div>
    </form>
  </div>
  
  @push('scripts')
    <script>
      function toggleRelationDiv(elementID) {
        var any_relations_select = document.getElementById(elementID);
        var related_id_div = document.getElementById('related_id_div');
        var related_id_select = document.getElementById('related_id');
        if(any_relations_select.value != 'null'){
          related_id_div.classList.remove('hidden');
          related_id_select.disabled = false;
        }else{
          related_id_div.classList.add('hidden');
          related_id_select.disabled = true;
        }
      }
    </script>
  @endpush
</x-app-layout>
