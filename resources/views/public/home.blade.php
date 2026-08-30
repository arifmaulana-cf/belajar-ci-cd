@extends('layouts.app')

@section('title', 'DigiFlora - Beranda')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<!-- Container Utama Full-Width yang Memenuhi Halaman -->
<div class="w-full space-y-16 sm:space-y-20 pb-4">

    <!-- ============================================================
         1. HERO PARALLAX (layar penuh)
         ============================================================ -->
    <section class="parallax-hero parallax-bg relative w-full rounded-[2rem] overflow-hidden shadow-2xl shadow-brand-900/20"
        style="background-image:url('https://picsum.photos/seed/stasiunpenelitiansoraya/1920/1080')">

        <!-- Lapisan gelap gradasi editorial -->
        <div class="absolute inset-0 parallax-overlay"></div>

        <!-- Bola cahaya dekoratif (bergerak parallax) -->
        <div class="orb w-72 h-72 bg-emerald-400/20 -top-16 -right-16 animate-blob" data-parallax="0.12"></div>
        <div class="orb w-80 h-80 bg-brand-500/25 bottom-0 -left-24 animate-blob animation-delay-2000" data-parallax="0.18"></div>

        <!-- Pola titik-titik halus -->
        <div class="absolute inset-0 opacity-[0.12]"
            style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative px-6 sm:px-12 py-16 sm:py-24 flex flex-col items-center text-center max-w-4xl mx-auto">
            <!-- Badge lokasi -->
            <span class="inline-flex items-center gap-2 text-[11px] sm:text-xs font-bold text-white bg-white/15 backdrop-blur-md ring-1 ring-white/20 rounded-full px-4 py-2 mb-6">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-300"></i>
                Kawasan Ekosistem Leuser, Aceh
            </span>

            <!-- Judul utama editorial -->
            <h1 class="editorial-title text-white text-4xl sm:text-6xl lg:text-7xl mb-5">
                Mengenal Tumbuhan,
                <span class="text-gradient bg-gradient-to-r from-emerald-300 via-lime-300 to-emerald-200">Satu QR Code</span>
                Sekali Scan
            </h1>

            <p class="text-slate-200 text-sm sm:text-base leading-relaxed max-w-xl mb-8">
                DigiFlora menghadirkan digitalisasi identifikasi keanekaragaman tumbuhan di
                Stasiun Penelitian Soraya — cepat, akurat, dan dapat diakses langsung dari lapangan.
            </p>

            <!-- Tombol aksi -->
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('gallery') }}" class="btn bg-gradient-to-r from-brand-500 to-emerald-400 hover:from-brand-600 hover:to-emerald-500 text-white px-7 py-3 text-sm shadow-xl shadow-brand-500/30">
                    <i data-lucide="leaf" class="w-4 h-4"></i>
                    Jelajahi Galeri
                </a>
                <a href="{{ route('scan') }}" class="cta-invert">
                    <i data-lucide="qr-code" class="w-4 h-4 text-emerald-300"></i>
                    Scan QR di Lapangan
                </a>
            </div>

            <!-- Statistik singkat -->
            <div class="grid grid-cols-3 gap-6 sm:gap-10 mt-12 pt-8 border-t border-white/15 w-full max-w-lg">
                <div>
                    <p class="font-display font-bold text-3xl text-white">{{ $stats['total_plants'] }}</p>
                    <p class="text-[11px] uppercase tracking-wider text-slate-300 mt-1">Spesies Terdata</p>
                </div>
                <div>
                    <p class="font-display font-bold text-3xl text-white">{{ $stats['total_families'] }}</p>
                    <p class="text-[11px] uppercase tracking-wider text-slate-300 mt-1">Famili Tumbuhan</p>
                </div>
                <div>
                    <p class="font-display font-bold text-3xl text-white">100%</p>
                    <p class="text-[11px] uppercase tracking-wider text-slate-300 mt-1">Berbasis QR Code</p>
                </div>
            </div>
        </div>

        <!-- Petunjuk scroll -->
        <a href="#tentang" class="scroll-cue absolute bottom-6 left-1/2 -translate-x-1/2 text-white/80 hover:text-white transition-colors" aria-label="Gulir ke bawah">
            <i data-lucide="chevron-down" class="w-7 h-7"></i>
        </a>
    </section>

    <!-- ============================================================
         2. TENTANG SINGKAT
         ============================================================ -->
    <section id="tentang" class="grid lg:grid-cols-2 gap-8 items-center scroll-mt-24">
        <!-- Teks -->
        <div class="space-y-5 reveal">
            <span class="section-chip">
                <i data-lucide="info" class="w-3.5 h-3.5"></i> Tentang Soraya
            </span>
            <h2 class="display-title text-3xl sm:text-4xl leading-tight">
                Pusat Penelitian di
                <span class="text-gradient">Jantung Hutan Hujan Tropis</span>
            </h2>
            <p class="text-sm sm:text-base leading-relaxed text-slate-600 text-justify">
                Stasiun Penelitian Soraya merupakan salah satu pusat penelitian ekologi hutan hujan tropis yang penting
                dalam Kawasan Ekosistem Leuser. Kawasan ini memiliki keanekaragaman hayati yang tinggi, mencakup berbagai
                spesies flora dan fauna endemik. Sistem DigiFlora hadir untuk mempermudah digitalisasi identifikasi
                keanekaragaman tumbuhan berbasis QR Code di stasiun ini.
            </p>

            <!-- Poin keunggulan -->
            <div class="grid sm:grid-cols-2 gap-4 pt-2">
                <div class="flex items-start gap-3">
                    <span class="shrink-0 p-2.5 bg-brand-50 rounded-xl text-brand-600 ring-1 ring-brand-100">
                        <i data-lucide="qr-code" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Identifikasi QR</p>
                        <p class="text-xs text-slate-500 leading-relaxed">Scan papan identitas langsung dapatkan info spesies.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 p-2.5 bg-brand-50 rounded-xl text-brand-600 ring-1 ring-brand-100">
                        <i data-lucide="flask-conical" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Data Ilmiah</p>
                        <p class="text-xs text-slate-500 leading-relaxed">Menunjang penelitian flora dan konservasi Leuser.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 p-2.5 bg-brand-50 rounded-xl text-brand-600 ring-1 ring-brand-100">
                        <i data-lucide="smartphone" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Akses Lapangan</p>
                        <p class="text-xs text-slate-500 leading-relaxed">Responsif di HP, mudah digunakan oleh peneliti.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 p-2.5 bg-brand-50 rounded-xl text-brand-600 ring-1 ring-brand-100">
                        <i data-lucide="tree-deciduous" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Keanekaragaman</p>
                        <p class="text-xs text-slate-500 leading-relaxed">Katalog spesies flora endemik Sumatera yang terus berkembang.</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('tentang') }}" class="btn-soft px-5 py-2.5 text-sm inline-flex">
                Pelajari Lebih Lanjut <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <!-- Ilustrasi: kartu contoh detail -->
        <div class="relative reveal reveal-delay-2">
            <div class="absolute -inset-4 bg-gradient-to-br from-brand-200/50 to-emerald-100/50 rounded-[2rem] rotate-2"></div>
            <div class="relative bg-white rounded-3xl shadow-xl shadow-slate-900/10 border border-slate-100 overflow-hidden p-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="p-2.5 bg-gradient-to-br from-brand-500 to-emerald-500 rounded-xl text-white shadow-md shadow-brand-500/25">
                            <i data-lucide="leaf" class="w-5 h-5"></i>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-900 leading-tight">Contoh Kartu Spesies</p>
                            <p class="text-[11px] text-slate-400">Format digital DigiFlora</p>
                        </div>
                    </div>
                    <span class="badge-brand">
                        <i data-lucide="scan-line" class="w-3 h-3"></i> QR Ready
                    </span>
                </div>

                @forelse($latestPlants as $i => $plant)
                <div class="flex items-center gap-4 p-3 rounded-2xl {{ $i > 0 ? 'mt-3' : '' }} bg-gradient-to-r from-slate-50 to-white border border-slate-100">
                    <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-slate-100 bg-slate-100">
                        <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}" alt="{{ $plant->nama_tumbuhan }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-800 truncate">{{ $plant->nama_tumbuhan }}</p>
                        <p class="text-xs italic text-brand-600 truncate">{{ $plant->nama_latin }}</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">{{ $plant->kode_tumbuhan }}</p>
                    </div>
                    <span class="ml-auto shrink-0 text-brand-600 bg-brand-50 p-2 rounded-lg">
                        <i data-lucide="qr-code" class="w-4 h-4"></i>
                    </span>
                </div>
                @empty
                <div class="text-center text-slate-400 text-xs py-8">
                    Belum ada data tumbuhan yang tersedia.
                </div>
                @endforelse

                <div class="mt-4 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Data diperbarui secara berkala oleh tim peneliti.</span>
                    <i data-lucide="chevrons-up" class="w-4 h-4 text-brand-500"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         3. GALERI TERBARU (strip tile parallax + grid)
         ============================================================ -->
    <section class="space-y-6">
        <div class="flex flex-wrap justify-between items-end gap-4 reveal">
            <div class="space-y-2">
                <span class="section-chip">
                    <i data-lucide="images" class="w-3.5 h-3.5"></i> Koleksi Terbaru
                </span>
                <h2 class="display-title text-3xl sm:text-4xl">Galeri Tumbuhan</h2>
            </div>
            <a href="{{ route('gallery') }}" class="btn-soft px-4 py-2 text-xs">
                Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- Strip tile bergaya parallax (huruf besar overlay) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @forelse($latestPlants->take(4) as $i => $plant)
            <a href="{{ route('plant.detail', $plant->kode_tumbuhan) }}"
                class="gallery-tile h-44 sm:h-56 group reveal reveal-delay-{{ ($i % 5) + 1 }}">
                <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}"
                    alt="{{ $plant->nama_tumbuhan }}" loading="lazy" decoding="async">
                <span class="gt-label badge bg-white/90 text-brand-700 backdrop-blur border border-white/60">
                    <i data-lucide="tag" class="w-3 h-3"></i> {{ $plant->kode_tumbuhan }}
                </span>
                <span class="gt-letter">{{ Str::upper(mb_substr($plant->nama_tumbuhan, 0, 1)) }}</span>
            </a>
            @empty
            <div class="col-span-full panel text-center text-slate-400 text-xs sm:text-sm">
                Belum ada data tumbuhan yang tersedia.
            </div>
            @endforelse
        </div>

        <!-- Grid Kartu Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestPlants as $i => $plant)
            <a href="{{ route('plant.detail', $plant->kode_tumbuhan) }}"
                class="card card-plant card-hover group overflow-hidden flex flex-col reveal reveal-delay-{{ ($i % 5) + 1 }}">
                <div class="relative w-full h-56 sm:h-64 bg-slate-100 overflow-hidden">
                        <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}"
                            alt="{{ $plant->nama_tumbuhan }}"
                            loading="lazy" decoding="async"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-ink-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="absolute top-3 left-3 badge-slate bg-white/90 backdrop-blur text-brand-700 border border-slate-200/60">
                        <i data-lucide="tag" class="w-3 h-3"></i> {{ $plant->kode_tumbuhan }}
                    </span>
                    @if($plant->famili)
                    <span class="absolute bottom-3 left-3 badge bg-emerald-400/90 text-emerald-950 backdrop-blur">
                        {{ $plant->famili }}
                    </span>
                    @endif
                    <span class="absolute bottom-3 right-3 flex items-center gap-1.5 text-[11px] font-bold text-white opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                        Lihat Detail <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                    </span>
                </div>
                <div class="p-5 space-y-1.5 grow flex flex-col">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-700 transition-colors">{{ $plant->nama_tumbuhan }}</h3>
                    <p class="italic text-xs sm:text-sm text-brand-600 font-medium">{{ $plant->nama_latin }}</p>
                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mt-1.5">{{ $plant->deskripsi }}</p>
                    <span class="mt-auto pt-4 text-[11px] font-semibold text-brand-600 inline-flex items-center gap-1">
                        Klik untuk detail lengkap <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </div>
            </a>
            @empty
            <div class="col-span-full panel text-center text-slate-400 text-xs sm:text-sm">
                Belum ada data tumbuhan yang tersedia.
            </div>
            @endforelse
        </div>
    </section>

    <!-- ============================================================
         4. CTA SCAN (band parallax gelap)
         ============================================================ -->
    <section class="relative rounded-[2rem] overflow-hidden parallax-bg shadow-2xl shadow-brand-900/20"
        style="background-image:url('https://picsum.photos/seed/sorayascan/1600/900')">
        <div class="absolute inset-0 parallax-overlay"></div>

        <div class="orb w-64 h-64 bg-emerald-400/20 -top-20 -right-16 animate-blob" data-parallax="0.1"></div>
        <div class="orb w-64 h-64 bg-lime-400/10 -bottom-20 -left-16 animate-blob animation-delay-4000" data-parallax="0.14"></div>

        <div class="relative px-6 sm:px-12 py-12 sm:py-16 flex flex-col sm:flex-row items-center justify-between gap-8">
            <div class="space-y-3 text-center sm:text-left">
                <span class="inline-flex items-center gap-2 text-[11px] font-bold text-emerald-300 bg-white/10 ring-1 ring-white/15 rounded-full px-3.5 py-1.5">
                    <i data-lucide="scan-line" class="w-3.5 h-3.5"></i> Siap Digunakan di Lapangan
                </span>
                <h2 class="display-title text-white text-2xl sm:text-3xl leading-snug">
                    Temukan tumbuhan yang sedang Anda amati
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm max-w-md">
                    Arahkan kamera ke kode QR pada papan identitas tumbuhan dan dapatkan informasi lengkapnya secara instan.
                </p>
            </div>
            <a href="{{ route('scan') }}" class="cta-invert shrink-0">
                <i data-lucide="qr-code" class="w-5 h-5 text-emerald-300"></i>
                Mulai Scan Sekarang
            </a>
        </div>
    </section>

</div>
@endsection
