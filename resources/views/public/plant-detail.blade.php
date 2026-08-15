@extends('layouts.app')

@section('title', $plant->nama_tumbuhan . ' - DigiFlora')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<div class="space-y-4">

    <!-- Tombol kembali -->
    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-brand-600 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Galeri
    </a>

    <!-- Header Gambar Tumbuhan -->
    <div class="relative w-full bg-slate-100 rounded-3xl overflow-hidden shadow-sm flex items-center justify-center border border-slate-200/70">
        @if($plant->gambar)
            @if(filter_var($plant->gambar, FILTER_VALIDATE_URL))
                <img src="{{ $plant->gambar }}" alt="{{ $plant->nama_tumbuhan }}" class="w-full h-auto max-h-[28rem] object-contain">
            @else
                <img src="{{ asset('storage/' . $plant->gambar) }}" alt="{{ $plant->nama_tumbuhan }}" class="w-full h-auto max-h-[28rem] object-contain">
            @endif
        @else
            <div class="w-full h-64 flex items-center justify-center text-slate-500">
                <i data-lucide="image" class="w-12 h-12"></i>
            </div>
        @endif

        <div class="absolute top-3 right-3 bg-white px-3 py-1 rounded-full text-xs font-semibold text-brand-700 shadow-sm border border-slate-200 z-10">
            {{ $plant->kode_tumbuhan }}
        </div>
    </div>

    <!-- Info Identitas -->
    <div class="panel space-y-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">{{ $plant->nama_tumbuhan }}</h1>
            <p class="text-sm italic font-medium text-brand-600">{{ $plant->nama_latin }}</p>
            @if($plant->famili)
                <span class="badge-slate mt-2">Famili: {{ $plant->famili }}</span>
            @endif
        </div>

        <hr class="border-slate-100">

        <!-- Deskripsi -->
        <div class="space-y-1.5">
            <h3 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i> Deskripsi & Karakteristik
            </h3>
            <p class="text-sm leading-relaxed text-slate-700 text-justify">
                {{ $plant->deskripsi }}
            </p>
        </div>

        @if($plant->lokasi_koordinat)
        <div class="pt-1">
            <a href="https://maps.google.com/?q={{ $plant->lokasi_koordinat }}" target="_blank" class="btn-soft w-full">
                <i data-lucide="map-pin" class="w-4 h-4"></i>
                Lihat Titik Koordinat Posisi
            </a>
        </div>
        @endif
    </div>
</div>
@endsection