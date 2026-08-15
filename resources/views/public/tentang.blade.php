@extends('layouts.app')

@section('title', 'Tentang Kami - Stasiun Penelitian Soraya')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-brand-700 to-brand-900 rounded-3xl overflow-hidden shadow-lg mt-2">
            <div class="absolute inset-0 bg-ink-900/30"></div>
            <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80"
                alt="Hutan Soraya" class="w-full h-64 object-cover mix-blend-overlay">

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                <div class="p-3 bg-white/15 backdrop-blur-sm rounded-2xl mb-4 ring-1 ring-white/20">
                    <i data-lucide="map" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-wide">Stasiun Penelitian Soraya</h1>
                <p class="text-brand-100 font-medium mt-2 max-w-xl text-sm md:text-base">
                    Kawasan Ekosistem Leuser, Nanggroe Aceh Darussalam
                </p>
            </div>
        </div>

        <!-- Deskripsi Utama -->
        <div class="panel">
            <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <span class="p-1.5 bg-brand-50 rounded-lg text-brand-600"><i data-lucide="info" class="w-4 h-4"></i></span>
                Mengenal Stasiun Soraya
            </h2>
            <div class="text-sm md:text-base text-slate-600 text-justify space-y-4">
                <p>
                    Stasiun Penelitian Soraya merupakan salah satu pusat pengamatan dan penelitian keanekaragaman hayati
                    yang sangat penting, terletak di jantung <strong>Kawasan Ekosistem Leuser (KEL)</strong>. Kawasan ini
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

        <!-- Kontak & Lokasi -->
        <div class="panel text-center space-y-3">
            <h3 class="text-lg font-bold text-slate-900">Tertarik Melakukan Penelitian?</h3>
            <p class="text-slate-600 text-sm max-w-lg mx-auto">
                Stasiun Penelitian Soraya terbuka bagi instansi pendidikan dan lembaga konservasi yang ingin mempelajari
                ekosistem Leuser lebih dalam.
            </p>
            <a href="{{ route('home') }}" class="btn-primary px-6 py-2.5 text-sm">
                <i data-lucide="home" class="w-4 h-4"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
@endsection