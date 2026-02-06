<x-guest-layout>
    <div class="bg-white text-slate-900">

      

        {{-- SECTION TITLE (bloque de título como en tu HTML) --}}
        <section class="bg-slate-50 border-y border-slate-200">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-10">
                <h2 class="text-2xl lg:text-3xl font-semibold">
                    Agencia de Colocación Formacom
                </h2>
                <p class="mt-3 text-slate-600 leading-relaxed max-w-3xl">
                    Un portal pensado para gestionar ofertas y candidaturas de forma ordenada:
                    publicación, inscripción, estados del proceso y comunicación interna.
                </p>
            </div>
        </section>

        {{-- ¿QUÉ ES? (bloque de texto) --}}
        <section>
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12">
                <h3 class="text-xl lg:text-2xl font-semibold">¿Qué ofrece la plataforma?</h3>
                <p class="mt-4 text-slate-600 leading-relaxed max-w-4xl">
                    Un entorno seguro con registro, verificación de email, recuperación de contraseña y panel por perfiles.
                    Las empresas publican ofertas y gestionan candidaturas; los candidatos crean su perfil, adjuntan CV y se inscriben;
                    y el administrador valida empresas y supervisa el sistema.
                </p>
            </div>
        </section>

     

        {{-- “POR QUÉ USARLO” (estilo timeline simple, sin swiper) --}}
        <section>
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-12">
                <h3 class="text-xl lg:text-2xl font-semibold">¿Por qué usar Formacom Empleo?</h3>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="text-sm font-semibold">Respuesta a la demanda laboral</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Centraliza ofertas y candidaturas para acelerar procesos de selección.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="text-sm font-semibold">Oportunidades rápidas para candidatos</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Inscripción sencilla y seguimiento del estado del proceso desde el panel.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="text-sm font-semibold">Mejor organización para empresas</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Estados, notas y filtros para trabajar con orden y priorizar perfiles.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="text-sm font-semibold">Seguridad y control</div>
                        <p class="mt-2 text-sm text-slate-600">
                            Verificación de email, recuperación de contraseña y 2FA para cuentas sensibles.
                        </p>
                    </div>
                </div>

                {{-- CTA final --}}
                <div class="mt-10 rounded-2xl border border-slate-200 bg-slate-50 p-6 lg:p-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div>
                        <h4 class="text-lg font-semibold">Empieza hoy</h4>
                        <p class="mt-2 text-sm text-slate-600">
                            Acceso para empresas y candidatos. Administración para validación y control del portal.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <a href="{{ route('register') }}"
                           class="inline-flex justify-center items-center px-6 py-3 rounded-2xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                            Crear cuenta
                        </a>
                        <a href="{{ route('login') }}"
                           class="inline-flex justify-center items-center px-6 py-3 rounded-2xl border border-slate-200 bg-white font-semibold hover:bg-slate-50">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <footer class="border-t border-slate-200">
            <div class="mx-auto max-w-6xl px-6 lg:px-10 py-8 text-xs text-slate-500 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <div>© {{ date('Y') }} Formacom Empleo</div>
                <div class="flex gap-4">
                    <a class="hover:text-slate-700" href="https://www.formacom.es/" target="_blank" rel="noopener">formacom.es</a>
                    <a class="hover:text-slate-700" href="#">Privacidad</a>
                    <a class="hover:text-slate-700" href="#">Cookies</a>
                </div>
            </div>
        </footer>

    </div>
</x-guest-layout>

