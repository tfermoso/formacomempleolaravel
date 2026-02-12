<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $oferta->titulo }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    @if($oferta->empresa) {{ $oferta->empresa->nombre }} @endif
                    @if($oferta->ubicacion) · {{ $oferta->ubicacion }} @endif
                </p>
            </div>

            <div class="flex items-center gap-2">
                @if(!$yaInscrito)
                    <form method="POST" action="{{ route('candidato.ofertas.inscribirse', $oferta) }}">
                        @csrf
                        <button class="inline-flex items-center px-4 py-2 bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800">
                            Inscribirme
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('candidato.ofertas.retirar', $oferta) }}">
                        @csrf
                        @method('DELETE')
                        <button class="inline-flex items-center px-4 py-2 border border-slate-300 bg-white text-sm font-semibold hover:bg-slate-50">
                            Cancelar inscripción
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Estado inscripción --}}
        @if($yaInscrito && $pivot)
            <div class="bg-emerald-50 border border-emerald-200 p-4">
                <div class="text-sm text-emerald-800">
                    Estás inscrito en esta oferta.
                    <span class="font-semibold">Estado:</span> {{ $pivot->estado }}
                    @if($pivot->fecha_inscripcion)
                        · <span class="font-semibold">Fecha:</span>
                        {{ \Illuminate\Support\Carbon::parse($pivot->fecha_inscripcion)->format('d/m/Y') }}
                    @endif
                </div>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-3">
            {{-- IZQUIERDA: contenido principal --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Descripción --}}
                <div class="bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-slate-900">Descripción</h3>
                    <div class="mt-3 text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $oferta->descripcion ?? 'Sin descripción.' }}
                    </div>
                </div>

                {{-- Requisitos --}}
                @if(!empty($oferta->requisitos))
                    <div class="bg-white border border-slate-200 shadow-sm p-6">
                        <h3 class="text-lg font-bold text-slate-900">Requisitos</h3>
                        <div class="mt-3 text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $oferta->requisitos }}
                        </div>
                    </div>
                @endif

                {{-- Funciones --}}
                @if(!empty($oferta->funciones))
                    <div class="bg-white border border-slate-200 shadow-sm p-6">
                        <h3 class="text-lg font-bold text-slate-900">Funciones</h3>
                        <div class="mt-3 text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $oferta->funciones }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- DERECHA: sidebar --}}
            <aside class="space-y-6">

                {{-- Resumen oferta --}}
                <div class="bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-slate-900">Resumen de la oferta</h3>

                    <dl class="mt-4 space-y-3 text-sm">
                        @if($oferta->puesto)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Puesto</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->puesto->nombre }}</dd>
                            </div>
                        @endif

                        @if($oferta->sector)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Sector (oferta)</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->sector->nombre }}</dd>
                            </div>
                        @endif

                        @if($oferta->modalidad)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Modalidad</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->modalidad->nombre }}</dd>
                            </div>
                        @endif

                        @if($oferta->ubicacion)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Ubicación</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->ubicacion }}</dd>
                            </div>
                        @endif

                        @if($oferta->tipo_contrato)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Tipo contrato</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->tipo_contrato }}</dd>
                            </div>
                        @endif

                        @if($oferta->jornada)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Jornada</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->jornada }}</dd>
                            </div>
                        @endif

                        @if($oferta->salario_min || $oferta->salario_max)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Salario</dt>
                                <dd class="text-slate-900 font-semibold text-right">
                                    @if($oferta->salario_min) Desde {{ number_format((float)$oferta->salario_min, 2, ',', '.') }}€ @endif
                                    @if($oferta->salario_min && $oferta->salario_max) · @endif
                                    @if($oferta->salario_max) Hasta {{ number_format((float)$oferta->salario_max, 2, ',', '.') }}€ @endif
                                </dd>
                            </div>
                        @endif

                        @if($oferta->fecha_publicacion)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Publicada</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->fecha_publicacion->format('d/m/Y') }}</dd>
                            </div>
                        @endif

                        @if($oferta->publicar_hasta)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Hasta</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->publicar_hasta->format('d/m/Y') }}</dd>
                            </div>
                        @endif

                        @if($oferta->fecha_incorporacion)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Incorporación</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ $oferta->fecha_incorporacion->format('d/m/Y') }}</dd>
                            </div>
                        @endif

                        @if($oferta->estado)
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Estado</dt>
                                <dd class="text-slate-900 font-semibold text-right">{{ ucfirst($oferta->estado) }}</dd>
                            </div>
                        @endif
                    </dl>

                    <div class="mt-6">
                        @if(!$yaInscrito)
                            <form method="POST" action="{{ route('candidato.ofertas.inscribirse', $oferta) }}">
                                @csrf
                                <button class="w-full inline-flex justify-center px-4 py-2 bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800">
                                    Inscribirme
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('candidato.ofertas.retirar', $oferta) }}">
                                @csrf
                                @method('DELETE')
                                <button class="w-full inline-flex justify-center px-4 py-2 border border-slate-300 bg-white text-sm font-semibold hover:bg-slate-50">
                                    Cancelar inscripción
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Empresa --}}
                <div class="bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-slate-900">Empresa</h3>

                    @if($oferta->empresa)
                        <div class="mt-4 flex items-start gap-4">
                            @if(!empty($oferta->empresa->logo))
                                <img src="{{ asset('storage/'.$oferta->empresa->logo) }}"
                                     alt="Logo {{ $oferta->empresa->nombre }}"
                                     class="h-14 w-14 object-cover border border-slate-200">
                            @else
                                <div class="h-14 w-14 bg-slate-100 border border-slate-200 grid place-items-center text-slate-400 text-sm">
                                    Logo
                                </div>
                            @endif

                            <div class="min-w-0">
                                <div class="font-semibold text-slate-900">{{ $oferta->empresa->nombre }}</div>

                                <div class="mt-1 text-sm text-slate-600">
                                    @if($oferta->empresa->ciudad) {{ $oferta->empresa->ciudad }} @endif
                                    @if($oferta->empresa->provincia) · {{ $oferta->empresa->provincia }} @endif
                                </div>

                                <div class="mt-2">
                                    @if($oferta->empresa->verificada)
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Verificada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                            Pendiente de verificación
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <dl class="mt-5 space-y-2 text-sm">
                            @if($oferta->empresa->cif)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-500">CIF</dt>
                                    <dd class="text-slate-900 font-semibold text-right">{{ $oferta->empresa->cif }}</dd>
                                </div>
                            @endif

                            @if($oferta->empresa->persona_contacto)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-500">Contacto</dt>
                                    <dd class="text-slate-900 font-semibold text-right">{{ $oferta->empresa->persona_contacto }}</dd>
                                </div>
                            @endif

                            @if($oferta->empresa->email_contacto)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-500">Email</dt>
                                    <dd class="text-slate-900 font-semibold text-right break-all">{{ $oferta->empresa->email_contacto }}</dd>
                                </div>
                            @endif

                            @if($oferta->empresa->telefono)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-500">Teléfono</dt>
                                    <dd class="text-slate-900 font-semibold text-right">{{ $oferta->empresa->telefono }}</dd>
                                </div>
                            @endif

                            @if($oferta->empresa->web)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-slate-500">Web</dt>
                                    <dd class="text-right">
                                        <a class="font-semibold text-[#0B4AA2] hover:underline break-all"
                                           href="{{ $oferta->empresa->web }}" target="_blank" rel="noopener">
                                            {{ $oferta->empresa->web }}
                                        </a>
                                    </dd>
                                </div>
                            @endif

                            @if($oferta->empresa->direccion || $oferta->empresa->cp)
                                <div class="pt-3 border-t border-slate-200">
                                    <div class="text-sm font-semibold text-slate-700">Dirección</div>
                                    <div class="mt-1 text-sm text-slate-600">
                                        @if($oferta->empresa->direccion) {{ $oferta->empresa->direccion }} @endif
                                        @if($oferta->empresa->cp) · {{ $oferta->empresa->cp }} @endif
                                        @if($oferta->empresa->ciudad) · {{ $oferta->empresa->ciudad }} @endif
                                        @if($oferta->empresa->provincia) · {{ $oferta->empresa->provincia }} @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Sectores (M2M) --}}
                            @if($oferta->empresa->sectores && $oferta->empresa->sectores->count())
                                <div class="pt-3 border-t border-slate-200">
                                    <div class="text-sm font-semibold text-slate-700">Sectores</div>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach($oferta->empresa->sectores as $s)
                                            <span class="px-2 py-1 text-xs bg-slate-100 border border-slate-200 text-slate-700">
                                                {{ $s->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </dl>
                    @else
                        <p class="mt-3 text-sm text-slate-600">No hay información de empresa asociada.</p>
                    @endif
                </div>

            </aside>
        </div>
    </div>
</x-app-layout>
