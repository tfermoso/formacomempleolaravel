<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar candidato (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('admin.candidatos.update', $candidato) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-label for="dni" value="DNI (opcional)" />
                            <x-input id="dni" class="block mt-1 w-full" type="text" name="dni"
                                :value="old('dni', $candidato->dni)" />
                        </div>

                        <div>
                            <x-label for="telefono" value="Teléfono (opcional)" />
                            <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono"
                                :value="old('telefono', $candidato->telefono)" />
                        </div>

                        <div>
                            <x-label for="nombre" value="Nombre" />
                            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre', $candidato->nombre)" required />
                        </div>

                        <div>
                            <x-label for="apellidos" value="Apellidos" />
                            <x-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos"
                                :value="old('apellidos', $candidato->apellidos)" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="email" value="Email (opcional)" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $candidato->email)" />
                        </div>

                        <div>
                            <x-label for="linkedin" value="LinkedIn (opcional)" />
                            <x-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin"
                                :value="old('linkedin', $candidato->linkedin)" />
                        </div>

                        <div>
                            <x-label for="web" value="Web (opcional)" />
                            <x-input id="web" class="block mt-1 w-full" type="text" name="web"
                                :value="old('web', $candidato->web)" />
                        </div>

                        <div>
                            <x-label for="fecha_nacimiento" value="Fecha de nacimiento (opcional)" />
                            <x-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento"
                                :value="old('fecha_nacimiento', $candidato->fecha_nacimiento?->format('Y-m-d'))" />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="foto" value="Foto (subir para reemplazar)" />
                            <x-input id="foto" class="block mt-1 w-full" type="file" name="foto" accept="image/*" />

                            @if($candidato->foto)
                                <div class="mt-3 flex items-center gap-3">
                                    <img src="{{ asset('storage/'.$candidato->foto) }}" class="h-14 w-14 rounded-full object-cover border" alt="foto">
                                    <label class="flex items-center gap-2 text-sm text-gray-700">
                                        <input type="checkbox" name="remove_foto" value="1">
                                        Quitar foto actual
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="cv" value="CV (subir para reemplazar)" />
                            <x-input id="cv" class="block mt-1 w-full" type="file" name="cv" accept=".pdf,.doc,.docx" />

                            @if($candidato->cv)
                                <div class="mt-3 flex items-center gap-3">
                                    <a class="text-indigo-600 underline" target="_blank"
                                       href="{{ asset('storage/'.$candidato->cv) }}">
                                        Ver CV actual
                                    </a>
                                    <label class="flex items-center gap-2 text-sm text-gray-700">
                                        <input type="checkbox" name="remove_cv" value="1">
                                        Quitar CV
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="direccion" value="Dirección (opcional)" />
                            <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                                :value="old('direccion', $candidato->direccion)" />
                        </div>

                        <div>
                            <x-label for="cp" value="Código postal (opcional)" />
                            <x-input id="cp" class="block mt-1 w-full" type="text" name="cp"
                                :value="old('cp', $candidato->cp)" />
                        </div>

                        <div>
                            <x-label for="ciudad" value="Ciudad (opcional)" />
                            <x-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                                :value="old('ciudad', $candidato->ciudad)" />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="provincia" value="Provincia (opcional)" />
                            <x-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                                :value="old('provincia', $candidato->provincia)" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.candidatos.show', $candidato) }}"
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
