<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de administración
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- CARDS RESUMEN --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('admin.empresas.index') }}"
                   class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition rounded-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Empresas</h3>
                            <p class="text-sm text-slate-600 mt-1">Total registradas</p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ $empresasCount }}</div>
                    </div>
                    <div class="mt-4 text-sm text-indigo-600 font-medium">Ver todas →</div>
                </a>

                <a href="{{ route('admin.candidatos.index') }}"
                   class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition rounded-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Candidatos</h3>
                            <p class="text-sm text-slate-600 mt-1">Total registrados</p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ $candidatosCount }}</div>
                    </div>
                    <div class="mt-4 text-sm text-indigo-600 font-medium">Ver todos →</div>
                </a>

                <a href="{{ route('admin.ofertas.index') }}"
                   class="block bg-white border border-slate-200 shadow-sm p-6 hover:bg-slate-50 transition rounded-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Ofertas</h3>
                            <p class="text-sm text-slate-600 mt-1">Total publicadas</p>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ $ofertasCount }}</div>
                    </div>
                    <div class="mt-4 text-sm text-indigo-600 font-medium">Ver todas →</div>
                </a>
            </div>

            {{-- ÚLTIMAS EMPRESAS --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Últimas empresas dadas de alta</h3>
                        <p class="text-sm text-slate-600">Mostrando las 3 más recientes</p>
                    </div>
                    <a href="{{ route('admin.empresas.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md bg-slate-900 text-white hover:bg-slate-800">
                        Ver todas
                    </a>
                </div>

                <div class="px-6 pb-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Alta</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($ultimasEmpresas as $empresa)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $empresa->nombre ?? $empresa->razon_social ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $empresa->email ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right text-gray-700">
                                    {{ optional($empresa->created_at)->format('d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-sm text-gray-600">No hay empresas.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ÚLTIMOS CANDIDATOS --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Últimos candidatos dados de alta</h3>
                        <p class="text-sm text-slate-600">Mostrando los 3 más recientes</p>
                    </div>
                    <a href="{{ route('admin.candidatos.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md bg-slate-900 text-white hover:bg-slate-800">
                        Ver todos
                    </a>
                </div>

                <div class="px-6 pb-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Alta</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($ultimosCandidatos as $candidato)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $candidato->nombre }} {{ $candidato->apellidos }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $candidato->email ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right text-gray-700">
                                    {{ optional($candidato->created_at)->format('d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-sm text-gray-600">No hay candidatos.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ÚLTIMAS OFERTAS + Nº CANDIDATOS --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Últimas ofertas publicadas</h3>
                        <p class="text-sm text-slate-600">Incluye número de candidatos inscritos</p>
                    </div>
                    <a href="{{ route('admin.ofertas.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md bg-slate-900 text-white hover:bg-slate-800">
                        Ver todas
                    </a>
                </div>

                <div class="px-6 pb-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Oferta</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Candidatos</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Publicación</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($ultimasOfertas as $oferta)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $oferta->titulo ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $oferta->estado ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right text-gray-700">
                                    {{ $oferta->candidatos_count ?? 0 }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right text-gray-700">
                                    {{ optional($oferta->created_at)->format('d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-sm text-gray-600">No hay ofertas.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
