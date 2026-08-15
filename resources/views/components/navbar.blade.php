<nav class="sticky top-0 z-50 bg-brand-700/95 backdrop-blur-md shadow-sm border-b border-brand-800/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Bagian Logo / Judul -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="p-2 bg-white/15 rounded-lg group-hover:bg-white/25 transition-colors">
                        <i data-lucide="leaf" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-white text-lg leading-tight tracking-wide">DigiFlora</span>
                        <span class="text-[10px] text-brand-100 font-medium uppercase tracking-wider">Stasiun Penelitian Soraya</span>
                    </div>
                </a>
            </div>

            <!-- Menu Navigasi (Desktop) -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="text-brand-50 hover:text-white hover:bg-white/10 font-medium text-sm px-3 py-2 rounded-lg transition-colors">Beranda</a>
                <a href="/galeri" class="text-brand-50 hover:text-white hover:bg-white/10 font-medium text-sm px-3 py-2 rounded-lg transition-colors">Galeri</a>
                <a href="/tentang-kami" class="text-brand-50 hover:text-white hover:bg-white/10 font-medium text-sm px-3 py-2 rounded-lg transition-colors">Tentang Kami</a>
                <a href="/scan" class="btn bg-white text-brand-700 hover:bg-brand-50 px-4 py-2 ml-2 text-sm">
                    <i data-lucide="qr-code" class="w-4 h-4"></i>
                    Scan QR
                </a>

                {{-- menu Admin & Tombol Logout --}}
                @auth
                    <a href="{{ route('admin.plants.index') }}" class="text-amber-200 hover:text-white hover:bg-white/10 font-bold text-sm px-3 py-2 rounded-lg transition-colors flex items-center gap-1">
                        <i data-lucide="settings" class="w-4 h-4"></i> Panel Admin
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline ml-1">
                        @csrf
                        <button type="submit" class="btn bg-rose-500/90 hover:bg-rose-500 text-white px-3 py-2 text-xs">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Keluar
                        </button>
                    </form>
                @endauth
            </div>

            <!-- Tombol Menu Mobile -->
            <div class="flex items-center md:hidden">
                <button type="button" class="text-brand-100 hover:text-white focus:outline-none p-2 rounded-lg hover:bg-white/10" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Dropdown Mobile -->
    <div class="md:hidden hidden bg-brand-800 border-t border-brand-700" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-700 rounded-lg">Beranda</a>
            <a href="/galeri" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-700 rounded-lg">Galeri</a>
            <a href="/tentang-kami" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-700 rounded-lg">Tentang Kami</a>
            <a href="/scan" class="flex items-center gap-2 px-3 py-2 text-base font-bold text-brand-800 bg-white hover:bg-brand-50 rounded-lg">
                <i data-lucide="qr-code" class="w-5 h-5"></i>
                Scan QR
            </a>

            {{-- Status Login --}}
            @auth
                <a href="{{ route('admin.plants.index') }}" class="block px-3 py-2 text-base font-bold text-amber-200 hover:bg-brand-700 rounded-lg">Panel Admin</a>
                <div class="px-3 py-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left bg-rose-500 hover:bg-rose-600 text-white px-3 py-2 rounded-xl text-sm font-bold flex items-center justify-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Keluar Sistem
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>