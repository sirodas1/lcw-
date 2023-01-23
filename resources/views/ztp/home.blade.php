<x-app-layout>
  @section('title', 'ZTP')

  @if (session()->has('success_message'))
    <div id="success_message_added" class="flex justify-between my-6 mr-5 px-2 py-1 border border-green-500 rounded">
      <span class="text-base font-semibold text-green-500">{{session()->get('success_message')}}</span>
      <i class="fa fa-close text-gray-600 hover:text-red-600 hover:cursor-pointer pt-1" onclick="document.getElementById('success_message_added').remove();"></i>
    </div>  
  @endif
  @if (session()->has('error_message'))
    <div id="error_message_added" class="flex justify-between my-6 mr-5 px-2 py-1 border border-red-500 rounded">
      <span class="text-base font-semibold text-red-500">{{session()->get('error_message')}}</span>
      <i class="fa fa-close text-gray-600 hover:text-red-600 hover:cursor-pointer pt-1" onclick="document.getElementById('error_message_added').remove();"></i>
    </div>  
  @endif
  @if (auth()->user()->user_type == 'Admin')
    <div class="flex justify-end mt-12 pl-3 pr-10">
      <button class="text-gray-600 hover:text-red-500" data-modal-toggle="uploadFileModal"><i class="fa fa-upload"></i>&nbsp; Upload File</button>
    </div>
  @endif

  <div class="flex mt-10 pl-5 pr-10">
    @php
      $headings = ['Filename', 'File Type', 'Uploaded Date', ''];
    @endphp
    <x-table :headings="$headings">
      @foreach ($files as $file)
        @if ($loop->odd)
          <tr class="group bg-white border-b border-red-300 hover:bg-gray-50 hover:cursor-pointer">
        @else
          <tr class="group bg-red-50 border-b border-red-300 hover:bg-red-100 hover:cursor-pointer">
        @endif
          <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">{{$file->filename}}</th>
          <td class="py-4 px-6">{{ucfirst($file->file_type)}}</td>
          <td class="py-4 px-6">{{date('F j, Y', strtotime($file->created_at))}}</td>
          <td class="py-4 px-6">
            <a href="{{$file->file_path}}" class="hover:text-red-400" download><i class="fa fa-download"></i></a>
            @if (auth()->user()->user_type == 'Admin')
              &emsp;
              <button type="submit" form="{{'deleteForm_'.$file->id}}" class="py-1 px-2 bg-red-500 text-white rounded hover:bg-red-400"><i class="fa fa-trash"></i></button>
              <form id="{{'deleteForm_'.$file->id}}" action="{{route('ztp.delete', ['file' => $file])}}" method="post">
                @csrf
                @method('delete')
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    </x-table> 
  </div>

  @push('modals')
    <!-- Upload File modal -->
    <div id="uploadFileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-4 border-red-300">
          <!-- Modal header -->
          <div class="flex justify-between items-start p-4 rounded-t">
            <h3 class="text-xl font-semibold text-red-700 ">
              Upload New File
            </h3>
            <button type="button" class="text-red-400 bg-transparent hover:bg-red-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="uploadFileModal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <form id="uploadNewFile" action="{{route('ztp.upload')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="grid grid-cols-2 gap-6 mb-5">
                <div class="grid grid-cols-3">
                  <div class="col-span-1 h-full">
                    <x-input-label class="mt-2" for="filename">Enter Filename : </x-input-label>
                  </div>
                  <x-text-input class="col-span-2" name="filename" type="text" required/>
                </div>
                <div class="grid grid-cols-3">
                  <div class="col-span-1 h-full">
                    <x-input-label class="mt-2" for="file_type">Select File Type : </x-input-label>
                  </div>
                  <x-select-option class="col-span-2" name="file_type"  required>
                      <option value="video">Video</option>
                      <option value="audio">Audio</option>
                      <option value="image">Image</option>
                      <option value="document">Document</option>
                  </x-select-option>
                </div>
              </div>
              <div class="flex justify-center my-8">
                <input type="file" id="upload_file" name="upload_file" class="text-gray-500 rounded-full bg-red-100 file:bg-gray-600">
              </div>
              <div class="flex justify-center mb-4">
                <div class="basis-8/12">
                  <x-primary-button type="submit" form="uploadNewFile">Upload File</x-primary-button>
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
      
    </script>
  @endpush
</x-app-layout>
