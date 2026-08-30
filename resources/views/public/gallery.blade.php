@extends('layouts.app')

@section('title', 'DigiFlora - Galeri Tumbuhan')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
    <div class="max-w-7xl mx-auto space-y-10">

        <!-- Header halaman (band parallax) -->
        <section class="parallax-bg relative rounded-[2rem] overflow-hidden shadow-xl shadow-brand-900/15 reveal min-h-[42vh] flex items-center"
            style="background-image:url('https://picsum.photos/seed/sorayagaleri/1600/900')">
            <div class="absolute inset-0 parallax-overlay"></div>
            <div class="orb w-64 h-64 bg-emerald-400/20 -top-20 -right-16 animate-blob" data-parallax="0.1"></div>
            <div class="orb w-56 h-56 bg-lime-400/10 -bottom-20 -left-16 animate-blob animation-delay-4000" data-parallax="0.14"></div>

            <div class="relative px-6 sm:px-10 py-10 sm:py-14 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 w-full">
                <div class="space-y-3">
                    <span class="inline-flex items-center gap-2 text-[11px] font-bold text-emerald-300 bg-white/10 ring-1 ring-white/15 rounded-full px-3.5 py-1.5">
                        <i data-lucide="images" class="w-3.5 h-3.5"></i> Katalog Digital
                    </span>
                    <h1 class="editorial-title text-white text-3xl sm:text-5xl">Galeri Tumbuhan</h1>
                    <p class="text-slate-200 text-xs sm:text-sm max-w-md">
                        Koleksi spesies tumbuhan yang terdigitalisasi di Stasiun Penelitian Soraya.
                        Klik kartu untuk melihat informasi lengkap.
                    </p>
                </div>
                <div class="hidden sm:flex p-4 bg-white/10 backdrop-blur-md rounded-2xl ring-1 ring-white/15 shadow-lg">
                    <i data-lucide="leaf" class="w-9 h-9 text-emerald-300 animate-float"></i>
                </div>
            </div>
        </section>

        <!-- Grid Kartu Tumbuhan -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($plants as $i => $plant)
                <a href="{{ route('plant.detail', $plant->kode_tumbuhan) }}"
                    class="card card-plant card-hover group overflow-hidden flex flex-col reveal reveal-delay-{{ ($i % 5) + 1 }}">
                    <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                        <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}" alt="{{ $plant->nama_tumbuhan }}"
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

                    <div class="p-5 grow flex flex-col space-y-1.5">
                        <h3 class="font-bold text-slate-800 text-base group-hover:text-brand-700 transition-colors">{{ $plant->nama_tumbuhan }}</h3>
                        <p class="text-xs italic text-brand-600 font-medium">{{ $plant->nama_latin }}</p>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed line-clamp-2">
                            {{ Str::limit($plant->deskripsi, 120) }}
                        </p>
                        <span class="mt-auto pt-4 text-[11px] font-semibold text-brand-600 inline-flex items-center gap-1">
                            Baca Informasi Lengkap <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full panel text-center text-slate-400 text-xs sm:text-sm py-10">
                    Belum ada data tumbuhan yang dimasukkan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($plants->hasPages())
            <div class="reveal">
                {{ $plants->links('pagination.brand') }}
            </div>
        @endif
    </div>
@endsection