@extends('layouts.app')

@section('title', $plant->nama_tumbuhan . ' - DigiFlora')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Tombol kembali -->
    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-brand-600 transition-colors reveal">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Galeri
    </a>

    <!-- Kartu Utama: Gambar (hero parallax) -->
    <section class="parallax-bg relative rounded-[2rem] overflow-hidden shadow-xl shadow-slate-900/10 reveal min-h-[55vh] sm:min-h-[60vh] flex items-end"
        style="background-image:url('{{ $plant->gambar ? (filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar)) : 'https://picsum.photos/seed/sorayaplant/1600/900' }}')">
        <div class="absolute inset-0 parallax-overlay"></div>

        <!-- Badge kode (kaca) -->
        <span class="absolute top-4 right-4 glass px-4 py-2 rounded-full text-xs font-bold text-brand-700 shadow-lg z-10">
            <i data-lucide="tag" class="w-3.5 h-3.5 inline mr-1"></i>
            {{ $plant->kode_tumbuhan }}
        </span>

        <div class="relative p-6 sm:p-10 w-full space-y-2">
            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-200 bg-white/10 ring-1 ring-white/15 rounded-full px-3 py-1.5 backdrop-blur">
                <i data-lucide="scan-line" class="w-3.5 h-3.5"></i> Teridentifikasi via QR Code
            </span>
            <h1 class="editorial-title text-white text-3xl sm:text-5xl lg:text-6xl">{{ $plant->nama_tumbuhan }}</h1>
            <p class="text-sm italic font-medium text-emerald-200">{{ $plant->nama_latin }}</p>
        </div>
    </section>

    <!-- Info Identitas -->
    <section class="grid lg:grid-cols-3 gap-6">
        <!-- Panel utama -->
        <div class="lg:col-span-2 panel space-y-6 reveal reveal-delay-1">
            <div class="space-y-2">
                <span class="section-chip">
                    <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i> Identitas Spesies
                </span>
                <h1 class="display-title text-3xl sm:text-4xl">{{ $plant->nama_tumbuhan }}</h1>
                <p class="text-sm italic font-medium text-brand-600">{{ $plant->nama_latin }}</p>
            </div>

            <hr class="border-slate-100">

            <!-- Deskripsi -->
            <div class="space-y-2.5">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                    <i data-lucide="book-open" class="w-3.5 h-3.5"></i> Deskripsi & Karakteristik
                </h3>
                <p class="text-sm leading-relaxed text-slate-700 text-justify">
                    {{ $plant->deskripsi }}
                </p>
            </div>

            @if($plant->lokasi_koordinat)
            <div class="pt-2">
                <a href="https://maps.google.com/?q={{ $plant->lokasi_koordinat }}" target="_blank" class="btn-soft w-full sm:w-auto">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    Lihat Titik Koordinat Posisi
                </a>
            </div>
            @endif
        </div>

        <!-- Panel samping: info ringkas -->
        <div class="space-y-6 reveal reveal-delay-2">
            <div class="panel">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-1.5">
                    <i data-lucide="info" class="w-3.5 h-3.5"></i> Informasi Ringkas
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 p-2 bg-brand-50 rounded-lg text-brand-600">
                            <i data-lucide="hash" class="w-4 h-4"></i>
                        </span>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Kode Tumbuhan</p>
                            <p class="text-sm font-bold text-slate-800">{{ $plant->kode_tumbuhan }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 p-2 bg-brand-50 rounded-lg text-brand-600">
                            <i data-lucide="microscope" class="w-4 h-4"></i>
                        </span>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Nama Latin</p>
                            <p class="text-sm font-bold text-slate-800 italic">{{ $plant->nama_latin }}</p>
                        </div>
                    </li>
                    @if($plant->famili)
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 p-2 bg-brand-50 rounded-lg text-brand-600">
                            <i data-lucide="git-branch" class="w-4 h-4"></i>
                        </span>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Famili</p>
                            <p class="text-sm font-bold text-slate-800">{{ $plant->famili }}</p>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-brand-600 to-brand-800 p-5 text-white shadow-lg shadow-brand-600/20">
                <div class="orb w-32 h-32 bg-white/10 -top-10 -right-10 rounded-full blur-2xl"></div>
                <div class="relative flex items-start gap-3">
                    <span class="shrink-0 p-2 bg-white/15 rounded-xl ring-1 ring-white/20">
                        <i data-lucide="qr-code" class="w-5 h-5 text-emerald-200"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold">Temukan di Lapangan</p>
                        <p class="text-xs text-brand-100/90 leading-relaxed mt-1">
                            Cari papan identitas ber-QR Code spesies ini di jalur penelitian Stasiun Soraya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection