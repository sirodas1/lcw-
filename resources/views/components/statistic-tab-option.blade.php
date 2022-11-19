<div {{ $attributes->merge(['class' => 'group bg-white rounded-lg p-5 hover:bg-red-400 hover:cursor-pointer shadow-sm hover:shadow-lg'])}}>
  <div class="flex justify-center text-red-400 group-hover:text-white">
    <span class="text-base font-semibold text-center">{{$name}}</span>
  </div>
  <div class="flex justify-center mt-3 px-5">
    <div class="rounded-full bg-red-400 group-hover:bg-white text-white group-hover:text-red-400 w-10 h-10 items-center justify-center flex"><span class="text-base font-normal text-center">{{$number}}</span></div>
  </div>
</div>