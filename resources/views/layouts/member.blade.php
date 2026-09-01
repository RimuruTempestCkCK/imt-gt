@extends('layouts.app')

@section('body_class', 'imtgt-shell')

@section('body')
    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <aside class="border-b border-white/10 bg-slate-950/70 px-6 py-6 backdrop-blur-xl lg:border-b-0 lg:border-r">
            <a href="{{ route('home') }}" class="flex items-center gap-4">
                <div class="flex h-12 w-28 items-center overflow-hidden rounded-xl bg-white px-2 py-1 shadow-[0_10px_25px_rgba(6,22,58,0.18)]">
                    <img
                        src="https://imtgt.org/wp-content/uploads/2020/11/LOGO-RED-WHITE-1-1536x768.png"
                        alt="IMT-GT Logo"
                        class="h-full w-full object-contain"
                    >
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200/80">{{ data_get($siteSettings ?? [], 'app_name', 'IMT-GT') }}</p>
                    <p class="text-sm text-slate-300">{{ app()->isLocale('en') ? 'Business Member Area' : 'Area Member Bisnis' }}</p>
                </div>
            </a>

            <nav class="mt-8 space-y-2 text-sm">
                <div class="pt-2 text-xs font-semibold uppercase tracking-[0.26em] text-slate-500">{{ app()->isLocale('en') ? 'Member Menu' : 'Menu Member' }}</div>
                <a href="{{ route('account.dashboard') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('account.dashboard') ? 'bg-cyan-500/20 text-cyan-200 font-semibold border border-cyan-500/30' : 'text-slate-100 hover:bg-white/10' }}">
                    Dashboard
                </a>
                <a href="{{ route('account.products.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('account.products.*') ? 'bg-cyan-500/20 text-cyan-200 font-semibold border border-cyan-500/30' : 'text-slate-100 hover:bg-white/10' }}">
                    {{ app()->isLocale('en') ? 'My Products' : 'Produk Saya' }}
                </a>
                <a href="{{ route('account.company-profile.edit') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('account.company-profile.*') ? 'bg-cyan-500/20 text-cyan-200 font-semibold border border-cyan-500/30' : 'text-slate-100 hover:bg-white/10' }}">
                    {{ app()->isLocale('en') ? 'Company Profile' : 'Profil Perusahaan' }}
                </a>
            </nav>
        </aside>

        <div class="flex min-h-screen flex-col">
            <header class="border-b border-white/10 bg-slate-950/50 px-6 py-4 backdrop-blur xl:px-10">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-cyan-200/70">{{ app()->isLocale('en') ? 'Business Onboarding' : 'Onboarding Bisnis' }}</p>
                        <h1 class="mt-2 text-2xl font-semibold text-white">@yield('heading', app()->isLocale('en') ? 'Company Profile' : 'Profil Perusahaan')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('locale.switch') }}" method="POST" class="hidden rounded-full border border-white/10 bg-white/5 p-1 text-xs font-semibold text-slate-300 md:inline-flex">
                            @csrf
                            <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                            @foreach (($availableLocales ?? []) as $localeCode => $localeName)
                                <button
                                    type="submit"
                                    name="locale"
                                    value="{{ $localeCode }}"
                                    class="{{ ($currentLocale ?? app()->getLocale()) === $localeCode ? 'bg-white text-slate-900' : 'text-slate-300' }} rounded-full px-3 py-1.5 transition"
                                >
                                    {{ $localeName }}
                                </button>
                            @endforeach
                        </form>
                        <span class="hidden rounded-full border border-white/10 px-4 py-2 text-sm text-slate-300 md:inline-flex">{{ auth()->user()?->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="imtgt-button imtgt-button-secondary" type="submit">{{ app()->isLocale('en') ? 'Logout' : 'Logout' }}</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8 xl:px-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
@endsection
