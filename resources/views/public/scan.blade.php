@extends('layouts.app')

@section('title', 'DigiFlora - Scan QR Code')

@section('bottom_nav')
    @include('components.footer')
@endsection

@section('content')
<div class="flex flex-col items-center justify-center min-h-[65vh]">

    <!-- Kartu Scanner -->
    <div class="w-full max-w-md bg-gradient-to-br from-ink-900 to-ink-800 text-white rounded-3xl p-6 text-center shadow-xl relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-48 h-48 bg-brand-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-emerald-400/10 rounded-full blur-3xl"></div>

        <div class="relative inline-flex p-3 bg-white/10 rounded-2xl mb-4 ring-1 ring-white/15">
            <i data-lucide="scan-line" class="w-7 h-7 text-brand-300"></i>
        </div>
        <h2 class="relative text-xl font-bold mb-1">Scan QR Code Tumbuhan</h2>
        <p class="relative text-xs sm:text-sm text-slate-400 mb-6 max-w-sm mx-auto">Arahkan kamera smartphone kamu ke kode QR di papan identitas tumbuhan.</p>

        <!-- Frame Kamera -->
        <div id="reader" class="relative w-full h-[380px] sm:h-[420px] bg-black/40 rounded-2xl border border-white/10 flex items-center justify-center overflow-hidden shadow-inner">
            <!-- Sudut dekoratif -->
            <div class="absolute top-3 left-3 w-8 h-8 border-t-2 border-l-2 border-brand-400 rounded-tl-lg"></div>
            <div class="absolute top-3 right-3 w-8 h-8 border-t-2 border-r-2 border-brand-400 rounded-tr-lg"></div>
            <div class="absolute bottom-3 left-3 w-8 h-8 border-b-2 border-l-2 border-brand-400 rounded-bl-lg"></div>
            <div class="absolute bottom-3 right-3 w-8 h-8 border-b-2 border-r-2 border-brand-400 rounded-br-lg"></div>

            <div id="scanner-placeholder" class="space-y-3">
                <i data-lucide="qr-code" class="w-20 h-20 text-brand-400 mx-auto animate-pulse"></i>
                <span class="text-xs text-slate-400 block">Menyalakan kamera...</span>
            </div>
        </div>

        <button id="start-scan-btn" class="hidden mt-6 btn bg-brand-500 hover:bg-brand-600 text-white py-3 px-8 shadow-lg shadow-brand-500/30 text-sm">
            <i data-lucide="scan" class="w-5 h-5"></i>
            <span>Mulai Kamera</span>
        </button>
    </div>

</div>

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
        ).catch(err => {
            alert("Gagal membuka kamera: " + err + "\n\nPastikan kamu mengakses menggunakan HTTPS via Ngrok dan memberikan izin akses kamera di browser HP kamu.");
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        startCameraScan();
    });
</script>
@endpush
@endsection