@extends('layouts.app')

@section('title', 'Login Admin - DigiFlora')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md">

        <!-- Kartu Login Modern -->
        <div class="card card-hover shadow-xl">
            <!-- Header -->
            <div class="relative overflow-hidden bg-brand-600 px-8 pt-10 pb-12 text-center">
                <div class="relative inline-flex p-3.5 bg-white/15 backdrop-blur-sm rounded-2xl mb-4 ring-1 ring-white/20">
                    <i data-lucide="shield-check" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="relative text-2xl font-black text-white tracking-tight">Admin Login</h1>
                <p class="relative text-brand-100 text-xs mt-1.5">Masuk untuk mengelola data tumbuhan & QR Code</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8 bg-white">
                @if ($errors->any())
                    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl text-xs font-medium flex gap-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="field-label">Alamat Email</label>
                        <div class="relative">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@soraya.research"
                                class="field pl-10">
                        </div>
                    </div>

                    <div>
                        <label class="field-label">Kata Sandi (Password)</label>
                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="field pl-10">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-lg w-full">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Masuk ke Panel
                    </button>
                </form>

                <a href="{{ url('/') }}" class="flex items-center justify-center gap-1.5 text-xs text-slate-500 hover:text-brand-600 mt-6 transition-colors">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>
</div>
@endsection