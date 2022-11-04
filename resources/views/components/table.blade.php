<div class="overflow-x-auto w-full relative shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-red-200">
      <tr>
        @foreach ($headings as $heading)
          <th scope="col" class="py-3 px-6">{{$heading}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      {{ $slot }}
    </tbody>
  </table>
</div>
