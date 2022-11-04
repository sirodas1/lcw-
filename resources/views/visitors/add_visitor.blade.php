<x-app-layout>
  @section('title', 'Add Visitor')
  @section('back-check', true)
  @section('page-back', route('visitors.home'))

  <div class="bg-gray-50 border border-red-300 rounded-lg shadow-md mt-12 ml-5 mr-20 mb-10">
    <div class="flex justify-center mt-12 px-6">
      <span class="text-red-600 text-base">Add New Church Visitor</span>
    </div>
    <form action="{{route('visitors.save')}}" method="post">
      @csrf
      <div class="grid grid-cols-3 gap-6 mt-8 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="firstname">Enter Firstname * : </x-input-label>
          <x-text-input name="firstname" type="text" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="lastname">Enter Lastname * : </x-input-label>
          <x-text-input name="lastname" type="text" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="othername">Enter Othername : </x-input-label>
          <x-text-input name="othername" type="text"/>
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
          <x-text-input name="dob" type="date" required/>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="phone_number">Phone Number * :</x-input-label>
          <x-text-input name="phone_number" type="text" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="whatsapp_number">WhatsApp Number (<small><i>if different</i></small>) :</x-input-label>
          <x-text-input name="whatsapp_number" type="text"/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="occupation">Occupation * :</x-input-label>
          <x-text-input name="occupation" type="text" required/>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="previous_church_bg">Previous Church Background : </x-input-label>
          <x-text-input name="previous_church_bg" type="text"/>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="location">Location * :</x-input-label>
          <x-text-input name="location" type="text" required/>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="catchment_id">Catchment :</x-input-label>
          <x-select-option name="catchment_id" required>
            @foreach ($catchments as $catchment)
              <option value="{{$catchment->id}}">{{$catchment->location}}</option>
            @endforeach
          </x-select-option>
        </div>
        <div class="flex justify-start flex-col">
          <x-input-label for="invited_by">Was Invited By :</x-input-label>
          <x-text-input name="invited_by" type="text"/>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 px-6 mb-5">
        <div class="flex justify-start flex-col">
          <x-input-label for="any_relations">Any Relations in the Church * :</x-input-label>
          <x-select-option name="any_relations">
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
          <x-check-box name="sld_subscription" class="mt-8"/>
          <x-input-label for="sld_subscription" class="mt-7">&nbsp;&nbsp;SLD Subscription? </x-input-label>
        </div>
      </div>
      <div class="flex justify-center gap-6 px-6 my-10">
        <div class="w-5/12">
          <x-primary-button>Save Visitor</x-primary-button>
        </div>
      </div>
    </form>
  </div>
</x-app-layout>
