<nav x-data="{ open: false }" class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo Section -->
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="w-12 h-12">
            <span class="text-black font-semibold text-2xl pl-2">UrDeposite</span>
        </a>

        <!-- Button Section (Profile Dropdown) -->
        <div class="flex md:order-2 space-x-3 px-12 items-center">
            <!-- Profile Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black bg-white hover:text-[#129661] focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->username }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>

            <!-- Mobile menu button -->
            <button @click="open = ! open" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <!-- Menu Items -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-default">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded md:p-0 {{ request()->routeIs('dashboard') ? 'text-white bg-[#129661] md:bg-transparent md:text-[#129661]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661]' }}" {{ request()->routeIs('dashboard') ? 'aria-current=page' : '' }}>Dashboard</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Simulation</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Comparing</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Education</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 {{ request()->routeIs('dashboard') ? 'text-[#129661] bg-gray-50' : 'text-gray-900 hover:bg-gray-100' }}">Home</a>
            <a href="#" class="block py-2 px-4 text-gray-900 hover:bg-gray-100">About</a>
            <a href="#" class="block py-2 px-4 text-gray-900 hover:bg-gray-100">Deposit</a>
            <a href="#" class="block py-2 px-4 text-gray-900 hover:bg-gray-100">Contact</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block py-2 px-4 text-gray-900 hover:bg-gray-100">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="block w-full text-left py-2 px-4 text-gray-900 hover:bg-gray-100">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
