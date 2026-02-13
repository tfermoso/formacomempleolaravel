<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Candidatos</h2>

      <a href="{{ route('admin.candidatos.create') }}"
         class="px-4 py-2 rounded bg-slate-900 text-white hover:bg-slate-800">
        Nuevo candidato
      </a>
    </div>
  </x-slot>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

      @if(session('success'))
        <div class="p-3 rounded bg-green-50 text-green-700 border border-green-200">
          {{ session('success') }}
        </div>
      @endif

      <div class="bg-white p-4 rounded border">
        <form method="GET" class="flex gap-2">
          <input
            name="q"
            value="{{ $q }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Buscar por nombre, apellidos, email, DNI, teléfono o ciudad..."
          >
          <button class="px-4 py-2 rounded bg-gray-900 text-white">Buscar</button>
        </form>
      </div>

      <div class="bg-white rounded border overflow-x-auto">
        <table class="min-w-full divide-y">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Candidato</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">DNI</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Email</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Teléfono</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Ciudad</th>
              <th class="px-4 py-3 text-right text-xs uppercase text-gray-500">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y">
            @forelse($candidatos as $candidato)
              <tr>
                <td class="px-4 py-3">
                  <div class="flex items-center gap-3">
                    @if($candidato->foto)
                      <img
                        src="{{ asset('storage/'.$candidato->foto) }}"
                        class="h-10 w-10 rounded-full object-cover border"
                        alt="foto"
                      >
                    @else
                      <div class="h-10 w-10 rounded-full border bg-gray-50"></div>
                    @endif

                    <div>
                      <div class="text-sm text-gray-900 font-medium">
                        {{ $candidato->nombre }} {{ $candidato->apellidos }}
                      </div>
                      <div class="text-xs text-gray-500">
                        ID: {{ $candidato->id }}
                      </div>
                    </div>
                  </div>
                </td>

                <td class="px-4 py-3 text-sm text-gray-700">{{ $candidato->dni ?? '—' }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $candidato->email ?? '—' }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $candidato->telefono ?? '—' }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $candidato->ciudad ?? '—' }}</td>

                <td class="px-4 py-3 text-right whitespace-nowrap text-sm">
                  <a class="text-indigo-600" href="{{ route('admin.candidatos.show', $candidato) }}">Ver</a>
                  <span class="mx-2 text-gray-300">|</span>
                  <a class="text-indigo-600" href="{{ route('admin.candidatos.edit', $candidato) }}">Editar</a>
                  <span class="mx-2 text-gray-300">|</span>

                  <form class="inline" method="POST"
                        action="{{ route('admin.candidatos.destroy', $candidato) }}"
                        onsubmit="return confirm('¿Eliminar candidato?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-4 py-4 text-gray-600">No hay candidatos.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{ $candidatos->links() }}
    </div>
  </div>
</x-app-layout>
