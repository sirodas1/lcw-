<div class="w-full">
    <form action="" method="get">
        @csrf
        <div class="flex flex-cols-2">
            <input type="text" name="search" class="rounded-md rounded-r-none shadow-sm border-red-300 focus:border-rose-300 focus:ring focus:ring-rose-200 focus:ring-opacity-50 w-10/12 text-red-700" placeholder="Search {{$criteria}} by name" required>
            <button class="bg-red-400 w-1/12 text-white rounded-lg rounded-l-none py-1 hover:bg-red-500" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>