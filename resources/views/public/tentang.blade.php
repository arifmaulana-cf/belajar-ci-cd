@extends('layouts.app')

@section('title', 'Tentang Kami - Stasiun Penelitian Soraya')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
    <div class="max-w-5xl mx-auto space-y-12">

        <!-- Hero Section (parallax) -->
        <section class="parallax-bg relative rounded-[2rem] overflow-hidden shadow-2xl shadow-brand-900/20 reveal min-h-[55vh] flex items-center"
            style="background-image:url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80')">
            <div class="absolute inset-0 parallax-overlay"></div>

            <div class="orb w-72 h-72 bg-emerald-400/25 -top-24 -right-24 animate-blob" data-parallax="0.1"></div>
            <div class="orb w-64 h-64 bg-lime-400/15 -bottom-24 -left-24 animate-blob animation-delay-4000" data-parallax="0.14"></div>

            <div class="relative flex flex-col items-center justify-center text-center px-6 py-16 sm:py-24 w-full">
                <div class="p-3.5 bg-white/15 backdrop-blur-md rounded-2xl mb-5 ring-1 ring-white/25 shadow-lg animate-float">
                    <i data-lucide="map" class="w-9 h-9 text-white"></i>
                </div>
                <span class="inline-flex items-center gap-2 text-[11px] font-bold text-emerald-300 bg-white/10 ring-1 ring-white/15 rounded-full px-4 py-1.5 mb-4">
                    <i data-lucide="compass" class="w-3.5 h-3.5"></i> Sumatera Utara — Aceh
                </span>
                <h1 class="editorial-title text-white text-3xl md:text-5xl lg:text-6xl tracking-tight">
                    Stasiun Penelitian Soraya
                </h1>
                <p class="text-brand-100 font-medium mt-3 max-w-xl text-sm md:text-base">
                    Kawasan Ekosistem Leuser, Nanggroe Aceh Darussalam
                </p>
            </div>
        </section>

        <!-- Deskripsi Utama -->
        <section class="grid lg:grid-cols-5 gap-6 items-start">
            <div class="lg:col-span-3 panel space-y-4 reveal">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2.5">
                    <span class="p-1.5 bg-brand-50 rounded-lg text-brand-600"><i data-lucide="info" class="w-4 h-4"></i></span>
                    Mengenal Stasiun Soraya
                </h2>
                <div class="text-sm md:text-base text-slate-600 text-justify space-y-4">
                    <p>
                        Stasiun Penelitian Soraya merupakan salah satu pusat pengamatan dan penelitian keanekaragaman hayati
                        yang sangat penting, terletak di jantung <strong class="text-slate-800">Kawasan Ekosistem Leuser (KEL)</strong>. Kawasan ini
                        dikenal sebagai salah satu paru-paru dunia dan habitat bagi berbagai flora dan fauna endemik Sumatera
                        yang dilindungi.
                    </p>
                    <p>
                        Didirikan untuk mendukung kegiatan konservasi, stasiun ini menjadi rumah bagi para peneliti, akademisi,
                        dan mahasiswa untuk mempelajari dinamika ekosistem hutan hujan tropis, perilaku satwa liar, serta
                        pemetaan spesies tumbuhan langka.
                    </p>
                </div>
            </div>

            <!-- Kartu nilai (gaya ".wrapper" parallax: gambar + teks) -->
            <div class="lg:col-span-2 space-y-4 reveal reveal-delay-2">
                <div class="feature-card flex flex-col sm:flex-row items-stretch">
                    <div class="sm:w-2/5 h-40 sm:h-auto shrink-0 overflow-hidden">
                        <img src="https://picsum.photos/seed/sorayakonservasi/600/400" alt="Konservasi Leuser" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="p-2.5 bg-brand-50 rounded-xl ring-1 ring-brand-100 text-brand-600"><i data-lucide="heart-handshake" class="w-5 h-5"></i></span>
                            <p class="font-bold text-sm text-slate-800">Misi Konservasi</p>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Melindungi keanekaragaman hayati Leuser melalui riset, digitalisasi data, dan edukasi masyarakat.
                        </p>
                    </div>
                </div>
                <div class="feature-card flex flex-col sm:flex-row items-stretch">
                    <div class="sm:w-2/5 h-40 sm:h-auto shrink-0 overflow-hidden">
                        <img src="https://picsum.photos/seed/sorayadigiflora/600/400" alt="Peran DigiFlora" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="p-2.5 bg-brand-50 rounded-xl ring-1 ring-brand-100 text-brand-600"><i data-lucide="scan-line" class="w-5 h-5"></i></span>
                            <p class="font-bold text-sm text-slate-800">Peran DigiFlora</p>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Menghubungkan peneliti dengan data spesies secara instan melalui QR Code di papan identitas tumbuhan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kontak & Lokasi -->
        <section class="panel text-center space-y-4 reveal">
            <span class="section-chip mx-auto">
                <i data-lucide="users" class="w-3.5 h-3.5"></i> Kolaborasi Riset
            </span>
            <h3 class="display-title text-2xl sm:text-3xl">Tertarik Melakukan Penelitian?</h3>
            <p class="text-slate-600 text-sm max-w-lg mx-auto leading-relaxed">
                Stasiun Penelitian Soraya terbuka bagi instansi pendidikan dan lembaga konservasi yang ingin mempelajari
                ekosistem Leuser lebih dalam.
            </p>
            <a href="{{ route('home') }}" class="btn-primary px-7 py-3 text-sm">
                <i data-lucide="home" class="w-4 h-4"></i> Kembali ke Beranda
            </a>
        </section>

    </div>
@endsection