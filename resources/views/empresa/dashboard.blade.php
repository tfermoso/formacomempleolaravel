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
</x-app-layout>