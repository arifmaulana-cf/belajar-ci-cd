@extends('layouts.app')

@section('title', 'DigiFlora - Scan QR Code')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<section class="parallax-bg relative rounded-[2rem] overflow-hidden shadow-2xl shadow-slate-900/20 reveal -mx-4 sm:-mx-6 lg:-mx-8 min-h-[72vh] flex items-center justify-center px-4 sm:px-6">
    <div class="absolute inset-0 parallax-overlay"></div>
    <div class="orb w-64 h-64 bg-brand-500/20 -top-20 -left-16 animate-blob" data-parallax="0.1"></div>
    <div class="orb w-64 h-64 bg-emerald-400/15 -bottom-20 -right-16 animate-blob animation-delay-4000" data-parallax="0.14"></div>

    <!-- Kartu Scanner -->
    <div class="relative w-full max-w-md bg-gradient-to-br from-ink-900 to-ink-800 text-white rounded-[2rem] p-6 sm:p-7 text-center shadow-2xl shadow-slate-900/30 relative overflow-hidden border border-white/10">
        <div class="orb w-48 h-48 bg-brand-500/25 -top-16 -right-16 animate-blob"></div>
        <div class="orb w-48 h-48 bg-emerald-400/15 -bottom-16 -left-16 animate-blob animation-delay-4000"></div>

        <div class="relative inline-flex p-3 bg-white/10 rounded-2xl mb-4 ring-1 ring-white/15">
            <i data-lucide="scan-line" class="w-7 h-7 text-brand-300"></i>
        </div>
        <h2 class="relative display-title text-white text-2xl mb-1.5">Scan QR Code Tumbuhan</h2>
        <p class="relative text-xs sm:text-sm text-slate-400 mb-6 max-w-sm mx-auto leading-relaxed">Arahkan kamera smartphone kamu ke kode QR di papan identitas tumbuhan.</p>

        <!-- Frame Kamera -->
        <div class="relative w-full h-[380px] sm:h-[420px] bg-black/50 rounded-2xl border border-white/10 overflow-hidden shadow-inner">
            <!-- Sudut dekoratif -->
            <div class="absolute top-3 left-3 w-9 h-9 border-t-[3px] border-l-[3px] border-brand-400 rounded-tl-xl z-10"></div>
            <div class="absolute top-3 right-3 w-9 h-9 border-t-[3px] border-r-[3px] border-brand-400 rounded-tr-xl z-10"></div>
            <div class="absolute bottom-3 left-3 w-9 h-9 border-b-[3px] border-l-[3px] border-brand-400 rounded-bl-xl z-10"></div>
            <div class="absolute bottom-3 right-3 w-9 h-9 border-b-[3px] border-r-[3px] border-brand-400 rounded-br-xl z-10"></div>

            <!-- Garis pemindai animasi (di atas video) -->
            <div class="absolute inset-x-8 h-[3px] bg-gradient-to-r from-transparent via-emerald-400 to-transparent animate-scan-line z-10 pointer-events-none shadow-[0_0_12px_rgba(52,211,153,0.8)]"></div>

            <!-- Tempat kamera (diisi pustaka html5-qrcode) -->
            <div id="reader" class="absolute inset-0"></div>

            <div id="scanner-placeholder" class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                <span class="relative flex items-center justify-center">
                    <span class="absolute inline-flex w-16 h-16 bg-brand-400/30 rounded-full animate-pulse-ring"></span>
                    <i data-lucide="qr-code" class="w-12 h-12 text-brand-400 animate-pulse"></i>
                </span>
                <span class="text-xs text-slate-400">Menyalakan kamera...</span>
            </div>
        </div>

        <button id="start-scan-btn" class="hidden mt-6 btn bg-gradient-to-r from-brand-500 to-emerald-400 hover:from-brand-600 hover:to-emerald-500 text-white py-3 px-8 shadow-lg shadow-brand-500/30 text-sm">
            <i data-lucide="scan" class="w-5 h-5"></i>
            <span>Mulai Kamera</span>
        </button>
    </div>

</section>

@push('scripts')
<!-- HTML5 QR Code Scanner Library -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let html5QrCode;

    function startCameraScan() {
        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" },
            config,
            (decodedText, decodedResult) => {
                html5QrCode.stop().then(() => {
                    window.location.href = decodedText;
                }).catch(err => {
                    window.location.href = decodedText;
                });
            },
            (errorMessage) => { }
        ).then(() => {
            document.getElementById('scanner-placeholder').style.display = 'none';
        }).catch(err => {
            document.getElementById('scanner-placeholder').innerHTML =
                '<i data-lucide="camera-off" class="w-10 h-10 text-rose-400"></i>' +
                '<span class="text-xs text-slate-400 px-6 leading-relaxed">Gagal membuka kamera. Pastikan akses via HTTPS dan izin kamera diberikan di browser HP kamu.</span>';
            lucide.createIcons();
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        startCameraScan();
    });
</script>
@endpush
@endsection