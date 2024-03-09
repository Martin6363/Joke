@props(['value'])

<label class='block font-medium text-sm {{ $theme == "dark" ? "text-gray-300" : "text-gray-700"}}'>
    {{ $value ?? $slot }}
</label>
