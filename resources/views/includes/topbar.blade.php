@php
    $back_check = View::hasSection('back-check');
@endphp
<nav>
    <div class="flex justify-between pl-2">
        <div class="px-0 py-4">
            @if ($back_check)
                <a href="@yield('page-back')"><span class="h5 text-success"><i class="fa fa-chevron-left"></i></span></a>&emsp;
            @endif
            <span class="text-xl text-gray-600"><strong>@yield('title')</strong></span>
        </div>
        <div class="pl-4 py-4 group hover:bg-red-400">
            <div class="flex justify-end">
                <div class="mr-4">
                    <a class="text-base text-red-600 group-hover:text-white font-bold" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> &nbsp; {{ __('LOGOUT') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>