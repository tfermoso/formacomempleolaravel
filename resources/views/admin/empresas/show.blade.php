<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle empresa</h2>

            <div class="flex gap-2">
                <a href="{{ route('admin.empresas.index') }}"
                    class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                    Volver
                </a>

                <a href="{{ route('admin.empresas.edit', $empresa) }}"
                    class="inline-flex items-center px-4 py-2 rounded-md bg-yellow-500 text-white hover:bg-yellow-600">
                    Editar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="p-3 rounded bg-green-50 text-green-700 border border-green-200">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-4">

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $empresa->nombre }}</h1>
                        <div class="text-sm text-gray-600 mt-1">CIF: <strong>{{ $empresa->cif }}</strong></div>
                    </div>

                    @if($empresa->logo)
                        <img src="{{ asset('storage/'.$empresa->logo) }}" class="h-16 w-16 rounded-full object-cover border" alt="logo">
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div><strong>Teléfono:</strong> {{ $empresa->telefono ?? '—' }}</div>
                    <div><strong>Web:</strong> {{ $empresa->web ?? '—' }}</div>
                    <div><strong>Persona contacto:</strong> {{ $empresa->persona_contacto ?? '—' }}</div>
                    <div><strong>Email contacto:</strong> {{ $empresa->email_contacto ?? '—' }}</div>
                    <div class="md:col-span-2"><strong>Dirección:</strong> {{ $empresa->direccion ?? '—' }}</div>
                    <div><strong>CP:</strong> {{ $empresa->cp ?? '—' }}</div>
                    <div><strong>Ciudad:</strong> {{ $empresa->ciudad ?? '—' }}</div>
                    <div><strong>Provincia:</strong> {{ $empresa->provincia ?? '—' }}</div>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900">Sectores</h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @forelse($empresa->sectores as $sector)
                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 text-sm">
                                {{ $sector->nombre }}
                            </span>
                        @empty
                            <span class="text-gray-500 text-sm">Sin sectores asignados</span>
                        @endforelse
                    </div>
                </div>

                <div class="pt-4 border-t">
                    <form method="POST" action="{{ route('admin.empresas.destroy', $empresa) }}"
                          onsubmit="return confirm('¿Eliminar empresa?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Eliminar empresa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
