<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de oferta') }}
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('empresa.dashboard') }}"
                    class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                    Volver
                </a>

                @php
                    $hayCv = collect($candidatos)->contains(fn($c) => !empty($c->cv));
                @endphp

                @if($hayCv)
                    <a href="{{ route('empresa.ofertas.cvs.zip', $oferta->id) }}"
                        class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                        Descargar todos los CV
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- OFERTA --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $oferta->titulo }}</h1>
                <!--Opcion de Editar Oferta-->
                <div class="mt-2">
                    <a href="{{ route('empresa.editOferta', $oferta) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded-md bg-yellow-500 text-white hover:bg-yellow-600">
                        Editar oferta
                    </a>

                    <div class="mt-3 flex flex-wrap gap-2 text-sm">
                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                            Estado: <strong>{{ $oferta->estado }}</strong>
                        </span>

                        @if(!empty($oferta->ubicacion))
                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                                Ubicación: <strong>{{ $oferta->ubicacion }}</strong>
                            </span>
                        @endif

                        @if(!empty($oferta->tipo_contrato))
                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                                Contrato: <strong>{{ $oferta->tipo_contrato }}</strong>
                            </span>
                        @endif

                        @if(!empty($oferta->jornada))
                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                                Jornada: <strong>{{ $oferta->jornada }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 text-sm text-gray-600 space-y-1">
                        @if(isset($oferta->sector) && !empty($oferta->sector->nombre))
                            <div>Sector: <strong>{{ $oferta->sector->nombre }}</strong></div>
                        @endif
                        @if(isset($oferta->modalidad) && !empty($oferta->modalidad->nombre))
                            <div>Modalidad: <strong>{{ $oferta->modalidad->nombre }}</strong></div>
                        @endif
                        @if(isset($oferta->puesto) && !empty($oferta->puesto->nombre))
                            <div>Puesto: <strong>{{ $oferta->puesto->nombre }}</strong></div>
                        @endif

                        @if(!empty($oferta->salario_min) || !empty($oferta->salario_max))
                            <div>
                                Salario:
                                <strong>
                                    {{ $oferta->salario_min ? number_format($oferta->salario_min, 2, ',', '.') . '€' : '—' }}
                                    -
                                    {{ $oferta->salario_max ? number_format($oferta->salario_max, 2, ',', '.') . '€' : '—' }}
                                </strong>
                            </div>
                        @endif

                        @if(!empty($oferta->fecha_publicacion))
                            <div>Publicación:
                                <strong>{{ \Carbon\Carbon::parse($oferta->fecha_publicacion)->format('d/m/Y') }}</strong>
                            </div>
                        @endif
                        @if(!empty($oferta->publicar_hasta))
                            <div>Visible hasta:
                                <strong>{{ \Carbon\Carbon::parse($oferta->publicar_hasta)->format('d/m/Y') }}</strong>
                            </div>
                        @endif
                        @if(!empty($oferta->fecha_incorporacion))
                            <div>Incorporación:
                                <strong>{{ \Carbon\Carbon::parse($oferta->fecha_incorporacion)->format('d/m/Y') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 space-y-6">
                        <div>
                            <h3 class="font-semibold text-gray-900">Descripción</h3>
                            <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->descripcion }}</div>
                        </div>

                        @if(!empty($oferta->funciones))
                            <div>
                                <h3 class="font-semibold text-gray-900">Funciones</h3>
                                <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->funciones }}</div>
                            </div>
                        @endif

                        @if(!empty($oferta->requisitos))
                            <div>
                                <h3 class="font-semibold text-gray-900">Requisitos</h3>
                                <div class="mt-2 text-gray-700 whitespace-pre-line">{{ $oferta->requisitos }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- CANDIDATOS --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Candidatos ({{ count($candidatos) }})
                        </h2>
                    </div>

                    @if(count($candidatos) === 0)
                        <div class="mt-4 text-gray-600">
                            No hay candidatos todavía para esta oferta.
                        </div>
                    @else
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado
                                        </th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">CV</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($candidatos as $candidato)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                {{ $candidato->nombre }} {{ $candidato->apellidos }}
                                                <div class="text-xs text-gray-500">{{ $candidato->email }}</div>
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $candidato->telefono ?? '—' }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                <span class="estado-texto">{{ $candidato->pivot->estado ?? '—' }}</span>

                                                <div class="mt-2" data-oferta-id="{{ $oferta->id }}">
                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="revisado">
                                                        <i class="fas fa-eye" title="Marcar como revisado"></i>
                                                    </button>

                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="preseleccionado">
                                                        <i class="fas fa-check" title="Marcar como preseleccionado"></i>
                                                    </button>

                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="descartado">
                                                        <i class="fas fa-times" title="Marcar como descartado"></i>
                                                    </button>

                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="entrevista">
                                                        <i class="fas fa-calendar-alt" title="Marcar como entrevista"></i>
                                                    </button>

                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="finalista">
                                                        <i class="fas fa-star" title="Marcar como finalista"></i>
                                                    </button>

                                                    <button type="button" class="actualizar-estado"
                                                        data-candidato-id="{{ $candidato->id }}" data-estado="contratado">
                                                        <i class="fas fa-user-check" title="Marcar como contratado"></i>
                                                    </button>
                                                </div>
                                            </td>


                                            <td class="px-4 py-3 text-sm text-right">
                                                @if(!empty($candidato->cv))
                                                    <a href="{{ route('empresa.candidatos.cv.download', $candidato->id) }}"
                                                        class="inline-flex items-center px-3 py-1.5 rounded-md text-white bg-gray-900 hover:bg-gray-800">
                                                        Descargar
                                                    </a>
                                                @else
                                                    <span class="text-gray-400">Sin CV</span>
                                                @endif
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