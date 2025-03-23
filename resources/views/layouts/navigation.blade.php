<nav x-data="{ open: false }" class="{{ $theme == 'dark' ? 'bg-gray-800 border-gray-700' : 'bg-gray-100'}} border-b border-gray-100 position-fixed w-full z-10" style="-webkit-box-shadow: 0px 4px 8px -1px #000000; 
box-shadow: 0px 4px 8px -1px #000000;">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between w-full h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-700'}}" />
                    </a>
                </div>
                <x-search-bar></x-search-bar>
            </div>
            <!-- Navigation Links -->
            <div class="nav-link" style="width: 45%;">
                <div class="hidden space-x-8 sm:flex items-center h-100">
                    <ul class="flex h-100 gap-5 items-end w-full" style="justify-content: space-around">
                        <li class="w-full" style="border-bottom: 4px solid blue;">
                            <a href="{{route('home')}}" wire:navigate class="{{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }} hover:bg-gray-400">
                                <i class="fa-solid fa-house" style="font-size: 25px"></i>
                            </a>
                        </li>
                        <li class="w-full"><a href="{{route('home')}}" class="{{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }} hover:bg-gray-400"><i class="fa-solid fa-user-group"></i></a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border-transparent text-sm leading-4 font-medium rounded-md gap-2 text-gray-500 {{ $theme == 'dark' ? 'text-gray-400 bg-gray-800 hover:text-gray-300' : 'text-gray-700 bg-gray-100'}} hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div>
                                <img src="{{ Storage::url('avatar/' . Auth::user()->avatar) }}" width="40" class="img-fluid mr-2" alt="">
                            </div>                            
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    

                    <x-slot name="content" class="{{ $theme == 'dark' ? 'bg-gray-800' : 'bg-gray-100'}}">
                        <x-dropdown-link :href="route('profile')">
                            <i class="fa-solid fa-user"></i> {{ __('Profile') }}
                        </x-dropdown-link>
                        <form action="{{ route('create-update') }}" method="POST" class="mode_box">
                            @csrf
                            <input type="radio" name="theme" id="theme" value="{{ $theme == 'dark' ? 'light' : 'dark' }}" class="btn-check" onchange="this.form.submit()">
                            <label for="theme" class="block w-full px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} cursor-pointer">
                                <i class="fa-solid {{ $theme == 'dark' ? 'fa-sun' : 'fa-moon' }}"></i>
                                <span>{{ $theme == 'dark' ? 'Light theme' : 'Dark theme' }}</span>
                            </label>
                        </form>
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-solid fa-gear"></i> {{ __('Settings') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" wire:navigate
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden z-10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
