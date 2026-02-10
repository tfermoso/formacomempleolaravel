<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--Si tiene empresa, mostrar nombre y logo-->
            @if(auth()->user()->empresa)
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}" alt="Logo" class="w-12 h-12 rounded-full">
                    <span>{{ auth()->user()->empresa->nombre }}</span>
                </div>
            @else
            {{ __('Empresa') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
