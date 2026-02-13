<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Empresas</h2>
      <a href="{{ route('admin.empresas.create') }}"
         class="px-4 py-2 rounded bg-slate-900 text-white hover:bg-slate-800">
        Nueva empresa
      </a>
    </div>
  </x-slot>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

      @if(session('success'))
        <div class="p-3 rounded bg-green-50 text-green-700 border border-green-200">{{ session('success') }}</div>
      @endif

      <div class="bg-white p-4 rounded border">
        <form method="GET" class="flex gap-2">
          <input name="q" value="{{ $q }}" class="w-full border rounded px-3 py-2"
                 placeholder="Buscar por nombre, CIF, email contacto o ciudad...">
          <button class="px-4 py-2 rounded bg-gray-900 text-white">Buscar</button>
        </form>
      </div>

      <div class="bg-white rounded border overflow-x-auto">
        <table class="min-w-full divide-y">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Nombre</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">CIF</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Email contacto</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Ciudad</th>
              <th class="px-4 py-3 text-right text-xs uppercase text-gray-500">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            @forelse($empresas as $empresa)
              <tr>
                <td class="px-4 py-3">{{ $empresa->nombre ?? '—' }}</td>
                <td class="px-4 py-3">{{ $empresa->cif ?? '—' }}</td>
                <td class="px-4 py-3">{{ $empresa->email_contacto ?? '—' }}</td>
                <td class="px-4 py-3">{{ $empresa->ciudad ?? '—' }}</td>

                <td class="px-4 py-3 text-right whitespace-nowrap">
                  <a class="text-indigo-600" href="{{ route('admin.empresas.show', $empresa) }}">Ver</a>
                  <span class="mx-2 text-gray-300">|</span>
                  <a class="text-indigo-600" href="{{ route('admin.empresas.edit', $empresa) }}">Editar</a>
                  <span class="mx-2 text-gray-300">|</span>
                  <form class="inline" method="POST" action="{{ route('admin.empresas.destroy', $empresa) }}"
                        onsubmit="return confirm('¿Eliminar empresa?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-4 py-4 text-gray-600">No hay empresas.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{ $empresas->links() }}
    </div>
  </div>
</x-app-layout>
