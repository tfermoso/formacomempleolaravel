<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de oferta</h2>

            <div class="flex gap-2">
                <a href="{{ route('admin.ofertas.index') }}"
                    class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                    Volver
                </a>

                <a href="{{ route('admin.ofertas.edit', $oferta) }}"
                    class="inline-flex items-center px-4 py-2 rounded-md bg-yellow-500 text-white hover:bg-yellow-600">
                    Editar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-3 rounded bg-green-50 text-green-700 border border-green-200">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $oferta->titulo }}</h1>

                <div class="mt-3 flex flex-wrap gap-2 text-sm">
                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                        Estado: <strong>{{ $oferta->estado }}</strong>
                    </span>
                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                        Empresa: <strong>{{ $oferta->empresa->nombre ?? '—' }}</strong>
                    </span>
                    @if($oferta->ubicacion)
                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                            Ubicación: <strong>{{ $oferta->ubicacion }}</strong>
                        </span>
                    @endif
                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                        Candidatos: <strong>{{ $oferta->candidatos_count ?? 0 }}</strong>
                    </span>
                </div>

                <div class="mt-4 text-sm text-gray-600 space-y-1">
                    <div>Sector: <strong>{{ $oferta->sector->nombre ?? '—' }}</strong></div>
                    <div>Modalidad: <strong>{{ $oferta->modalidad->nombre ?? '—' }}</strong></div>
                    <div>Puesto: <strong>{{ $oferta->puesto->nombre ?? '—' }}</strong></div>

                    <div>
                        Salario:
                        <strong>
                            {{ $oferta->salario_min ? number_format($oferta->salario_min, 2, ',', '.') . '€' : '—' }}
                            -
                            {{ $oferta->salario_max ? number_format($oferta->salario_max, 2, ',', '.') . '€' : '—' }}
                        </strong>
                    </div>

                    <div>Publicación:
                        <strong>{{ $oferta->fecha_publicacion ? \Carbon\Carbon::parse($oferta->fecha_publicacion)->format('d/m/Y') : '—' }}</strong>
                    </div>
                    <div>Visible hasta:
                        <strong>{{ $oferta->publicar_hasta ? \Carbon\Carbon::parse($oferta->publicar_hasta)->format('d/m/Y') : '—' }}</strong>
                    </div>
                    <div>Incorporación:
                        <strong>{{ $oferta->fecha_incorporacion ? \Carbon\Carbon::parse($oferta->fecha_incorporacion)->format('d/m/Y') : '—' }}</strong>
                    </div>
                </div>

                <div class="mt-6 space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-900">Descripción</h3>
                        <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->descripcion }}</div>
                    </div>

                    @if($oferta->funciones)
                        <div>
                            <h3 class="font-semibold text-gray-900">Funciones</h3>
                            <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->funciones }}</div>
                        </div>
                    @endif

                    @if($oferta->requisitos)
                        <div>
                            <h3 class="font-semibold text-gray-900">Requisitos</h3>
                            <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->requisitos }}</div>
                        </div>
                    @endif
                </div>

                <div class="pt-4 mt-6 border-t">
                    <form method="POST" action="{{ route('admin.ofertas.destroy', $oferta) }}"
                          onsubmit="return confirm('¿Eliminar oferta?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Eliminar oferta</button>
                    </form>
                </div>
            </div>

            {{-- CANDIDATOS --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    Candidatos ({{ $candidatos->count() }})
                </h2>

                @if($candidatos->count() === 0)
                    <div class="mt-4 text-gray-600">No hay candidatos todavía para esta oferta.</div>
                @else
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Inscripción</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($candidatos as $cand)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            {{ $cand->nombre }} {{ $cand->apellidos }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $cand->email ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $cand->pivot->estado ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $cand->pivot->fecha_inscripcion ? \Carbon\Carbon::parse($cand->pivot->fecha_inscripcion)->format('d/m/Y') : '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
