<x-guest-layout>
    <div class="min-h-screen bg-white text-slate-900">

    

        {{-- HERO PARALLAX --}}
        <section class="relative overflow-hidden">
            {{-- Fondo (parallax “simple” con bg-fixed). En móvil se desactiva con bg-scroll --}}
            <div class="absolute inset-0 bg-center bg-cover bg-fixed sm:bg-fixed bg-scroll"
                 style="background-image:url('{{ asset('images/alumnos.png') }}')">
            </div>

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-[#062B63]/85 via-[#0B4AA2]/70 to-white/0"></div>

            <div class="relative mx-auto max-w-6xl px-6 lg:px-10 py-16 lg:py-24">
                <div class="max-w-2xl">
                    

                    <h1 class="mt-5 text-3xl lg:text-5xl font-extrabold tracking-tight text-white">
                        Portal de empleo
                    </h1>

                    <p class="mt-5 text-white/90 leading-relaxed text-base lg:text-lg">
                        Encuentra empleo o publica ofertas en un entorno profesional:
                        <span class="font-semibold">candidaturas, estados del proceso, comunicación</span> y gestión ordenada.
                    </p>

                    {{-- CTAs separados --}}
                    <div class="mt-8 grid gap-3 sm:grid-cols-2">
                        <a href="{{ url('/candidato/register') }}"
                           class="group rounded-2xl bg-white text-[#0B4AA2] p-5 hover:bg-white/95 shadow-lg shadow-black/10">
                            <div class="flex items-start gap-3">
                                <div class="h-10 w-10 rounded-xl bg-[#0B4AA2]/10 grid place-items-center">
                                    {{-- icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0B4AA2]" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8z"/>
                                        <path fill-rule="evenodd" d="M.458 16.92A9.958 9.958 0 0110 12c3.49 0 6.57 1.79 8.335 4.5.4.62-.1 1.5-.86 1.5H1.318c-.76 0-1.26-.88-.86-1.58z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-lg">Soy candidato/a</div>
                                    <div class="mt-1 text-sm text-slate-600">
                                        Busca ofertas, inscríbete y sigue el estado de tus candidaturas desde tu panel.
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
                                    {{-- icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 3a2 2 0 00-2 2v11a1 1 0 001 1h14a1 1 0 001-1V5a2 2 0 00-2-2H4zm2 4h2v2H6V7zm0 4h2v2H6v-2zm4-4h2v2h-2V7zm0 4h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-extrabold text-lg">Soy empresa</div>
                                    <div class="mt-1 text-sm text-white/90">
                                        Publica ofertas, recibe candidatos, filtra perfiles y gestiona el proceso de selección.
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
                        ¿Ya tienes cuenta? <a class="underline hover:text-white" href="{{ route('login') }}">Accede aquí</a>.
                    </div>
                </div>
            </div>

            {{-- Curva/transition suave --}}
            <div class="relative -mt-10">
                <div class="h-16 bg-white rounded-t-[2.5rem]"></div>
            </div>
        </section>

        {{-- BLOQUE “CÓMO FUNCIONA” --}}
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12 lg:py-16">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                            Todo el proceso, en una sola plataforma
                        </h2>
                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Diseñada para que <span class="font-semibold">candidatos</span> encuentren ofertas y se inscriban en segundos,
                            y para que <span class="font-semibold">empresas</span> publiquen vacantes y gestionen candidatos con orden.
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
                        <div class="text-sm font-extrabold text-[#0B4AA2]">1) Publica / Encuentra</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Empresas publican ofertas con requisitos y condiciones. Candidatos exploran ofertas y aplican rápidamente.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <div class="text-sm font-extrabold text-[#0B4AA2]">2) Gestiona candidaturas</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Estados del proceso, filtros, notas internas y comunicación para decidir mejor y más rápido.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <div class="text-sm font-extrabold text-[#0B4AA2]">3) Seguimiento claro</div>
                        <p class="mt-2 text-sm text-slate-600">
                            El candidato ve el estado de su candidatura; la empresa mantiene el pipeline ordenado.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECCIÓN PARALLAX 2 (empresas) --}}
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-center bg-cover bg-fixed sm:bg-fixed bg-scroll"
                 style="background-image:url('{{ asset('images/empresasp.jpg') }}')">
            </div>
            <div class="absolute inset-0 bg-[#062B63]/75"></div>

            <div class="relative mx-auto max-w-6xl px-6 lg:px-10 py-14 lg:py-20">
                <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div class="text-white">
                        <h3 class="text-2xl lg:text-3xl font-extrabold">Para empresas: publica y selecciona con orden</h3>
                        <p class="mt-4 text-white/90 leading-relaxed">
                            Centraliza todo: ofertas, candidaturas, filtros por perfil, notas, estados del proceso y
                            comunicación interna. Menos caos, más decisiones rápidas.
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
                                <div class="text-white font-semibold text-sm">Recepción de candidatos</div>
                                <div class="text-white/80 text-sm mt-1">CV, perfil, datos y contacto.</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Estados del proceso</div>
                                <div class="text-white/80 text-sm mt-1">Nuevo, en revisión, entrevista, finalista…</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-white font-semibold text-sm">Filtros y notas</div>
                                <div class="text-white/80 text-sm mt-1">Ordena y prioriza perfiles.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="h-16 bg-white rounded-b-[2.5rem]"></div>
            </div>
        </section>

        {{-- CTA FINAL --}}
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 lg:p-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div>
                        <h4 class="text-xl font-extrabold">Empieza hoy</h4>
                        <p class="mt-2 text-sm text-slate-600 max-w-2xl">
                            Regístrate según tu perfil: candidatos para buscar e inscribirse en ofertas,
                            empresas para publicar vacantes y gestionar candidaturas.
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

        {{-- FOOTER (azul) --}}
        <footer class="bg-[#0B4AA2]">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-10 text-sm text-white/90">
                <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
                    <div>
                        <div class="font-semibold text-white">© {{ date('Y') }} Formacom Empleo</div>
                        <div class="text-white/70 text-xs mt-1">Agencia de Colocación</div>
                    </div>
                    <div class="flex gap-5">
                        <a class="hover:text-white underline-offset-4 hover:underline" href="https://www.formacom.es/" target="_blank" rel="noopener">
                            formacom.es
                        </a>
                        <a class="hover:text-white underline-offset-4 hover:underline" href="#">Privacidad</a>
                        <a class="hover:text-white underline-offset-4 hover:underline" href="#">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>

        {{-- Botonera móvil fija (para que siempre tengan acceso a los registros) --}}
        <div class="sm:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-200 p-3">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ url('/candidato/register') }}"
                   class="rounded-xl py-3 text-center font-semibold bg-slate-900 text-white">
                    Candidato/a
                </a>
                <a href="{{ url('/empresas/register') }}"
                   class="rounded-xl py-3 text-center font-semibold bg-[#0B4AA2] text-white">
                    Empresa
                </a>
            </div>
        </div>

        {{-- espacio para la botonera móvil --}}
        <div class="h-20 sm:hidden"></div>
    </div>
</x-guest-layout>
