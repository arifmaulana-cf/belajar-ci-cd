<nav class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t border-slate-200 pb-[env(safe-area-inset-bottom)]">
    <div class="max-w-md mx-auto grid grid-cols-3 items-end px-4 pt-2 pb-1">
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-xs font-medium {{ request()->routeIs('home') ? 'text-brand-600' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('scan') }}" class="flex flex-col items-center justify-center -mt-7 text-white" aria-label="Scan QR Code">
            <span class="flex items-center justify-center w-14 h-14 rounded-full bg-brand-600 shadow-lg shadow-brand-600/30 ring-4 ring-white">
                <i data-lucide="qr-code" class="w-6 h-6"></i>
            </span>
        </a>

        <a href="{{ route('gallery') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-xs font-medium {{ request()->routeIs('gallery') ? 'text-brand-600' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
            <i data-lucide="image" class="w-5 h-5"></i>
            <span>Galeri</span>
        </a>
    </div>
</nav>
