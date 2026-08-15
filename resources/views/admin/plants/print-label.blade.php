<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Label QR Code - {{ $plant->nama_tumbuhan }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { background: white; margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-ink-50 min-h-screen flex flex-col items-center justify-center p-6">

    <!-- Tombol Cetak -->
    <div class="no-print mb-6">
        <button onclick="window.print()" class="btn-primary px-6 py-2.5 text-sm">
            <i data-lucide="printer" class="w-4 h-4"></i> Cetak Label (Print)
        </button>
    </div>

    <!-- Desain Papan Identitas Tumbuhan -->
    <div class="w-100 bg-white border-4 border-brand-800 rounded-3xl p-6 shadow-xl text-center space-y-4 relative overflow-hidden">
        <!-- Header Label -->
        <div class="border-b-2 border-brand-800 pb-3">
            <h1 class="text-lg font-black text-brand-900 tracking-wider uppercase">Stasiun Penelitian Soraya</h1>
            <p class="text-[10px] text-brand-700 font-semibold tracking-widest uppercase">Kawasan Ekosistem Leuser</p>
        </div>

        <!-- Nama Spesies -->
        <div>
            <h2 class="text-xl font-bold text-slate-900">{{ $plant->nama_tumbuhan }}</h2>
            <p class="text-sm italic font-serif text-brand-700">{{ $plant->nama_latin }}</p>
            <p class="text-xs text-slate-500 font-mono mt-1">Famili: {{ $plant->famili ?? 'N/A' }}</p>
        </div>

        <!-- QR Code -->
        <div class="flex justify-center my-2">
            <div class="p-3 bg-white border-2 border-slate-200 rounded-2xl shadow-inner">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ url('/tumbuhan/' . $plant->kode_tumbuhan) }}" alt="QR Code" class="w-44 h-44 object-contain">
            </div>
        </div>

        <!-- Footer Label -->
        <div class="bg-brand-900 text-white py-2 rounded-xl text-center">
            <p class="text-[10px] font-semibold tracking-wider uppercase">Pindai QR Code untuk Informasi Lengkap</p>
            <span class="text-[9px] font-mono opacity-80">ID: {{ $plant->kode_tumbuhan }}</span>
        </div>
    </div>

</body>
</html>