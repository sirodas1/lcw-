@php
    $back_check = View::hasSection('back-check');
@endphp
<nav id="topbar" class="my-4">
    <div class="flex justify-between px-2">
        <div class="px-0">
            @if ($back_check)
                <a href="@yield('page-back')"><span class="h5 text-success"><i class="fa fa-chevron-left"></i></span></a>&emsp;
            @endif
            <span class="text-xl text-gray-600"><strong>@yield('title')</strong></span>
        </div>
        <div class="md:basis-5/12">
            <div class="flex justify-end">
                <div class="mr-4">
                    <a class="text-base text-red-600 hover:text-red-400 font-bold" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('LOGOUT') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>