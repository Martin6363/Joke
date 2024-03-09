<button
    class="{{ $theme == 'dark' ? 'bg-gray-800 text-gray-800 focus:ring-offset-gray-800 hover:bg-gray-900' : 'bg-gray-800 hover:bg-gray-700'}} inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
{{ $attributes->merge(['type' => 'submit']) }}>
    {{ $slot }}
</button>
