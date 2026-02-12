<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard candidato
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Revisa tus procesos y descubre nuevas ofertas.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('candidato.ofertas') }}"
                    class="px-4 py-2 bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800">
                    Buscar ofertas
                </a>
                <a href="{{ route('candidato.edit') }}"
                    class="px-4 py-2 border border-slate-300 bg-white text-slate-800 text-sm font-semibold hover:bg-slate-50">
                    Editar perfil
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-2">
                {{-- CARD 1: Candidaturas abiertas --}}
                <a href="{{ route('candidato.candidaturas') }}"
                    class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                Candidaturas abiertas
                            </h3>
                            <p class="text-sm text-slate-600 mt-1">
                                Procesos en curso en los que estás inscrito.
                            </p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">
                            {{ $abiertasCount }}
                        </div>
                    </div>

                    <div class="mt-5 divide-y">
                        @forelse($abiertasTop3 as $oferta)
                            <div class="py-3 flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="font-semibold text-slate-900 truncate">
                                        {{ $oferta->titulo }}
                                    </div>
                                    <div class="text-sm text-slate-600">
                                        {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                        @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        Inscrito: {{ optional($oferta->pivot->fecha_inscripcion)->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                <span class="text-xs border border-slate-200 bg-slate-100 px-2 py-1 whitespace-nowrap">
                                    {{ $oferta->pivot->estado }}
                                </span>
                            </div>
                        @empty
                            <div class="py-4 text-sm text-slate-600">
                                No tienes candidaturas abiertas todavía.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4 text-sm font-semibold text-[#0B4AA2]">
                        Ver todas →
                    </div>
                </a>

                {{-- CARD 2: Candidaturas cerradas --}}
                <a href="{{ route('candidato.candidaturas') }}"
                    class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                Candidaturas cerradas
                            </h3>
                            <p class="text-sm text-slate-600 mt-1">
                                Procesos finalizados (contratado, descartado o retirado).
                            </p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">
                            {{ $cerradasCount }}
                        </div>
                    </div>

                    <div class="mt-5 divide-y">
                        @forelse($cerradasTop3 as $oferta)
                            <div class="py-3 flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="font-semibold text-slate-900 truncate">
                                        {{ $oferta->titulo }}
                                    </div>
                                    <div class="text-sm text-slate-600">
                                        {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                        @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        Inscrito: {{ optional($oferta->pivot->fecha_inscripcion)->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                <span class="text-xs border border-slate-200 bg-slate-100 px-2 py-1 whitespace-nowrap">
                                    {{ $oferta->pivot->estado }}
                                </span>
                            </div>
                        @empty
                            <div class="py-4 text-sm text-slate-600">
                                Aún no tienes candidaturas cerradas.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4 text-sm font-semibold text-[#0B4AA2]">
                        Ver historial →
                    </div>
                </a>

                {{-- CARD 3: Ofertas publicadas --}}
                <div class="bg-white border border-slate-200 shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Ofertas publicadas</h3>
                            <p class="text-sm text-slate-600 mt-1">Últimas vacantes disponibles en el portal.</p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">
                            {{ $ofertasPublicadasCount }}
                        </div>
                    </div>

                    <div class="mt-5 divide-y">
                        @forelse($ofertasTop3 as $oferta)
                            <a href="{{ route('candidato.ofertas.show', $oferta) }}"
                                class="block py-3 hover:bg-slate-50 transition">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-900 truncate">
                                            {{ $oferta->titulo }}
                                        </div>
                                        <div class="text-sm text-slate-600">
                                            {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                            @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                        </div>
                                        @if($oferta->fecha_publicacion)
                                            <div class="text-xs text-slate-500 mt-1">
                                                Publicada: {{ $oferta->fecha_publicacion->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </div>

                                    <span class="text-xs border border-slate-200 bg-slate-100 px-2 py-1 whitespace-nowrap">
                                        {{ $oferta->modalidad->nombre ?? 'Modalidad' }}
                                    </span>
                                </div>
                            </a>
                        @empty
                            <div class="py-4 text-sm text-slate-600">
                                No hay ofertas publicadas ahora mismo.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('candidato.ofertas') }}"
                            class="text-sm font-semibold text-[#0B4AA2] hover:underline">
                            Buscar ofertas →
                        </a>
                    </div>
                </div>


                {{-- CARD 4: Empresas registradas --}}
                <a href="{{ route('candidato.ofertas') }}"
                    class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                Empresas registradas
                            </h3>
                            <p class="text-sm text-slate-600 mt-1">
                                Empresas activas y número total de ofertas publicadas.
                            </p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">
                            {{ $empresasCount }}
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="text-sm text-slate-700">
                            Ofertas publicadas en el portal:
                            <span class="font-semibold">{{ $ofertasPublicadasCount }}</span>
                        </div>

                        <div class="mt-3 text-xs text-slate-500">
                            Tip: explora ofertas por sector y puesto para encontrar las que mejor encajan contigo.
                        </div>
                    </div>

                    <div class="mt-4 text-sm font-semibold text-[#0B4AA2]">
                        Ver ofertas →
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>