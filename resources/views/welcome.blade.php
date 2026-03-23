<x-guest-layout>
    <div class="min-h-screen bg-white text-slate-900">

        {{-- HERO --}}
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-center bg-cover bg-fixed sm:bg-fixed bg-scroll"
                style="background-image:url('{{ asset('images/alumnos.png') }}')">
            </div>

            <div class="absolute inset-0 bg-gradient-to-b from-[#062B63]/90 via-[#0B4AA2]/75 to-white/0"></div>

            <div class="relative mx-auto max-w-6xl px-6 lg:px-10 py-16 lg:py-24">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur">
                        Formacom actúa como intermediario del proceso de selección
                    </div>

                    <h1 class="mt-5 text-3xl lg:text-5xl font-extrabold tracking-tight text-white">
                        Portal de empleo con gestión centralizada y anonimato entre candidatos y empresas
                    </h1>

                    <p class="mt-5 text-white/90 leading-relaxed text-base lg:text-lg">
                        Publica ofertas, inscríbete en vacantes y deja que <span class="font-semibold">Formacom</span>
                        gestione la captación, clasificación y asignación de candidaturas.
                        La plataforma protege la identidad de empresas y candidatos dentro del sistema.
                    </p>

                    <div class="mt-8 grid gap-3 sm:grid-cols-2">
                        <a href="{{ url('/candidato/register') }}"
                            class="group rounded-2xl bg-white text-[#0B4AA2] p-5 hover:bg-white/95 shadow-lg shadow-black/10">
                            <div class="flex items-start gap-3">
                                <div class="h-10 w-10 rounded-xl bg-[#0B4AA2]/10 grid place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0B4AA2]"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 16.92A9.958 9.958 0 0110 12c3.49 0 6.57 1.79 8.335 4.5.4.62-.1 1.5-.86 1.5H1.318c-.76 0-1.26-.88-.86-1.58z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-lg">Soy candidato/a</div>
                                    <div class="mt-1 text-sm text-slate-600">
                                        Completa tu perfil, sube tu CV e inscríbete en ofertas sin ver la identidad de la empresa.
                                    </div>
                                    <div class="mt-3 text-sm font-semibold inline-flex items-center gap-2">
                                        Crear cuenta
                                        <span class="transition-transform group-hover:translate-x-1">→</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ url('/empresa/register') }}"
                            class="group rounded-2xl bg-[#0B4AA2] text-white p-5 hover:bg-[#0A3F8A] shadow-lg shadow-black/10">
                            <div class="flex items-start gap-3">
                                <div class="h-10 w-10 rounded-xl bg-white/15 grid place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M4 3a2 2 0 00-2 2v11a1 1 0 001 1h14a1 1 0 001-1V5a2 2 0 00-2-2H4zm2 4h2v2H6V7zm0 4h2v2H6v-2zm4-4h2v2h-2V7zm0 4h2v2h-2v-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-lg">Soy empresa</div>
                                    <div class="mt-1 text-sm text-white/90">
                                        Publica ofertas y consulta su estado mientras Formacom gestiona y clasifica las candidaturas.
                                    </div>
                                    <div class="mt-3 text-sm font-semibold inline-flex items-center gap-2">
                                        Registrarme
                                        <span class="transition-transform group-hover:translate-x-1">→</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="mt-6 text-white/80 text-sm">
                        ¿Ya tienes cuenta?
                        <a class="underline hover:text-white" href="{{ route('login') }}">Accede aquí</a>.
                    </div>
                </div>
            </div>

            <div class="relative -mt-10">
                <div class="h-16 bg-white rounded-t-[2.5rem]"></div>
            </div>
        </section>

        {{-- CÓMO FUNCIONA --}}
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12 lg:py-16">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                    <div class="max-w-3xl">
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                            Un proceso de selección gestionado por Formacom
                        </h2>
                        <p class="mt-3 text-slate-600 leading-relaxed">
                            La plataforma está diseñada para que <span class="font-semibold">candidatos</span> se inscriban
                            fácilmente y para que <span class="font-semibold">empresas</span> publiquen vacantes,
                            mientras <span class="font-semibold">Formacom</span> centraliza la recepción,
                            clasificación y asignación de candidaturas.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ url('/candidato/register') }}"
                            class="rounded-xl px-5 py-3 text-sm font-semibold bg-slate-900 text-white hover:bg-slate-800">
                            Registro candidato/a
                        </a>
                        <a href="{{ url('/empresa/register') }}"
                            class="rounded-xl px-5 py-3 text-sm font-semibold border border-slate-200 hover:bg-slate-50">
                            Registro empresa
                        </a>
                    </div>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <div class="text-sm font-extrabold text-[#0B4AA2]">1) Publicación de ofertas</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Las empresas publican sus vacantes o Formacom las crea en su nombre para iniciar el proceso.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <div class="text-sm font-extrabold text-[#0B4AA2]">2) Captación y clasificación</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Los candidatos se inscriben y Formacom revisa, etiqueta, organiza y asigna las candidaturas.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <div class="text-sm font-extrabold text-[#0B4AA2]">3) Anonimato y control</div>
                        <p class="mt-2 text-sm text-slate-600">
                            El candidato no ve qué empresa publica la oferta y la empresa no accede a CVs ni candidaturas dentro del sistema.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- BLOQUE EMPRESAS / FORMACOM --}}
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-center bg-cover bg-fixed sm:bg-fixed bg-scroll"
                style="background-image:url('{{ asset('images/empresasp.jpg') }}')">
            </div>
            <div class="absolute inset-0 bg-[#062B63]/80"></div>

            <div class="relative mx-auto max-w-6xl px-6 lg:px-10 py-14 lg:py-20">
                <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div class="text-white">
                        <h3 class="text-2xl lg:text-3xl font-extrabold">
                            Para empresas: publica ofertas con la intermediación de Formacom
                        </h3>
                        <p class="mt-4 text-white/90 leading-relaxed">
                            Gestiona tus vacantes y consulta su estado. Formacom se encarga de recibir candidaturas,
                            organizarlas internamente y derivar los perfiles seleccionados por el canal acordado.
                        </p>

                        <div class="mt-6 flex flex-col sm:flex-row gap-3">
                            <a href="{{ url('/empresa/register') }}"
                                class="inline-flex justify-center items-center rounded-2xl px-6 py-3 font-semibold bg-white text-[#0B4AA2] hover:bg-white/90">
                                Registrarme como empresa
                            </a>
                            <a href="{{ route('login') }}"
                                class="inline-flex justify-center items-center rounded-2xl px-6 py-3 font-semibold border border-white/30 text-white hover:bg-white/10">
                                Ya tengo cuenta
                            </a>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white/10 border border-white/15 p-6 backdrop-blur">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Publicación de ofertas</div>
                                <div class="text-white/80 text-sm mt-1">Alta, edición y cierre de vacantes.</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Seguimiento de estado</div>
                                <div class="text-white/80 text-sm mt-1">Consulta el estado de tus ofertas publicadas.</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Intermediación de Formacom</div>
                                <div class="text-white/80 text-sm mt-1">Clasificación y asignación interna de candidaturas.</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Privacidad reforzada</div>
                                <div class="text-white/80 text-sm mt-1">Sin acceso directo a candidaturas ni CVs en la plataforma.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="h-16 bg-white rounded-b-[2.5rem]"></div>
            </div>
        </section>

        {{-- ÚLTIMAS OFERTAS --}}
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12 lg:py-16">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight text-gray-900">
                            Últimas ofertas publicadas
                        </h2>
                        <p class="mt-2 text-sm text-slate-600">
                            Las ofertas se muestran sin datos identificativos de empresa.
                        </p>
                    </div>

                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                        Acceder
                    </a>
                </div>

                <div class="mt-8 grid gap-5 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach(collect($ultimasOfertas)->take(8) as $oferta)
                        @php
                            $role = auth()->check()
                                ? (is_object(auth()->user()->role) ? auth()->user()->role->value : auth()->user()->role)
                                : null;

                            $esCandidato = auth()->check() && $role === 'candidato';

                            $href = $esCandidato
                                ? route('candidato.ofertas.show', $oferta)
                                : route('login');
                        @endphp

                        <a href="{{ $href }}"
                            class="group block rounded-2xl border border-slate-200 bg-white p-5 hover:bg-slate-50 transition shadow-sm">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="font-extrabold text-[#0B4AA2] leading-tight line-clamp-2">
                                        {{ $oferta->titulo }}
                                    </div>

                                    {{-- NO mostrar empresa por anonimato --}}
                                    <div class="mt-2 text-sm text-slate-700 truncate">
                                        Oferta gestionada por Formacom
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500 truncate">
                                        {{ $oferta->ubicacion ?? 'Ubicación no indicada' }}
                                    </div>
                                </div>

                                <div class="shrink-0 h-10 w-10 rounded-xl bg-[#0B4AA2]/10 grid place-items-center">
                                    <span class="text-[#0B4AA2] font-extrabold">→</span>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                                @if(!empty($oferta->modalidad?->nombre))
                                    <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700">
                                        {{ $oferta->modalidad->nombre }}
                                    </span>
                                @endif

                                @if(!empty($oferta->sector?->nombre))
                                    <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700">
                                        {{ $oferta->sector->nombre }}
                                    </span>
                                @endif

                                @if(!empty($oferta->jornada?->nombre))
                                    <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700">
                                        {{ $oferta->jornada->nombre }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 text-sm font-semibold text-slate-900 inline-flex items-center gap-2">
                                {{ $esCandidato ? 'Ver oferta' : 'Accede para ver' }}
                                <span class="transition-transform group-hover:translate-x-1">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 sm:hidden">
                    <a href="{{ route('login') }}"
                        class="inline-flex w-full justify-center items-center px-4 py-3 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                        Acceder
                    </a>
                </div>
            </div>
        </section>

        {{-- CTA FINAL --}}
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12">
                <div
                    class="rounded-3xl border border-slate-200 bg-slate-50 p-6 lg:p-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div>
                        <h4 class="text-xl font-extrabold">Empieza hoy</h4>
                        <p class="mt-2 text-sm text-slate-600 max-w-2xl">
                            Regístrate según tu perfil. Los candidatos podrán inscribirse en ofertas y las empresas
                            publicar vacantes para que Formacom gestione el proceso de selección.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <a href="{{ url('/candidato/register') }}"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-2xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                            Registro candidato/a
                        </a>
                        <a href="{{ url('/empresa/register') }}"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-2xl bg-[#0B4AA2] text-white font-semibold hover:bg-[#0A3F8A]">
                            Registro empresa
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="bg-[#0B4AA2]">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-10 text-sm text-white/90">
                <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
                    <div>
                        <div class="font-semibold text-white">© {{ date('Y') }} Formacom Empleo</div>
                        <div class="text-white/70 text-xs mt-1">Agencia de Colocación</div>
                    </div>
                    <div class="flex gap-5">
                        <a class="hover:text-white underline-offset-4 hover:underline" href="https://www.formacom.es/"
                            target="_blank" rel="noopener">
                            formacom.es
                        </a>
                        <a class="hover:text-white underline-offset-4 hover:underline" href="#">Privacidad</a>
                        <a class="hover:text-white underline-offset-4 hover:underline" href="#">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>

        {{-- BOTONERA MÓVIL --}}
        <div class="sm:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-200 p-3">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ url('/candidato/register') }}"
                    class="rounded-xl py-3 text-center font-semibold bg-slate-900 text-white">
                    Candidato/a
                </a>
                <a href="{{ url('/empresa/register') }}"
                    class="rounded-xl py-3 text-center font-semibold bg-[#0B4AA2] text-white">
                    Empresa
                </a>
            </div>
        </div>

        <div class="h-20 sm:hidden"></div>
    </div>
</x-guest-layout>