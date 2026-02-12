<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white">
    {{-- HEADER (azul estilo Formacom) --}}
    <header class="sticky top-0 z-50 bg-[#0B4AA2]/95 backdrop-blur border-b border-white/10">
        <div class="mx-auto max-w-6xl px-6 lg:px-10 py-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-white/10 border border-white/20 grid place-items-center overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="Formacom" class="h-8 w-8 object-contain">
                </div>
                <div class="leading-tight">
                    <div class="text-white font-semibold">Formacom Empleo</div>
                    <div class="text-white/70 text-xs">Agencia de colocación</div>
                </div>
            </a>

            {{-- Menú desktop --}}
            <nav class="hidden sm:flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                        Ir al panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white/90 hover:text-white hover:bg-white/10">
                        Acceder
                    </a>

                    <a href="{{ url('/candidato/register') }}"
                        class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                        Registro candidato/a
                    </a>

                    <a href="{{ url('/empresa/register') }}"
                        class="inline-flex items-center rounded-xl border border-white/30 text-white px-4 py-2 text-sm font-semibold hover:bg-white/10">
                        Registro empresa
                    </a>
                @endauth
            </nav>

            {{-- Menú móvil (simple) --}}
            <div class="sm:hidden flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white font-semibold">Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-semibold">Acceder</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Contenido --}}
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    {{-- Botonera móvil fija para registros --}}
    @guest
        <div class="sm:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-200 p-3">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ url('/candidato/register') }}"
                    class="rounded-xl py-3 text-center font-semibold bg-slate-900 text-white">
                    Candidato/a
                </a>
                <a href="{{ url('/empresa/register') }}"
                    class="rounded-xl py-3 text-center font-semibold bg-[#0B4AA2] text-white">
                    Empresa
                </a>
            </div>
        </div>

        {{-- espacio para la botonera móvil --}}
        <div class="h-20 sm:hidden"></div>
    @endguest

    @livewireScripts
</body>
</html>
