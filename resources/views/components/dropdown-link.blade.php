<a 
class="{{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} block w-full px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out" 
{{ $attributes->merge([]) }}>{{ $slot }}</a>
