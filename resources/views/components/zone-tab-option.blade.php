<div class="group border-2 border-red-300 rounded-lg p-5 hover:border-red-400 hover:bg-red-400 hover:cursor-pointer">
    <div class="flex justify-between text-red-400 group-hover:text-white">
        <span class="text-lg font-semibold">{{$name}}</span>
        <span class="text-sm">{{$leader}}</span>
    </div>
    <div class="flex justify-between mt-3 text-red-400 group-hover:text-white px-5">
        <div><span class="text-sm">Catchments</span></div>
        <div><span class="text-base font-semibold">{{$catchment}}</span></div>
    </div>
    <div class="flex justify-between mb-3 text-red-400 group-hover:text-white px-5">
        <div><span class="text-sm">Members</span></div>
        <div><span class="text-base font-semibold">{{$members}}</span></div>
    </div>
</div>