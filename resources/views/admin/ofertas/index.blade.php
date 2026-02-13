<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ofertas</h2>

      <a href="{{ route('admin.ofertas.create') }}"
         class="px-4 py-2 rounded bg-slate-900 text-white hover:bg-slate-800">
        Nueva oferta
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
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
          <input name="q" value="{{ $q }}" class="border rounded px-3 py-2"
                 placeholder="Buscar por título o ubicación...">

          <select name="estado" class="border rounded px-3 py-2">
            <option value="">-- Estado (todos) --</option>
            @foreach (['borrador','publicada','pausada','cerrada','vencida'] as $e)
              <option value="{{ $e }}" @selected($estado === $e)>{{ $e }}</option>
            @endforeach
          </select>

          <select name="empresa_id" class="border rounded px-3 py-2">
            <option value="">-- Empresa (todas) --</option>
            @foreach($empresas as $emp)
              <option value="{{ $emp->id }}" @selected((string)$empresaId === (string)$emp->id)>{{ $emp->nombre }}</option>
            @endforeach
          </select>

          <div class="flex gap-2">
            <button class="px-4 py-2 rounded bg-gray-900 text-white w-full">Filtrar</button>
            <a href="{{ route('admin.ofertas.index') }}" class="px-4 py-2 rounded border w-full text-center">Limpiar</a>
          </div>
        </form>
      </div>

      <div class="bg-white rounded border overflow-x-auto">
        <table class="min-w-full divide-y">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Título</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Empresa</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Estado</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Candidatos</th>
              <th class="px-4 py-3 text-left text-xs uppercase text-gray-500">Publicación</th>
              <th class="px-4 py-3 text-right text-xs uppercase text-gray-500">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y">
            @forelse($ofertas as $oferta)
              <tr>
                <td class="px-4 py-3">
                  <div class="font-medium text-gray-900">{{ $oferta->titulo }}</div>
                  <div class="text-xs text-gray-500">{{ $oferta->ubicacion ?? '—' }}</div>
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $oferta->empresa->nombre ?? '—' }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $oferta->estado }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $oferta->candidatos_count ?? 0 }}</td>
                <td class="px-4 py-3 text-sm text-gray-700">
                  {{ $oferta->fecha_publicacion ? \Carbon\Carbon::parse($oferta->fecha_publicacion)->format('d/m/Y') : '—' }}
                </td>

                <td class="px-4 py-3 text-right whitespace-nowrap text-sm">
                  <a class="text-indigo-600" href="{{ route('admin.ofertas.show', $oferta) }}">Ver</a>
                  <span class="mx-2 text-gray-300">|</span>
                  <a class="text-indigo-600" href="{{ route('admin.ofertas.edit', $oferta) }}">Editar</a>
                  <span class="mx-2 text-gray-300">|</span>

                  <form class="inline" method="POST" action="{{ route('admin.ofertas.destroy', $oferta) }}"
                        onsubmit="return confirm('¿Eliminar oferta?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="px-4 py-4 text-gray-600">No hay ofertas.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{ $ofertas->links() }}
    </div>
  </div>
</x-app-layout>
