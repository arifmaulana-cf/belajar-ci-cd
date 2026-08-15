@extends('layouts.app')

@section('title', 'DigiFlora - Beranda')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<!-- Container Utama Full-Width yang Memenuhi Halaman -->
<div class="w-full space-y-8 pb-4">

    <!-- 1. BAGIAN ATAS: Hero -->
    <div class="w-full rounded-3xl overflow-hidden shadow-sm relative">
        <div class="w-full h-64 sm:h-80 lg:h-96 relative">
            <img src="https://picsum.photos/seed/stasiunpenelitiansoraya/1400/700" alt="Stasiun Penelitian Soraya" class="w-full h-full object-cover">
            <div class="absolute inset-0 flex items-end p-6 sm:p-10 bg-gradient-to-t from-ink-900/90 via-ink-900/30 to-transparent">
                <div>
                    <span class="badge-brand mb-3 bg-white/90 text-brand-700 backdrop-blur">
                        <i data-lucide="map-pin" class="w-3 h-3"></i> Kawasan Ekosistem Leuser
                    </span>
                    <h2 class="text-white text-xl sm:text-3xl font-black tracking-wide uppercase drop-shadow-sm">Stasiun Penelitian Soraya</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. BAGIAN TENGAH: Tentang -->
    <div class="panel space-y-4">
        <div class="flex items-center gap-3">
            <span class="p-2 bg-brand-50 rounded-xl text-brand-600"><i data-lucide="info" class="w-5 h-5"></i></span>
            <h2 class="section-title">Tentang Soraya</h2>
        </div>
        <p class="text-sm sm:text-base leading-relaxed text-slate-600 text-justify">
            Stasiun Penelitian Soraya merupakan salah satu pusat penelitian ekologi hutan hujan tropis yang penting dalam Kawasan Ekosistem Leuser. Kawasan ini memiliki keanekaragaman hayati yang tinggi, mencakup berbagai spesies flora dan fauna endemik. Sistem DigiFlora ini hadir untuk mempermudah digitalisasi identifikasi keanekaragaman tumbuhan berbasis QR Code di stasiun ini.
        </p>
    </div>

    <!-- 3. BAGIAN BAWAH: Galeri -->
    <div class="space-y-4 w-full">
        <div class="flex justify-between items-center px-1">
                <h2 class="section-title">Galeri</h2>
            <a href="{{ route('gallery') }}" class="btn-soft px-3 py-1.5 text-xs">
                Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- Grid Kartu Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestPlants as $plant)
            <div class="card card-plant card-hover p-4 flex flex-col">
                <div class="w-full h-52 sm:h-60 bg-slate-100 rounded-xl overflow-hidden border border-slate-100 mb-4">
                    <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}" alt="{{ $plant->nama_tumbuhan }}" class="w-full h-full object-cover">
                </div>
                <div class="space-y-1.5">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">{{ $plant->nama_tumbuhan }}</h3>
                    <p class="italic text-xs sm:text-sm text-brand-600">{{ $plant->nama_latin }}</p>
                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mt-1">{{ $plant->deskripsi }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full panel text-center text-slate-400 text-xs sm:text-sm">
                Belum ada data tumbuhan yang tersedia.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection