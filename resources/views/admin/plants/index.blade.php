@extends('layouts.admin')

@section('title', 'Daftar Tumbuhan - DigiFlora Admin')
@section('page_title', 'Kelola Data Tumbuhan')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="panel flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-800">Data Tumbuhan Terdaftar</p>
                <p class="text-xs text-slate-500">Total data tumbuhan di Stasiun Penelitian Soraya.</p>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('admin.plants.export-ready', ['type' => 'all']) }}"
                    class="btn-outline px-4 py-2.5 text-xs">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Cetak semua data (Word)
                </a>

                <a href="{{ route('admin.plants.create') }}"
                    class="btn-primary px-4 py-2.5 text-xs">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Tumbuhan Baru
                </a>
            </div>
        </div>

        <!-- Table Data -->
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[760px]">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="p-4">Kode</th>
                            <th class="p-4">Gambar</th>
                            <th class="p-4">Nama Tumbuhan / Latin</th>
                            <th class="p-4">Famili</th>
                            <th class="p-4 text-center">QR Code</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($plants as $plant)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="p-4 font-bold text-slate-700">{{ $plant->kode_tumbuhan }}</td>
                                <td class="p-4">
                                    @if ($plant->gambar)
                                        @if (filter_var($plant->gambar, FILTER_VALIDATE_URL))
                                            <img src="{{ $plant->gambar }}"
                                                class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <img src="{{ asset('storage/' . $plant->gambar) }}"
                                                class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                        @endif
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                            <i data-lucide="image" class="w-5 h-5"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">{{ $plant->nama_tumbuhan }}</div>
                                    <div class="italic text-slate-500">{{ $plant->nama_latin }}</div>
                                </td>
                                <td class="p-4 text-slate-600">{{ $plant->famili ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ url('/tumbuhan/' . $plant->kode_tumbuhan) }}"
                                        target="_blank"
                                        class="inline-flex p-2 bg-slate-100 hover:bg-brand-50 rounded-lg border border-slate-200 transition-colors"
                                        title="Lihat/Download QR Code">
                                        <i data-lucide="qr-code" class="w-5 h-5 text-brand-600"></i>
                                    </a>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.plants.edit', $plant->id) }}"
                                        class="inline-flex items-center gap-1 text-sky-600 hover:text-sky-800 font-semibold px-2 py-1.5 rounded-lg hover:bg-sky-50 transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                                    </a>

                                    <a href="{{ route('admin.plants.export-ready', ['type' => 'single', 'id' => $plant->id]) }}"
                                        class="inline-flex items-center gap-1 text-slate-600 hover:text-brand-600 font-semibold px-2 py-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                                        <i data-lucide="printer" class="w-4 h-4"></i> Cetak
                                    </a>

                                    <form action="{{ route('admin.plants.destroy', $plant->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center text-rose-600 hover:text-rose-800 font-semibold px-2 py-1.5 rounded-lg hover:bg-rose-50 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-400">
                                    Belum ada data tumbuhan. Klik tombol di atas untuk membuat data baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div>
            {{ $plants->links('pagination.brand') }}
        </div>
    </div>
@endsection