<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-[#0B4AA2]/95 backdrop-blur border-b border-white/10">
    <div class="mx-auto max-w-6xl px-6 lg:px-10">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-md bg-white/10 border border-white/20 grid place-items-center overflow-hidden">
                        <img src="{{ asset('images/logo.png') }}" alt="Formacom" class="h-8 w-8 object-contain">
                    </div>
                    <div class="leading-tight hidden sm:block">
                        <div class="text-white font-semibold">Formacom Empleo</div>
                        <div class="text-white/70 text-xs">Agencia de colocación</div>
                    </div>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-2">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold
                              {{ request()->routeIs('dashboard') ? 'bg-white text-[#0B4AA2]' : 'text-white/90 hover:text-white hover:bg-white/10' }}">
                        Dashboard
                    </a>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex items-center gap-3">
                {{-- Teams Dropdown --}}
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold
                                           text-white/90 hover:text-white hover:bg-white/10">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ms-2 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                {{-- Settings Dropdown --}}
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border border-white/20 rounded-md focus:outline-none focus:border-white/40 transition">
                                    <img class="size-8 rounded-md object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold
                                           text-white/90 hover:text-white hover:bg-white/10">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-white/90 hover:text-white hover:bg-white/10">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0B4AA2]/98 border-t border-white/10">
        <div class="px-6 py-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                Dashboard
            </a>
        </div>

        <div class="border-t border-white/10"></div>

        <div class="px-6 py-4">
            <div class="text-white font-semibold">{{ Auth::user()->name }}</div>
            <div class="text-white/70 text-sm">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.show') }}"
                   class="block px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                    {{ __('Profile') }}
                </a>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <a href="{{ route('api-tokens.index') }}"
                       class="block px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                        {{ __('API Tokens') }}
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                        {{ __('Log Out') }}
                    </button>
                </form>

                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-white/10 mt-3"></div>
                    <div class="px-3 pt-3 pb-1 text-xs text-white/70">
                        {{ __('Manage Team') }}
                    </div>

                    <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                       class="block px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                        {{ __('Team Settings') }}
                    </a>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <a href="{{ route('teams.create') }}"
                           class="block px-3 py-2 text-white/90 hover:text-white hover:bg-white/10">
                            {{ __('Create New Team') }}
                        </a>
                    @endcan
                @endif
            </div>
        </div>
    </div>
</nav>
