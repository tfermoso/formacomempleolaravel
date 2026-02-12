<header class="sticky top-0 z-50 bg-[#0B4AA2]/95 backdrop-blur border-b border-white/10">
    <div class="mx-auto max-w-6xl px-6 lg:px-10 py-4 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-white/10 border border-white/20 grid place-items-center overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Formacom" class="h-8 w-8 object-contain">
            </div>
            <div class="leading-tight">
                <div class="text-white font-semibold">Formacom Empleo</div>
                <div class="text-white/70 text-xs">Agencia de colocación</div>
            </div>
        </a>

        <nav class="hidden sm:flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                    Panel
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center rounded-xl border border-white/30 text-white px-4 py-2 text-sm font-semibold hover:bg-white/10">
                        Salir
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white/90 hover:text-white hover:bg-white/10">
                    Acceder
                </a>

                <a href="{{ url('/candidato/register') }}"
                   class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                    Registro candidato/a
                </a>

                <a href="{{ url('/empresa/register') }}"
                   class="inline-flex items-center rounded-xl border border-white/30 text-white px-4 py-2 text-sm font-semibold hover:bg-white/10">
                    Registro empresa
                </a>
            @endauth
        </nav>

        <div class="sm:hidden">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-white font-semibold">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white font-semibold">Acceder</a>
            @endauth
        </div>
    </div>
</header>
<header class="sticky top-0 z-50 bg-[#0B4AA2]/95 backdrop-blur border-b border-white/10">
    <div class="mx-auto max-w-6xl px-6 lg:px-10 py-4 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-white/10 border border-white/20 grid place-items-center overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Formacom" class="h-8 w-8 object-contain">
            </div>
            <div class="leading-tight">
                <div class="text-white font-semibold">Formacom Empleo</div>
                <div class="text-white/70 text-xs">Agencia de colocación</div>
            </div>
        </a>

        <nav class="hidden sm:flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                    Panel
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center rounded-xl border border-white/30 text-white px-4 py-2 text-sm font-semibold hover:bg-white/10">
                        Salir
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white/90 hover:text-white hover:bg-white/10">
                    Acceder
                </a>

                <a href="{{ url('/candidato/register') }}"
                   class="inline-flex items-center rounded-xl bg-white text-[#0B4AA2] px-4 py-2 text-sm font-semibold hover:bg-white/90">
                    Registro candidato/a
                </a>

                <a href="{{ url('/empresa/register') }}"
                   class="inline-flex items-center rounded-xl border border-white/30 text-white px-4 py-2 text-sm font-semibold hover:bg-white/10">
                    Registro empresa
                </a>
            @endauth
        </nav>

        <div class="sm:hidden">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-white font-semibold">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white font-semibold">Acceder</a>
            @endauth
        </div>
    </div>
</header>
