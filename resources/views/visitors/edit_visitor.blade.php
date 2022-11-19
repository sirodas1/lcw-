<x-app-layout>
  @section('title', 'Edit Visitor')
  @section('back-check', true)
  @section('page-back', route('visitors.home'))

  <div class="bg-gray-50 border border-red-300 rounded-lg shadow-md mt-12 ml-5 mr-20 mb-10">
    <div class="flex justify-center mt-12 px-6">
      <span class="text-red-600 text-base">Edit Church Visitor</span>
    </div>
    @if(session()->has('error_message'))
      <div class="flex justify-center mt-12 px-6">
        <span class="text-red-900 text-lg">[[ERROR]] ::: {{session()->get('error_message')}}</span>
      </div>
    @endif
    <form action="{{route('visitors.update', [$visitor])}}" method="post">
      @csrf
      <div class="grid grid-cols-3 gap-6 mt-8 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="firstname">Enter Firstname * : </x-input-label>
          <x-text-input name="firstname" type="text" value="{{$visitor->firstname ?? old('firstname')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="lastname">Enter Lastname * : </x-input-label>
          <x-text-input name="lastname" type="text" value="{{$visitor->lastname ?? old('lastname')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="othername">Enter Othername : </x-input-label>
          <x-text-input name="othername" value="{{$visitor->othername ?? old('othername')}}" type="text"/>
        </div>
      </div>
      <div class="grid grid-cols-4 gap-6 px-6 mb-5">
        @php
          $genders = ['Male', 'Female'];
          $maritals = ['Single','Married', 'Divorced'];
          $titles = ['Dr.','Mr.','Mrs.','Miss'];
        @endphp
        <div class="flex justify-start flex-col">
          <x-input-label for="gender">Gender * : </x-input-label>
          <x-select-option name="gender"  required>
            @foreach ($genders as $option)
              <option @selected($visitor->gender == $option)>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="marital_status">Marital Status * : </x-input-label>
          <x-select-option name="marital_status" required>
            @foreach ($maritals as $option)
              <option @selected($visitor->marital_status == $option)>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="title">Title * : </x-input-label>
          <x-select-option name="title" value="{{$visitor->title}}" required>
            @foreach ($titles as $option)
              <option @selected($visitor->title == $option)>{{$option}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="dob">Date of Birth * :</x-input-label>
          <x-text-input name="dob" type="date" value="{{$visitor->dob ?? old('dob')}}" required/>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="phone_number">Phone Number * :</x-input-label>
          <x-text-input name="phone_number" type="text" value="{{$visitor->phone_number ?? old('phone_number')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="whatsapp_number">WhatsApp Number (<small><i>if different</i></small>) :</x-input-label>
          <x-text-input name="whatsapp_number" type="text" value="{{$visitor->whatsapp_number ?? old('whatsapp_number')}}"/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="occupation">Occupation * :</x-input-label>
          <x-text-input name="occupation" type="text" value="{{$visitor->occupation ?? old('occupation')}}" required/>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="previous_church_bg">Previous Church Background : </x-input-label>
          <x-text-input name="previous_church_bg" type="text" value="{{$visitor->previous_church_bg ?? old('previous_church_bg')}}"/>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="location">Location * :</x-input-label>
          <x-text-input name="location" type="text" value="{{$visitor->location ?? old('location')}}" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="catchment_id">Catchment :</x-input-label>
          <x-select-option name="catchment_id">
            <option @selected($visitor->catchment_id == null)></option>
            @foreach ($catchments as $catchment)
              <option @selected($visitor->catchment_id == $catchment->id) value="{{$catchment->id}}">{{$catchment->location}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="invited_by">Was Invited By :</x-input-label>
          <x-text-input name="invited_by" type="text" value="{{$visitor->invited_by ?? old('invited_by')}}"/>
        </div>
      </div>
      <div class="flex gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col w-4/12">
          <x-input-label for="any_relations">Any Relations in the Church * :</x-input-label>
          <x-select-option id="any_relations" name="any_relations" onchange="toggleRelationDiv('any_relations')">
            <option value="null">No One</option>
            <option @selected($visitor->any_relations == 'Parent')>Parent</option>
            <option @selected($visitor->any_relations == 'Sibling')>Sibling</option>
            <option @selected($visitor->any_relations == 'Friend')>Friend</option>
          </x-select-option>
        </div>
        <div class="flex justify-start">
          <x-check-box name="baptized" class="mt-8" :chck="$visitor->baptized" />
          <x-input-label for="baptized" class="mt-7">&nbsp;&nbsp;Is visitor Baptized? </x-input-label>
        </div>
        <div class="flex justify-start">
          <x-check-box name="sld_subscription" class="mt-8" :chck="$visitor->sld_subscription"/>
          <x-input-label for="sld_subscription" class="mt-7">&nbsp;&nbsp;SLD Subscription? </x-input-label>
        </div>
      </div>
      <div id="related_id_div" class="grid grid-cols-3 gap-6 px-6 mb-5 {{isset($visitor->any_relations)?'':'hidden'}}">
        <div class="flex justify-start flex-col">
          <x-input-label for="relation_id">Select Relation in the Church:</x-input-label>
          <x-select-option id="related_id" name="relation_id" :disabled="(isset($visitor->any_relations)?false:true)">
            @foreach ($members as $member)
              <option  @selected($visitor->relation_id == $member->id) value="{{$member->id}}">{{$member->firstname.' '.$member->lastname.' '.$member->othername}}</option>
            @endforeach
          </x-select-option>
        </div>
      </div>
      <div class="flex justify-center gap-6 px-6 my-10">
        <div class="w-5/12">
          <x-primary-button>Update Visitor</x-primary-button>
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
