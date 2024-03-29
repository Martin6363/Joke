<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-11">
            <div class="p-4 sm:p-8 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-100 text-gray-800'}} shadow sm:rounded-lg">
                <div class="w-100">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-100 text-gray-800'}} shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-100 text-gray-800'}} shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
