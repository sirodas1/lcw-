<div {{ $attributes->merge(['class' => 'group bg-white rounded-lg p-5 px-2 hover:bg-red-400 hover:cursor-pointer shadow-sm hover:shadow-lg'])}}>
  <div class="flex justify-start text-red-400 group-hover:text-white">
    <span class="text-sm font-semibold text-center">{{$name}}</span>
  </div>
  <div class="flex justify-start mt-3">
    <div class="rounded-full bg-red-400 group-hover:bg-white text-white group-hover:text-red-400 w-10 h-10 items-center justify-center flex"><span class="text-base font-normal text-center">{{$number}}</span></div>
  </div>
</div>