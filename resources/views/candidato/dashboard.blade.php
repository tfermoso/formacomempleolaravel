<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard candidato') }}
            </h2>

            <div class="flex gap-3">
                <a href="{{ route('candidato.ofertas') }}"
                   class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm hover:bg-indigo-700">
                    Buscar ofertas
                </a>
                <a href="{{ route('candidato.edit') }}"
                   class="px-4 py-2 rounded-md bg-gray-100 text-gray-800 text-sm hover:bg-gray-200">
                    Editar perfil
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Mis últimas candidaturas</h3>
                    <a href="{{ route('candidato.candidaturas') }}" class="text-sm underline text-indigo-600">
                        Ver todas
                    </a>
                </div>

                @if ($candidaturas->isEmpty())
                    <p class="mt-4 text-gray-600">Aún no estás inscrito en ninguna oferta.</p>
                @else
                    <div class="mt-4 divide-y">
                        @foreach ($candidaturas as $oferta)
                            <div class="py-4 flex items-start justify-between gap-4">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $oferta->titulo }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                        @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Inscrito: {{ optional($oferta->pivot->fecha_inscripcion)->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                    Estado: {{ $oferta->pivot->estado }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
