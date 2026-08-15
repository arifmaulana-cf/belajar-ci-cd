<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - DigiFlora Soraya')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-ink-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <!-- Topbar -->
    <header class="bg-ink-900 text-white px-6 py-4 flex items-center justify-between shadow-sm sticky top-0 z-40">
        <!-- Kiri: Logo & Nama -->
        <div class="flex items-center gap-3">
            <div class="p-2 bg-brand-600 rounded-xl text-white shadow-sm shadow-brand-600/30">
                <i data-lucide="tree-pine" class="w-5 h-5"></i>
            </div>
            <div>
                <h2 class="font-bold text-white text-lg leading-tight tracking-wide">DigiFlora</h2>
                <span class="text-[10px] text-brand-300 font-medium uppercase tracking-wider">Stasiun Penelitian
                    Soraya</span>
            </div>
        </div>

        <!-- Tengah: Judul Halaman -->
        <h1 class="hidden md:block text-base font-bold text-white">@yield('page_title', 'Dashboard')</h1>

        <!-- Kanan: Status Admin & Logout -->
        <div class="flex items-center gap-3">
            <span
                class="hidden sm:inline-flex text-xs bg-brand-50 text-brand-700 font-semibold px-3 py-1.5 rounded-full border border-brand-200">
                <i data-lucide="user" class="w-3.5 h-3.5 mr-1.5"></i> Admin Stasiun Soraya
            </span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="btn bg-rose-500/90 hover:bg-rose-500 text-white px-3 py-1.5 text-xs">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto w-full">
        @if (session('success'))
            <div
                class="mb-6 p-4 bg-brand-50 border border-brand-200 text-brand-700 text-sm rounded-xl flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>

</html>