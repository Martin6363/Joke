@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} 
    class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" 
    {!! $attributes->merge([]) !!}>
