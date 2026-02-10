<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear empresa') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('empresa.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- CIF --}}
                        <div>
                            <x-label for="cif" value="CIF" />
                            <x-input id="cif" class="block mt-1 w-full" type="text" name="cif"
                                :value="old('cif')" required />
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <x-label for="nombre" value="Nombre" />
                            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required />
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <x-label for="telefono" value="Teléfono" />
                            <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono"
                                :value="old('telefono')" />
                        </div>

                        {{-- Web --}}
                        <div>
                            <x-label for="web" value="Web" />
                            <x-input id="web" class="block mt-1 w-full" type="text" name="web"
                                :value="old('web')" placeholder="https://..." />
                        </div>

                        {{-- Persona de contacto --}}
                        <div>
                            <x-label for="persona_contacto" value="Persona de contacto" />
                            <x-input id="persona_contacto" class="block mt-1 w-full" type="text" name="persona_contacto"
                                :value="old('persona_contacto')" />
                        </div>

                        {{-- Email contacto --}}
                        <div>
                            <x-label for="email_contacto" value="Email de contacto" />
                            <x-input id="email_contacto" class="block mt-1 w-full" type="email" name="email_contacto"
                                :value="old('email_contacto')" />
                        </div>

                        {{-- Dirección --}}
                        <div class="md:col-span-2">
                            <x-label for="direccion" value="Dirección" />
                            <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                                :value="old('direccion')" />
                        </div>

                        {{-- CP --}}
                        <div>
                            <x-label for="cp" value="Código postal" />
                            <x-input id="cp" class="block mt-1 w-full" type="text" name="cp"
                                :value="old('cp')" />
                        </div>

                        {{-- Ciudad --}}
                        <div>
                            <x-label for="ciudad" value="Ciudad" />
                            <x-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                                :value="old('ciudad')" />
                        </div>

                        {{-- Provincia --}}
                        <div>
                            <x-label for="provincia" value="Provincia" />
                            <x-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                                :value="old('provincia')" />
                        </div>

                        {{-- Logo --}}
                        <div>
                            <x-label for="logo" value="Logo" />
                            <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" accept="image/*" />
                            <p class="text-sm text-gray-500 mt-1">PNG/JPG. Recomendado cuadrado.</p>
                        </div>

                        {{-- Sectores (en formato checkbox) --}}

                        <div class="md:col-span-2">
                            <x-label for="sector_ids" value="Sectores" class="font-bold" />

                                <p class="mt-1 text-sm text-gray-500">
                                    Selecciona el sector o sectores a los que pertenece la empresa.
                                </p>                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                @foreach ($sectores as $sector)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="sectores[]" value="{{ $sector->id }}"
                                            class="form-checkbox h-5 w-5 text-indigo-600">
                                        <span class="ml-2 text-gray-700">{{ $sector->nombre }}</span>
                                    </label>
                                @endforeach 

                    </div>  

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('empresa.dashboard') }}"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancelar
                        </a>

                        <x-button class="ms-4">
                            Guardar empresa
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
