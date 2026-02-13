<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar oferta (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('admin.ofertas.update', $oferta) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Empresa --}}
                        <div class="md:col-span-2">
                            <x-label for="idempresa" value="Empresa" />
                            <select id="idempresa" name="idempresa"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Selecciona una empresa --</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}"
                                        @selected(old('idempresa', $oferta->idempresa) == $empresa->id)>
                                        {{ $empresa->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Título --}}
                        <div class="md:col-span-2">
                            <x-label for="titulo" value="Título" />
                            <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                                :value="old('titulo', $oferta->titulo)" required />
                        </div>

                        {{-- Sector --}}
                        <div>
                            <x-label for="idsector" value="Sector" />
                            <select id="idsector" name="idsector"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Selecciona un sector --</option>
                                @foreach ($sectores as $sector)
                                    <option value="{{ $sector->id }}"
                                        @selected(old('idsector', $oferta->idsector) == $sector->id)>
                                        {{ $sector->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Modalidad --}}
                        <div>
                            <x-label for="idmodalidad" value="Modalidad" />
                            <select id="idmodalidad" name="idmodalidad"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Selecciona una modalidad --</option>
                                @foreach ($modalidades as $modalidad)
                                    <option value="{{ $modalidad->id }}"
                                        @selected(old('idmodalidad', $oferta->idmodalidad) == $modalidad->id)>
                                        {{ $modalidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Puesto --}}
                        <div class="md:col-span-2">
                            <x-label for="idpuesto" value="Puesto" />
                            <select id="idpuesto" name="idpuesto"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Selecciona un puesto --</option>
                                @foreach ($puestos as $puesto)
                                    <option value="{{ $puesto->id }}"
                                        @selected(old('idpuesto', $oferta->idpuesto) == $puesto->id)>
                                        {{ $puesto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Ubicación --}}
                        <div class="md:col-span-2">
                            <x-label for="ubicacion" value="Ubicación" />
                            <x-input id="ubicacion" class="block mt-1 w-full" type="text" name="ubicacion"
                                :value="old('ubicacion', $oferta->ubicacion)" />
                        </div>

                        {{-- Tipo contrato --}}
                        <div>
                            <x-label for="tipo_contrato" value="Tipo de contrato" />
                            <x-input id="tipo_contrato" class="block mt-1 w-full" type="text" name="tipo_contrato"
                                :value="old('tipo_contrato', $oferta->tipo_contrato)" />
                        </div>

                        {{-- Jornada --}}
                        <div>
                            <x-label for="jornada" value="Jornada" />
                            <x-input id="jornada" class="block mt-1 w-full" type="text" name="jornada"
                                :value="old('jornada', $oferta->jornada)" />
                        </div>

                        {{-- Salario min --}}
                        <div>
                            <x-label for="salario_min" value="Salario mínimo (€)" />
                            <x-input id="salario_min" class="block mt-1 w-full" type="number" name="salario_min"
                                :value="old('salario_min', $oferta->salario_min)" min="0" step="0.01" />
                        </div>

                        {{-- Salario max --}}
                        <div>
                            <x-label for="salario_max" value="Salario máximo (€)" />
                            <x-input id="salario_max" class="block mt-1 w-full" type="number" name="salario_max"
                                :value="old('salario_max', $oferta->salario_max)" min="0" step="0.01" />
                        </div>

                        {{-- Fechas --}}
                        <div>
                            <x-label for="fecha_publicacion" value="Fecha de publicación" />
                            <x-input id="fecha_publicacion" class="block mt-1 w-full" type="date" name="fecha_publicacion"
                                :value="old('fecha_publicacion', $oferta->fecha_publicacion)" />
                        </div>

                        <div>
                            <x-label for="publicar_hasta" value="Publicar hasta" />
                            <x-input id="publicar_hasta" class="block mt-1 w-full" type="date" name="publicar_hasta"
                                :value="old('publicar_hasta', $oferta->publicar_hasta)" />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="fecha_incorporacion" value="Fecha de incorporación" />
                            <x-input id="fecha_incorporacion" class="block mt-1 w-full" type="date" name="fecha_incorporacion"
                                :value="old('fecha_incorporacion', $oferta->fecha_incorporacion)" />
                        </div>

                        {{-- Estado --}}
                        <div class="md:col-span-2">
                            <x-label for="estado" value="Estado" />
                            <select id="estado" name="estado"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach (['borrador','publicada','pausada','cerrada','vencida'] as $e)
                                    <option value="{{ $e }}" @selected(old('estado', $oferta->estado) == $e)>{{ $e }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Textos --}}
                        <div class="md:col-span-2">
                            <x-label for="descripcion" value="Descripción" />
                            <textarea id="descripcion" name="descripcion" rows="6"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>{{ old('descripcion', $oferta->descripcion) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="funciones" value="Funciones (opcional)" />
                            <textarea id="funciones" name="funciones" rows="4"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('funciones', $oferta->funciones) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="requisitos" value="Requisitos (opcional)" />
                            <textarea id="requisitos" name="requisitos" rows="4"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('requisitos', $oferta->requisitos) }}</textarea>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.ofertas.show', $oferta) }}"
                           class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
                            Cancelar
                        </a>

                        <x-button class="ms-4">
                            Guardar cambios
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
