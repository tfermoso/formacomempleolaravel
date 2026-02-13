<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear candidato (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('admin.candidatos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-label for="dni" value="DNI (opcional)" />
                            <x-input id="dni" class="block mt-1 w-full" type="text" name="dni"
                                :value="old('dni')" />
                        </div>

                        <div>
                            <x-label for="telefono" value="Teléfono (opcional)" />
                            <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono"
                                :value="old('telefono')" />
                        </div>

                        <div>
                            <x-label for="nombre" value="Nombre" />
                            <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required />
                        </div>

                        <div>
                            <x-label for="apellidos" value="Apellidos" />
                            <x-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos"
                                :value="old('apellidos')" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="email" value="Email (opcional)" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" />
                        </div>

                        <div>
                            <x-label for="linkedin" value="LinkedIn (opcional)" />
                            <x-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin"
                                :value="old('linkedin')" placeholder="https://linkedin.com/in/..." />
                        </div>

                        <div>
                            <x-label for="web" value="Web (opcional)" />
                            <x-input id="web" class="block mt-1 w-full" type="text" name="web"
                                :value="old('web')" placeholder="https://..." />
                        </div>

                        <div>
                            <x-label for="fecha_nacimiento" value="Fecha de nacimiento (opcional)" />
                            <x-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento"
                                :value="old('fecha_nacimiento')" />
                        </div>

                        <div>
                            <x-label for="foto" value="Foto (opcional)" />
                            <x-input id="foto" class="block mt-1 w-full" type="file" name="foto" accept="image/*" />
                            <p class="text-sm text-gray-500 mt-1">JPG/PNG/WebP.</p>
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="cv" value="CV (opcional)" />
                            <x-input id="cv" class="block mt-1 w-full" type="file" name="cv" accept=".pdf,.doc,.docx" />
                            <p class="text-sm text-gray-500 mt-1">PDF/DOC/DOCX.</p>
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="direccion" value="Dirección (opcional)" />
                            <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                                :value="old('direccion')" />
                        </div>

                        <div>
                            <x-label for="cp" value="Código postal (opcional)" />
                            <x-input id="cp" class="block mt-1 w-full" type="text" name="cp"
                                :value="old('cp')" />
                        </div>

                        <div>
                            <x-label for="ciudad" value="Ciudad (opcional)" />
                            <x-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                                :value="old('ciudad')" />
                        </div>

                        <div class="md:col-span-2">
                            <x-label for="provincia" value="Provincia (opcional)" />
                            <x-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                                :value="old('provincia')" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.candidatos.index') }}"
                           class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
                            Cancelar
                        </a>

                        <x-button class="ms-4">
                            Guardar candidato
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
