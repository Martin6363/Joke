<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="input_box card w-full mt-4 p-2" style="display: flex; justify-content:space-around; border: .5px solid #6f6f6f; border-radius:3px;">
            <div class="">
                <x-input-label :value="__('Gender')" />
                <div class="flex items-center gap-2 form-check text-lime-50 text-sm mt-1">
                    <input class="form-check-input  " type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label  {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-900'}}" for="male">
                        Male
                    </label>
                    <div class="text-lime-50 text-sm">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" checked>
                        <label class="form-check-label {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-900'}}" for="female">
                            Female
                        </label>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="d-flex flex-col items-end">
                <x-input-label :value="__('Date of birth')" />
                <input type="date" class="block mt-1 border-gray-300 dark:border-gray-700 {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-200 text-gray-900'}}" name="dateOfBirth" required autocomplete="dob">
                <x-input-error :messages="$errors->get('dateOfBirth')" class="mt-2" />
            </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                &#x2B05 {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4 text-gray-200 dark:hover:text-gray-100" style="border: 2px solid #fff; color: #fff">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
