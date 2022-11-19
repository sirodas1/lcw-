@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'rounded-md shadow-sm'.($disabled ?' bg-gray-200 ':' border-red-300 ').'focus:border-rose-300 focus:ring focus:ring-rose-200 focus:ring-opacity-50 w-full text-gray-500',]) !!}>{{$slot}}</textarea>