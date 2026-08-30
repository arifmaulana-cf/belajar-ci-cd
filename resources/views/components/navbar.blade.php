<nav class="sticky top-0 z-50 glass shadow-sm border-b border-slate-200/60" id="site-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Bagian Logo / Judul -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="relative p-2 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl text-white shadow-lg shadow-brand-600/25 group-hover:shadow-brand-600/40 group-hover:scale-105 transition-all duration-300">
                        <i data-lucide="leaf" class="w-5 h-5"></i>
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="font-bold text-ink-900 text-lg tracking-tight">DigiFlora</span>
                        <span class="text-[10px] text-brand-600 font-semibold uppercase tracking-wider">Stasiun Penelitian Soraya</span>
                    </div>
                </a>
            </div>

            <!-- Menu Navigasi (Desktop) -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="text-slate-600 hover:text-brand-700 hover:bg-brand-50 font-medium text-sm px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-700 font-semibold' : '' }}">Beranda</a>
                <a href="/galeri" class="text-slate-600 hover:text-brand-700 hover:bg-brand-50 font-medium text-sm px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('gallery') ? 'bg-brand-50 text-brand-700 font-semibold' : '' }}">Galeri</a>
                <a href="/tentang-kami" class="text-slate-600 hover:text-brand-700 hover:bg-brand-50 font-medium text-sm px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('tentang') ? 'bg-brand-50 text-brand-700 font-semibold' : '' }}">Tentang Kami</a>
                <a href="/scan" class="btn bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-700 hover:to-emerald-600 text-white px-4 py-2 ml-2 text-sm shadow-md shadow-brand-600/25 {{ request()->routeIs('scan') ? 'ring-2 ring-brand-500 ring-offset-2' : '' }}">
                    <i data-lucide="qr-code" class="w-4 h-4"></i>
                    Scan QR
                </a>

                {{-- menu Admin & Tombol Logout --}}
                @auth
                    <a href="{{ route('admin.plants.index') }}" class="text-slate-600 hover:text-brand-700 hover:bg-brand-50 font-semibold text-sm px-3.5 py-2 rounded-xl transition-colors flex items-center gap-1.5">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Panel Admin
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline ml-1">
                        @csrf
                        <button type="submit" class="btn bg-rose-50 hover:bg-rose-100 text-rose-600 px-3 py-2 text-xs">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Keluar
                        </button>
                    </form>
                @endauth
            </div>

            <!-- Tombol Menu Mobile -->
            <div class="flex items-center md:hidden">
                <button type="button" class="text-slate-600 hover:text-brand-700 focus:outline-none p-2 rounded-xl hover:bg-brand-50 transition-colors" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" aria-label="Buka menu">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Dropdown Mobile -->
    <div class="md:hidden hidden bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-xl" id="mobile-menu">
        <div class="px-4 pt-3 pb-4 space-y-1">
            <a href="/" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700 rounded-xl {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-700 font-bold' : '' }}">Beranda</a>
            <a href="/galeri" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700 rounded-xl {{ request()->routeIs('gallery') ? 'bg-brand-50 text-brand-700 font-bold' : '' }}">Galeri</a>
            <a href="/tentang-kami" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-brand-50 hover:text-brand-700 rounded-xl {{ request()->routeIs('tentang') ? 'bg-brand-50 text-brand-700 font-bold' : '' }}">Tentang Kami</a>
            <a href="/scan" class="flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-700 hover:to-emerald-600 rounded-xl shadow-md shadow-brand-600/25">
                <i data-lucide="qr-code" class="w-5 h-5"></i>
                Scan QR
            </a>

            {{-- Status Login --}}
            @auth
                <a href="{{ route('admin.plants.index') }}" class="block px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-brand-50 hover:text-brand-700 rounded-xl flex items-center gap-2">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-brand-600"></i> Panel Admin
                </a>
                <div class="px-4 py-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left bg-rose-50 hover:bg-rose-100 text-rose-600 px-4 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Keluar Sistem
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>