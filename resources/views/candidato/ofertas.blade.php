<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buscar ofertas') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <form method="GET" action="{{ route('candidato.ofertas') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <x-label for="texto" value="Buscar" />
                        <x-input id="texto" class="block mt-1 w-full" type="text" name="texto"
                            :value="request('texto')" placeholder="Título, descripción, ubicación..." />
                    </div>

                    <div>
                        <x-label for="sector_id" value="Sector" />
                        <x-input id="sector_id" class="block mt-1 w-full" type="text" name="sector_id"
                            :value="request('sector_id')" placeholder="(opcional)" />
                        {{-- si luego quieres select real, lo cambiamos --}}
                    </div>

                    <div class="flex items-end">
                        <x-button class="w-full justify-center">
                            Filtrar
                        </x-button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                @if ($ofertas->isEmpty())
                    <p class="text-gray-600">No hay ofertas con esos filtros.</p>
                @else
                    <div class="divide-y">
                        @foreach ($ofertas as $oferta)
                            <a href="{{ route('candidato.ofertas.show', $oferta) }}" class="block">

                            <div class="py-5 flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="font-semibold text-gray-900">{{ $oferta->titulo }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $oferta->empresa->nombre ?? 'Empresa' }}
                                        @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Estado oferta: {{ $oferta->estado }}
                                        @if($oferta->fecha_publicacion) · Publicada: {{ $oferta->fecha_publicacion->format('d/m/Y') }} @endif
                                    </div>

                                    <p class="mt-2 text-sm text-gray-700 line-clamp-3">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($oferta->descripcion), 200) }}
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('candidato.ofertas.inscribirse', $oferta) }}">
                                    @csrf
                                    <x-button>
                                        Inscribirme
                                    </x-button>
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
