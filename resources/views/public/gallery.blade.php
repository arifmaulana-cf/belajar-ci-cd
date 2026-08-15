@extends('layouts.app')

@section('title', 'DigiFlora - Galeri Tumbuhan')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
    <div class="space-y-6">
        <div class="panel flex items-center justify-between">
            <div>
                <h2 class="section-title">Galeri Tumbuhan</h2>
                <p class="text-xs text-slate-500 mt-1">Koleksi spesies tumbuhan yang terdigitalisasi di Stasiun Soraya.</p>
            </div>
            <div class="hidden sm:block p-3 bg-brand-50 rounded-2xl text-brand-600">
                <i data-lucide="image" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Grid Kartu Tumbuhan -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($plants as $plant)
                <a href="{{ route('plant.detail', $plant->kode_tumbuhan) }}"
                    class="card card-hover p-4 flex flex-col space-y-3 h-full group">
                    <div class="w-full h-44 bg-slate-100 rounded-xl overflow-hidden border border-slate-100">
                        <img src="{{ filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : asset('storage/' . $plant->gambar) }}" alt="{{ $plant->nama_tumbuhan }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="grow">
                        <h3 class="font-bold text-slate-800 text-base">{{ $plant->nama_tumbuhan }}</h3>
                        <p class="text-xs italic text-brand-600 font-medium">{{ $plant->nama_latin }}</p>
                        @if($plant->famili)
                            <span class="badge-slate mt-2">{{ $plant->famili }}</span>
                        @endif
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed text-justify">
                            {{ Str::limit($plant->deskripsi, 120) }}
                        </p>
                    </div>

                    <span class="block text-center text-xs font-semibold bg-brand-50 text-brand-600 py-2 rounded-lg group-hover:bg-brand-100 transition-colors mt-auto">
                        Lihat Detail Spesies
                    </span>
                </a>
            @empty
                <div class="col-span-full panel text-center text-slate-400 text-xs">
                    Belum ada data tumbuhan yang dimasukkan.
                </div>
            @endforelse
        </div>
    </div>
@endsection