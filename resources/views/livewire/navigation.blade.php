<header class="bg-trueGray-700 sticky top-0 z-50" x-data={open:false}>
    <div class="container flex items-center h-16">

        {{-- Menu burger --}}
        <a x-on:click="open = !open" class="bg-white bg-opacity-25 text-white cursor-pointer h-full p-4">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </a>

        {{-- Logo --}}
        <a href="/" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>

        {{-- Search bar --}}
        @livewire('search')

        {{-- Register --}}
        <div class="ml-3 relative">
            @auth
                <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-jet-dropdown-link>

                    <x-jet-dropdown-link href="{{ route('admin.index') }}">
                        Administrador
                    </x-jet-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                    </form>
                </x-slot>
                </x-jet-dropdown>
            @else
                <x-jet-dropdown align="right" width="48">

                <x-slot name="trigger">
                    <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link href="{{ route('login') }}">
                        {{ __('Login') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('register') }}">
                        {{ __('Register') }}
                    </x-jet-dropdown-link>
                </x-slot>
                </x-jet-dropdown>
            @endauth
        </div>

        @livewire('dropdown-cart')
    </div>

    <nav id="navigation-menu" class="bg-gray-300 absolute container  hidden" :class="{'block': open, 'hidden': !open}">
        <div x-on:click.away="open = false" class="h-full">
            <ul class="bg-white">        
                @foreach ($categories as $category)
                    <li class="navigation-link hover:bg-gray-500 hover:text-white">

                        <a href="{{route('categories.show', $category)}}" class="py-2 px-3 w-auto font-semibold flex items-center">
                            {{$category->name}}
                        </a>
                        <div class="navigation-submenu bg-white absolute w-3/5 lg:w-3/4  h-full top-0 right-0 hidden">
                            <x-navigation-submenu :category="$category"/>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</header>

<style>
    #navigation-menu {height: calc {100vh - 4rem};}

    .navigation-link:hover .navigation-submenu {display: block !important;}
</style>