<nav class="relative z-50 flex items-center justify-between gap-4 px-4 lg:px-8 h-16 border-b border-white/5 bg-ink">
    <a href="{{ route('index') }}" class="flex items-center gap-3 shrink-0 group">
        <div class="w-8 h-8 sm:w-9 sm:h-9 transition-all duration-300 group-hover:brightness-0 group-hover:invert">
            <img src="{{ asset('img/logo-cat.svg') }}" alt="Hustle House" class="w-full h-full">
        </div>
        <span class="font-display text-sm uppercase tracking-widest text-paper hidden sm:inline">Hustle House</span>
    </a>

    <div class="hidden lg:flex items-center gap-6">
        <a href="{{ route('index') }}" class="text-sm font-medium text-steel hover:text-paper transition-colors relative group">
            Inicio
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rust transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('catalogo') }}" class="text-sm font-medium text-steel hover:text-paper transition-colors relative group">
            Catálogo
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rust transition-all duration-300 group-hover:w-full"></span>
        </a>
    </div>

    <div class="hidden md:flex flex-1 max-w-sm mx-auto">
        <form action="#" method="GET" class="w-full">
            <div class="relative">
                <input type="search" placeholder="Buscar prendas o colecciones..." class="w-full bg-concrete/10 text-paper placeholder-steel rounded-soft px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:bg-ink/80 transition-all duration-200 border border-white/5">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-steel text-xs hidden sm:block">⌘K</span>
            </div>
        </form>
    </div>

    <div class="flex items-center gap-1 sm:gap-3">
        <a href="{{ route('catalogo') }}" class="text-sm font-medium text-steel hover:text-paper transition-colors lg:hidden px-2">Catálogo</a>

        @auth
            @if(auth()->user()->rol === 'cliente')
                <a href="{{ route('carrito') }}" class="relative p-2 text-steel hover:text-paper transition-colors" title="Carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="21" cy="21" r="1"/><path d="M3 3h2l.4 2M7 13h10l4-8H5.4"/></svg>
                </a>
            @endif

            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('admin.panel') }}" class="text-sm font-medium text-rust hover:text-rust-deep transition-colors hidden sm:inline">Panel</a>
            @endif

            <a href="{{ route('perfil') }}" class="items-center gap-2 text-sm font-medium text-steel hover:text-paper transition-colors bg-white/5 rounded-full px-3 sm:px-4 py-1.5 hidden sm:flex">
                <span class="w-5 h-5 rounded-full bg-rust flex items-center justify-center text-paper text-xs font-bold">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</span>
                <span class="hidden sm:inline truncate max-w-20 lg:max-w-24">{{ auth()->user()->nombre }}</span>
            </a>

            <a href="{{ route('logout') }}" class="text-sm text-steel hover:text-red-400 transition-colors hidden sm:inline">Salir</a>

        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-paper bg-rust hover:bg-rust-deep transition-colors rounded-full px-4 sm:px-5 py-2">Entrar</a>
        @endauth

        <button id="mobileMenuToggle" class="lg:hidden p-2 text-steel hover:text-paper transition-colors cursor-pointer" aria-label="Abrir menú">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>
</nav>

<div id="mobileDrawer" class="fixed inset-0 z-[60] hidden">
    <div id="drawerOverlay" class="absolute inset-0 bg-ink/60 backdrop-blur-sm opacity-0 transition-opacity duration-300 cursor-pointer"></div>
    <div id="drawerPanel" class="absolute top-0 left-0 h-full w-72 max-w-[85vw] bg-ink border-r border-white/5 transition-transform duration-300 ease-out overflow-y-auto" style="transform: translateX(-100%);">
        <div class="flex items-center justify-between p-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8">
                    <img src="{{ asset('img/logo-cat.svg') }}" alt="" class="w-full h-full">
                </div>
                <span class="font-display text-sm uppercase tracking-widest text-paper">Hustle House</span>
            </div>
            <button id="drawerClose" class="p-2 text-steel hover:text-paper transition-colors cursor-pointer" aria-label="Cerrar menú">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="p-4 border-b border-white/5">
            <form action="#" method="GET">
                <input type="search" placeholder="Buscar..." class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30">
            </form>
        </div>

        <div class="p-4 space-y-1">
            <a href="{{ route('index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-paper hover:bg-white/5 rounded-soft transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Inicio
            </a>
            <a href="{{ route('catalogo') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-steel hover:text-paper hover:bg-white/5 rounded-soft transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Catálogo
            </a>
        </div>

        @auth
            <div class="px-4 py-3 border-t border-white/5">
                <a href="{{ route('perfil') }}" class="flex items-center gap-3 px-3 py-3 bg-white/5 rounded-soft mb-3">
                    <span class="w-9 h-9 rounded-full bg-rust flex items-center justify-center text-paper font-bold text-sm">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-paper truncate">{{ auth()->user()->nombre }}</p>
                        <p class="text-xs text-steel truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </a>
                <div class="space-y-1">
                    <a href="{{ route('perfil') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-steel hover:text-paper hover:bg-white/5 rounded-soft transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Mi Perfil
                    </a>
                    @if(auth()->user()->rol === 'cliente')
                        <a href="{{ route('pedidos') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-steel hover:text-paper hover:bg-white/5 rounded-soft transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Mis Pedidos
                        </a>
                        <a href="{{ route('carrito') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-steel hover:text-paper hover:bg-white/5 rounded-soft transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="21" cy="21" r="1"/><path d="M3 3h2l.4 2M7 13h10l4-8H5.4"/></svg>
                            Carrito
                        </a>
                    @endif
                    @if(auth()->user()->rol === 'admin')
                        <a href="{{ route('admin.panel') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-rust hover:text-rust-deep hover:bg-white/5 rounded-soft transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                            Panel Admin
                        </a>
                    @endif
                </div>
            </div>
            <div class="p-4 border-t border-white/5">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-soft transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Cerrar Sesión
                </a>
            </div>
        @else
            <div class="p-4 border-t border-white/5 space-y-2">
                <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-rust text-paper font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust-deep transition-colors">
                    Entrar
                </a>
            </div>
        @endauth
    </div>
</div>

<script>
(function() {
    const toggle = document.getElementById('mobileMenuToggle');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const panel = document.getElementById('drawerPanel');
    const close = document.getElementById('drawerClose');

    if (!toggle || !drawer || !overlay || !panel || !close) return;

    function openDrawer() {
        drawer.classList.remove('hidden');
        requestAnimationFrame(() => {
            overlay.style.opacity = '1';
            panel.style.transform = 'translateX(0)';
        });
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        overlay.style.opacity = '0';
        panel.style.transform = 'translateX(-100%)';
        setTimeout(() => {
            drawer.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    toggle.addEventListener('click', openDrawer);
    close.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !drawer.classList.contains('hidden')) {
            closeDrawer();
        }
    });
})();
</script>