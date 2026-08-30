<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- ⚠️ Tag meta viewport ini adalah kunci utama agar web responsif di HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#15803d">

    <title>@yield('title', 'DigiFlora - Stasiun Penelitian Soraya')</title>

    <!-- Memanggil Tailwind CSS & JS via Vite (Laravel 13) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Memanggil pustaka ikon Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col relative">

    <!-- Latar dekoratif: gradasi halus + bola cahaya botanical -->
    <div class="pointer-events-none fixed inset-0 -z-10 bg-gradient-to-b from-brand-100/50 via-white to-slate-100 overflow-hidden">
        <div class="orb w-72 h-72 bg-brand-300/40 -top-24 -left-24 animate-blob"></div>
        <div class="orb w-80 h-80 bg-emerald-300/35 top-1/3 -right-32 animate-blob animation-delay-4000"></div>
        <div class="orb w-64 h-64 bg-lime-300/30 bottom-0 left-1/4 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Memanggil komponen Navbar yang baru saja dibuat -->
    @include('components.navbar')

    <!-- Konten Utama yang Dinamis -->
   <main class="grow w-full px-4 sm:px-6 lg:px-8 py-8 sm:py-10 @hasSection('bottom_nav') pb-28 @endif @yield('main_class', '')">
        @yield('content')
    </main>

    <!-- Footer Sederhana -->
    <footer class="relative bg-ink-900 text-slate-300 py-14 text-sm mt-auto overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-brand-500 via-emerald-400 to-brand-500"></div>
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-10">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="p-2 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl text-white shadow-lg shadow-brand-500/25">
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
                <h4 class="text-white font-semibold text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="w-6 h-px bg-brand-400"></span> Navigasi
                </h4>
                <ul class="space-y-2.5 text-slate-400 text-xs">
                    <li><a href="{{ url('/') }}" class="hover:text-brand-300 transition-colors inline-flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3 text-brand-500"></i>Beranda</a></li>
                    <li><a href="{{ url('/galeri') }}" class="hover:text-brand-300 transition-colors inline-flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3 text-brand-500"></i>Galeri Tumbuhan</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="hover:text-brand-300 transition-colors inline-flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3 text-brand-500"></i>Tentang Kami</a></li>
                    <li><a href="{{ url('/scan') }}" class="hover:text-brand-300 transition-colors inline-flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3 text-brand-500"></i>Scan QR Code</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="w-6 h-px bg-brand-400"></span> Kontak
                </h4>
                <ul class="space-y-3 text-slate-400 text-xs">
                    <li class="flex items-center gap-2.5">
                        <span class="p-1.5 bg-white/5 rounded-lg text-brand-400 ring-1 ring-white/10"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i></span>
                        Kawasan Ekosistem Leuser, Aceh
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="p-1.5 bg-white/5 rounded-lg text-brand-400 ring-1 ring-white/10"><i data-lucide="mail" class="w-3.5 h-3.5"></i></span>
                        soraya@leuser.research
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="p-1.5 bg-white/5 rounded-lg text-brand-400 ring-1 ring-white/10"><i data-lucide="qr-code" class="w-3.5 h-3.5"></i></span>
                        Digitalisasi Berbasis QR Code
                    </li>
                </ul>
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 pt-6 border-t border-white/10 text-center">
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
