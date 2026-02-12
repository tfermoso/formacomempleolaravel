<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis candidaturas') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                @if ($ofertas->isEmpty())
                    <p class="text-gray-600">Aún no estás inscrito en ninguna oferta.</p>
                @else
                    <div class="divide-y">
                        @foreach ($ofertas as $oferta)
                            <!-- Elemento a por cada oferta con link para ver la oferta en detalle-->
                            <a href="{{ route('candidato.ofertas.show', $oferta) }}" class="block">
                                <div class="py-5 flex items-start justify-between gap-4">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $oferta->titulo }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                            @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">
                                            Inscrito: {{ optional($oferta->pivot->fecha_inscripcion)->format('d/m/Y H:i') }}
                                        </div>

                                        <div class="mt-2">
                                            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                                Estado: {{ $oferta->pivot->estado }}
                                            </span>
                                        </div>

                                        @if($oferta->pivot->comentarios)
                                            <p class="mt-2 text-sm text-gray-700">
                                                <span class="font-semibold">Comentarios:</span> {{ $oferta->pivot->comentarios }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Opcional: retirar candidatura --}}
                                    <form method="POST" action="{{ route('candidato.ofertas.retirar', $oferta) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-sm text-red-600 underline hover:text-red-800">
                                            Retirar
                                        </button>
                                    </form>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $ofertas->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>