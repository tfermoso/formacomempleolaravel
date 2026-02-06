<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    {{-- TOP BAR --}}
    <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4 lg:px-10">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                {{-- Cambia esto por tu logo si lo pones en public/images/logo-formacom.svg --}}
                {{-- <img src="{{ asset('images/logo.png') }}" class="h-9 w-auto" alt="Formacom" /> --}}
                <div
                    class="h-5 w-5 rounded-full border border-slate-200 bg-white shadow-sm overflow-hidden grid place-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Formacom" class="h-full w-full object-cover" />
                </div>

                <div class="leading-tight">
                    <div class="font-semibold">Formacom Empleo</div>
                    <div class="text-xs text-slate-500">Agencia de colocación</div>
                </div>
            </a>

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-slate-50">
                            Ir al panel
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                            Acceder
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                                Crear cuenta
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>