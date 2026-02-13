<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle candidato</h2>

            <div class="flex gap-2">
                <a href="{{ route('admin.candidatos.index') }}"
                    class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                    Volver
                </a>

                <a href="{{ route('admin.candidatos.edit', $candidato) }}"
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
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ $candidato->nombre }} {{ $candidato->apellidos }}
                        </h1>
                        <div class="text-sm text-gray-600 mt-1">
                            DNI: <strong>{{ $candidato->dni ?? '—' }}</strong>
                        </div>
                    </div>

                    @if($candidato->foto)
                        <img src="{{ asset('storage/'.$candidato->foto) }}" class="h-16 w-16 rounded-full object-cover border" alt="foto">
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div><strong>Email:</strong> {{ $candidato->email ?? '—' }}</div>
                    <div><strong>Teléfono:</strong> {{ $candidato->telefono ?? '—' }}</div>
                    <div><strong>LinkedIn:</strong> {{ $candidato->linkedin ?? '—' }}</div>
                    <div><strong>Web:</strong> {{ $candidato->web ?? '—' }}</div>
                    <div><strong>Fecha nacimiento:</strong> {{ $candidato->fecha_nacimiento ? \Carbon\Carbon::parse($candidato->fecha_nacimiento)->format('d/m/Y') : '—' }}</div>
                    <div><strong>Ciudad:</strong> {{ $candidato->ciudad ?? '—' }}</div>
                    <div class="md:col-span-2"><strong>Dirección:</strong> {{ $candidato->direccion ?? '—' }}</div>
                    <div><strong>CP:</strong> {{ $candidato->cp ?? '—' }}</div>
                    <div><strong>Provincia:</strong> {{ $candidato->provincia ?? '—' }}</div>
                </div>

                <div class="pt-2">
                    <h3 class="font-semibold text-gray-900">Archivos</h3>
                    <div class="mt-2 flex flex-col gap-2 text-sm">
                        <div>
                            <strong>CV:</strong>
                            @if($candidato->cv)
                                <a class="text-indigo-600 underline" target="_blank" href="{{ asset('storage/'.$candidato->cv) }}">Ver/Descargar</a>
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t">
                    <form method="POST" action="{{ route('admin.candidatos.destroy', $candidato) }}"
                          onsubmit="return confirm('¿Eliminar candidato?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Eliminar candidato</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
