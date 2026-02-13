<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar empresa (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('admin.empresas.update', $empresa) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- CIF --}}
                        <div>
                            <x-label for="cif" value="CIF" />
                            <x-input id="cif" class="block mt-1 w-full" type="text" name="cif"
                                :value="old('cif', $empresa->cif)" required />
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <x-label for="nombre" value="Nombre" />
                            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre', $empresa->nombre)" required />
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <x-label for="telefono" value="Teléfono" />
                            <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono"
                                :value="old('telefono', $empresa->telefono)" />
                        </div>

                        {{-- Web --}}
                        <div>
                            <x-label for="web" value="Web" />
                            <x-input id="web" class="block mt-1 w-full" type="text" name="web"
                                :value="old('web', $empresa->web)" placeholder="https://..." />
                        </div>

                        {{-- Persona de contacto --}}
                        <div>
                            <x-label for="persona_contacto" value="Persona de contacto" />
                            <x-input id="persona_contacto" class="block mt-1 w-full" type="text" name="persona_contacto"
                                :value="old('persona_contacto', $empresa->persona_contacto)" />
                        </div>

                        {{-- Email contacto --}}
                        <div>
                            <x-label for="email_contacto" value="Email de contacto" />
                            <x-input id="email_contacto" class="block mt-1 w-full" type="email" name="email_contacto"
                                :value="old('email_contacto', $empresa->email_contacto)" />
                        </div>

                        {{-- Dirección --}}
                        <div class="md:col-span-2">
                            <x-label for="direccion" value="Dirección" />
                            <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                                :value="old('direccion', $empresa->direccion)" />
                        </div>

                        {{-- CP --}}
                        <div>
                            <x-label for="cp" value="Código postal" />
                            <x-input id="cp" class="block mt-1 w-full" type="text" name="cp"
                                :value="old('cp', $empresa->cp)" />
                        </div>

                        {{-- Ciudad --}}
                        <div>
                            <x-label for="ciudad" value="Ciudad" />
                            <x-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                                :value="old('ciudad', $empresa->ciudad)" />
                        </div>

                        {{-- Provincia --}}
                        <div>
                            <x-label for="provincia" value="Provincia" />
                            <x-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                                :value="old('provincia', $empresa->provincia)" />
                        </div>

                        {{-- Logo --}}
                        <div class="md:col-span-2">
                            <x-label for="logo" value="Logo (subir para reemplazar)" />
                            <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" accept="image/*" />

                            @if($empresa->logo)
                                <div class="mt-3 flex items-center gap-3">
                                    <img src="{{ asset('storage/'.$empresa->logo) }}" class="h-14 w-14 rounded-full object-cover border" alt="logo">
                                    <label class="flex items-center gap-2 text-sm text-gray-700">
                                        <input type="checkbox" name="remove_logo" value="1">
                                        Quitar logo actual
                                    </label>
                                </div>
                            @endif
                        </div>

                        {{-- Sectores --}}
                        <div class="md:col-span-2">
                            <x-label value="Sectores" class="font-bold" />
                            <p class="mt-1 text-sm text-gray-500">
                                Selecciona el sector o sectores a los que pertenece la empresa.
                            </p>

                            @php
                                $oldSectores = old('sectores', $selectedSectores ?? []);
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                @foreach ($sectores as $sector)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="sectores[]" value="{{ $sector->id }}"
                                            class="form-checkbox h-5 w-5 text-indigo-600"
                                            {{ in_array($sector->id, $oldSectores) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">{{ $sector->nombre }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.empresas.show', $empresa) }}"
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
