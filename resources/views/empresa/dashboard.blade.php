<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--Si tiene empresa, mostrar nombre y logo-->
            @if(auth()->user()->empresa)
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}" alt="Logo"
                        class="w-12 h-12 rounded-full"> <span>{{ auth()->user()->empresa->nombre }}</span>
            <span @else {{ __('Empresa') }} @endif </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Bienvenido a tu panel de empresa
                    </div>

                    <div class="mt-6 text-gray-500">
                        Desde aquí podrás gestionar tu empresa, tus ofertas de empleo y ver las candidaturas recibidas.
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('empresa.edit') }}"
                                    class="underline text-gray-900 dark:text-white">Editar empresa</a></div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-sm text-gray-500">
                                Modifica los datos de tu empresa, como el nombre, el CIF, el logo o la descripción.
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold"><a
                                    href="{{ route('empresa.crear-oferta') }}"
                                    class="underline text-gray-900 dark:text-white">Crear oferta de empleo</a></div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-sm text-gray-500">
                                Publica nuevas ofertas de empleo para atraer a los mejores candidatos.
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Aquí podríamos añadir una sección con las ofertas publicadas y las candidaturas recibidas -->
                @if($ofertas->count() > 0)
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Tus ofertas de empleo</h3>
                        <div class="space-y-4">
                            @foreach($ofertas as $oferta)
                                <div class="p-4 bg-gray-100 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <h4 class="text-md font-semibold">{{ $oferta->titulo }}</h4>
                                        <span class="text-sm text-gray-500">{{ $oferta->candidatos_count }}
                                            candidaturas</span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $oferta->sector->nombre }} -
                                        {{ $oferta->modalidad->nombre }} - {{ $oferta->puesto->nombre }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Aún no has publicado ninguna oferta de empleo</h3>
                        <p class="text-sm text-gray-500">
                            Publica tu primera oferta para empezar a recibir candidaturas de los mejores talentos.
                        </p>
                        <a href="{{ route('empresa.crear-oferta') }}"
                            class="mt-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear oferta de empleo
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>