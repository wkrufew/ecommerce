@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#60A3BD] focus:ring-[#60A3BD] rounded-md shadow-sm']) !!}>
