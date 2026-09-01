@extends('layouts.app')

@section('title', 'Login | '.config('app.name'))
@section('body_class', 'imtgt-shell')

@section('body')
    <div class="mx-auto flex min-h-screen max-w-6xl items-center px-6 py-10 lg:px-8">
        <div class="grid w-full gap-10 lg:grid-cols-[1fr_0.85fr]">
            <div class="hidden lg:block">
                <p class="text-sm uppercase tracking-[0.38em] text-cyan-200/70">Authentication</p>
                <h1 class="mt-4 font-['Playfair_Display'] text-5xl text-white">Masuk untuk melanjutkan akun bisnis Anda.</h1>
                <p class="mt-5 max-w-xl text-lg leading-8 text-slate-300">Setelah registrasi, login di sini untuk melengkapi profil perusahaan. Admin juga tetap dapat memakai halaman yang sama untuk masuk ke dashboard.</p>
            </div>

            <div class="imtgt-card p-8 lg:p-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <h2 class="text-2xl font-semibold text-white">Login</h2>
                <p class="mt-2 text-sm text-slate-300">Gunakan akun Anda untuk masuk ke dashboard admin atau melengkapi profil perusahaan.</p>

                <form action="{{ route('login.store') }}" method="POST" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="imtgt-input" placeholder="admin@imtgt.test" required autofocus>
                        @error('email')
                            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-200">Password</label>
                        <input id="password" name="password" type="password" class="imtgt-input" placeholder="password" required>
                        @error('password')
                            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-3 text-sm text-slate-300">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-slate-900">
                        Ingat sesi login saya
                    </label>

                    <button type="submit" class="imtgt-button imtgt-button-primary w-full">Masuk</button>
                </form>

                <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 px-4 py-4 text-sm text-slate-300">
                    Belum punya akun bisnis?
                    <a href="{{ route('registration.create') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
@endsection
