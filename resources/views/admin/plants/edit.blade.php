@extends('layouts.admin')

@section('title', 'Edit Tumbuhan - DigiFlora Admin')
@section('page_title', 'Edit Data Tumbuhan')

@section('content')
<div class="max-w-3xl mx-auto card mt-2">
    <div class="flex items-center justify-between border-b border-slate-100 p-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Edit Data Tumbuhan</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi detail dan dokumentasi tumbuhan.</p>
        </div>
        <a href="{{ route('admin.plants.index') }}" class="btn-ghost px-4 py-2 text-xs">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="p-6">
        @if ($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl text-sm">
                <p class="font-bold mb-1 flex items-center gap-1.5"><i data-lucide="alert-circle" class="w-4 h-4"></i> Terjadi kesalahan pengisian:</p>
                <ul class="list-disc list-inside space-y-0.5 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.plants.update', $plant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="field-label">Kode Tumbuhan / No. Registrasi</label>
                    <input type="text" name="kode_tumbuhan" value="{{ old('kode_tumbuhan', $plant->kode_tumbuhan) }}" required
                        class="field">
                </div>
                <div>
                    <label class="field-label">Nama Famili Suku</label>
                    <input type="text" name="famili" value="{{ old('famili', $plant->famili) }}"
                        class="field">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="field-label">Nama Lokal / Umum</label>
                    <input type="text" name="nama_tumbuhan" value="{{ old('nama_tumbuhan', $plant->nama_tumbuhan) }}" required
                        class="field">
                </div>
                <div>
                    <label class="field-label">Nama Ilmiah / Latin</label>
                    <input type="text" name="nama_latin" value="{{ old('nama_latin', $plant->nama_latin) }}" required
                        class="field">
                </div>
            </div>

            <div>
                <label class="field-label">Titik Koordinat Lokasi (GPS)</label>
                <input type="text" name="lokasi_koordinat" value="{{ old('lokasi_koordinat', $plant->lokasi_koordinat) }}"
                    class="field">
            </div>

            <div>
                <label class="field-label">Deskripsi & Karakteristik Tumbuhan</label>
                <textarea rows="4" name="deskripsi" required
                    class="field">{{ old('deskripsi', $plant->deskripsi) }}</textarea>
            </div>

            <!-- Opsi Upload Gambar -->
            <div class="space-y-4 p-5 bg-slate-50 rounded-2xl border border-slate-200">
                <label class="field-label">Dokumentasi Gambar Tumbuhan</label>

                @if($plant->gambar)
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-xs text-slate-500">Gambar Saat Ini:</span>
                        @if(filter_var($plant->gambar, FILTER_VALIDATE_URL))
                            <img src="{{ $plant->gambar }}" class="w-14 h-14 rounded-lg object-cover border border-slate-200">
                        @else
                            <img src="{{ asset('storage/' . $plant->gambar) }}" class="w-14 h-14 rounded-lg object-cover border border-slate-200">
                        @endif
                    </div>
                @endif

                <div>
                    <label class="block text-[11px] font-semibold text-slate-600 mb-1">1. Ganti File dari Perangkat (Opsional)</label>
                    <input type="file" name="gambar_file" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                </div>

                <div class="relative flex py-1 items-center">
                    <div class="grow border-t border-slate-200"></div>
                    <span class="shrink mx-4 text-slate-400 text-xs font-bold uppercase">Atau</span>
                    <div class="grow border-t border-slate-200"></div>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-600 mb-1">2. Ganti Tautan Gambar Eksternal (URL)</label>
                    <input type="url" name="gambar_url" value="{{ old('gambar_url', filter_var($plant->gambar, FILTER_VALIDATE_URL) ? $plant->gambar : '') }}" placeholder="https://..."
                        class="field bg-white">
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="btn-primary-lg">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection