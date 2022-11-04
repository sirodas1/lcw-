@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-red-300 focus:border-rose-300 focus:ring focus:ring-rose-200 focus:ring-opacity-50 w-full text-gray-500']) !!}>
