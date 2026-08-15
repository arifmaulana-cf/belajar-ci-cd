<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- ⚠️ Tag meta viewport ini adalah kunci utama agar web responsif di HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>@yield('title', 'DigiFlora - Stasiun Penelitian Soraya')</title>

    <!-- Memanggil Tailwind CSS & JS via Vite (Laravel 13) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Memanggil pustaka ikon Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col relative">

    <!-- Latar halus minimalis -->
    <div class="pointer-events-none fixed inset-0 -z-10 bg-gradient-to-b from-white to-slate-50"></div>

    <!-- Memanggil komponen Navbar yang baru saja dibuat -->
    @include('components.navbar')

    <!-- Konten Utama yang Dinamis -->
   <main class="grow w-full px-4 sm:px-6 lg:px-8 py-8 @hasSection('bottom_nav') pb-28 @endif @yield('main_class', '')">
        @yield('content')
    </main>

    <!-- Footer Sederhana -->
    <footer class="bg-ink-900 text-slate-300 py-10 text-sm mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="p-2 bg-brand-600 rounded-lg text-white">
                        <i data-lucide="leaf" class="w-5 h-5"></i>
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="font-bold text-white text-base tracking-wide">DigiFlora</span>
                        <span class="text-[10px] text-brand-300 uppercase tracking-wider">Stasiun Penelitian Soraya</span>
                    </div>
                </div>
                <p class="text-slate-400 text-xs leading-relaxed max-w-xs">
                    Sistem digitalisasi identifikasi tumbuhan berbasis QR Code di Kawasan Ekosistem Leuser.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold text-xs uppercase tracking-wider mb-3">Navigasi</h4>
                <ul class="space-y-2 text-slate-400 text-xs">
                    <li><a href="{{ url('/') }}" class="hover:text-brand-300 transition-colors">Beranda</a></li>
                    <li><a href="{{ url('/galeri') }}" class="hover:text-brand-300 transition-colors">Galeri Tumbuhan</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="hover:text-brand-300 transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ url('/scan') }}" class="hover:text-brand-300 transition-colors">Scan QR Code</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-xs uppercase tracking-wider mb-3">Kontak</h4>
                <ul class="space-y-2 text-slate-400 text-xs">
                    <li class="flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i> Kawasan Ekosistem Leuser, Aceh</li>
                    <li class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4 text-brand-400"></i> soraya@leuser.research</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-6 border-t border-white/10 text-center">
            <p class="text-slate-500 text-xs">&copy; 2026 Sistem Digitalisasi Identifikasi Tumbuhan - Stasiun Penelitian Soraya.</p>
        </div>
    </footer>

    <!-- Bottom Navigasi Mobile (hanya untuk halaman publik) -->
    @hasSection('bottom_nav')
        @yield('bottom_nav')
    @endif

    <script>
        // Inisialisasi ikon
        lucide.createIcons();
    </script>

    @stack('scripts')

</body>
</html>
