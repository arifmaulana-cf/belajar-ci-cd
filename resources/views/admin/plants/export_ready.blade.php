@extends('layouts.admin')

@section('title', 'Link Unduh Word')
@section('page_title', 'Menyiapkan File Dokumen')

@section('content')
<div class="max-w-2xl mx-auto card mt-10">
    <div class="p-10 text-center">
        <div class="relative inline-flex w-20 h-20 bg-brand-100 text-brand-600 rounded-full items-center justify-center mx-auto mb-6">
            <div class="absolute inset-0 bg-brand-100/50 rounded-full animate-ping"></div>
            <i data-lucide="file-check-2" class="w-10 h-10 relative"></i>
        </div>

        <h2 class="text-2xl font-bold text-slate-800 mb-3">File Word Berhasil Disusun!</h2>
        <p class="text-slate-600 mb-8 text-sm">
            Sistem secara otomatis telah menyusun data
            <strong>{{ $type == 'all' ? 'Seluruh Tumbuhan' : 'Label ' . $plant->nama_tumbuhan }}</strong>
            ke dalam format Microsoft Word.
        </p>

        <a href="{{ route('admin.plants.export-download', ['type' => $type, 'id' => $plant->id ?? '']) }}"
           onclick="return confirm('Apakah Anda yakin ingin mengunduh dokumen ini? \n\n(Catatan: Klik Yes/OK untuk mengunduh dan mencatat riwayat cetak ke database)');"
           class="btn-primary-lg w-full sm:w-auto">
           <i data-lucide="download" class="w-5 h-5"></i> Klik Disini Untuk Mengunduh (Link Unduh)
        </a>

        <div class="mt-8">
            <a href="{{ route('admin.plants.index') }}" class="text-sm font-medium text-slate-500 hover:text-brand-600 flex items-center justify-center gap-1 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Tabel
            </a>
        </div>
    </div>
</div>
@endsection