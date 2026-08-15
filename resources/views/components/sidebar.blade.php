<aside class="w-64 bg-slate-900 text-slate-300 'hidden' flex-col justify-between hidden md:flex min-h-screen">
    <div>
        <!-- Brand / Logo -->
        <div class="p-6 border-b border-slate-800 flex items-center gap-3">
            <div class="p-2 bg-emerald-500 rounded-lg text-white">
                <i data-lucide="tree-pine" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="font-bold text-white text-base leading-none">DigiFlora</h2>
                <span class="text-[10px] text-slate-400">Stasiun Soraya</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.plants.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.plants.*') ? 'bg-emerald-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                <i data-lucide="leaf" class="w-5 h-5"></i>
                <span>Kelola Tumbuhan</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-colors">
                <i data-lucide="external-link" class="w-5 h-5"></i>
                <span>Lihat Tampilan Publik</span>
            </a>
        </nav>
    </div>

    <!-- User Info Footer -->
    <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
        DigiFlora v1.0 &copy; 2026
    </div>
</aside>