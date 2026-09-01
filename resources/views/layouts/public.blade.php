@extends('layouts.app')

@section('body_class', 'bg-white text-slate-900 selection:bg-cyan-300 selection:text-slate-950')

@section('body')
    @php
        $menuLabelByUrl = [
            '#beranda' => __('ui.public.nav.home'),
            '#profil' => __('ui.public.nav.profile'),
            '#program' => __('ui.public.nav.program'),
            '#publikasi' => __('ui.public.nav.publication'),
            '#potensi' => __('ui.public.nav.potential'),
            '#kerjasama' => __('ui.public.nav.cooperation'),
            '#layanan' => __('ui.public.nav.service'),
            '#kontak' => __('ui.public.nav.contact'),
        ];

        $groupedMenus = [
            [
                'label' => app()->isLocale('en') ? 'About' : 'Tentang',
                'items' => [
                    ['label' => __('ui.public.nav.profile'), 'url' => '#profil'],
                    ['label' => __('ui.public.nav.potential'), 'url' => '#potensi'],
                    ['label' => __('ui.public.nav.cooperation'), 'url' => '#kerjasama'],
                ],
            ],
            [
                'label' => app()->isLocale('en') ? 'Explore' : 'Jelajahi',
                'items' => [
                    ['label' => __('ui.public.nav.program'), 'url' => '#program'],
                    ['label' => __('ui.public.nav.publication'), 'url' => '#publikasi'],
                    ['label' => __('ui.public.nav.service'), 'url' => '#layanan'],
                    ['label' => __('ui.public.nav.contact'), 'url' => '#kontak'],
                ],
            ],
            [
                'label' => app()->isLocale('en') ? 'Marketplace' : 'Marketplace',
                'items' => [
                    ['label' => app()->isLocale('en') ? 'Products' : 'Produk', 'url' => route('public.products.index'), 'active' => request()->routeIs('public.products.*')],
                    ['label' => app()->isLocale('en') ? 'Industries' : 'Industri', 'url' => route('public.industries.index'), 'active' => request()->routeIs('public.industries.*')],
                ],
            ],
        ];
    @endphp

    <div class="guest-light relative overflow-x-clip bg-[var(--color-background)]">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-[30rem] bg-[radial-gradient(circle_at_top,_rgba(188,41,30,0.12),_transparent_42%),linear-gradient(180deg,rgba(18,34,68,0.05),transparent_75%)]"></div>

        <header class="sticky top-0 z-40 border-b border-white/10 bg-[var(--color-primary-900)]/95 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-4">
                    <div class="flex h-12 w-32 items-center overflow-hidden rounded-xl px-2 py-1 shadow-[0_10px_25px_rgba(6,22,58,0.22)]">
                        <img
                            src="https://imtgt.org/wp-content/uploads/2020/11/LOGO-RED-WHITE-1-1536x768.png"
                            alt="IMT-GT Logo"
                            class="h-full w-full object-contain"
                        >
                        <img
                            src="https://imtgt.org/wp-content/uploads/2025/12/WGTI-2048x2048.png"
                            alt="IMT-GT Logo"
                            class="h-full w-full object-contain"
                        >

                    </div>

                </a>

                <nav class="hidden items-center gap-3 text-sm font-medium text-slate-600 lg:flex">
                    <a class="imtgt-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}#beranda">
                        {{ __('ui.public.nav.home') }}
                    </a>

                    @foreach ($groupedMenus as $group)
                        @php
                            $isGroupActive = collect($group['items'])->contains(function ($item) {
                                return ! empty($item['active']);
                            });
                        @endphp
                        <div class="group relative">
                            <button type="button" class="imtgt-nav-trigger {{ $isGroupActive ? 'is-active' : '' }}">
                                <span>{{ $group['label'] }}</span>
                                <svg viewBox="0 0 20 20" class="h-4 w-4 transition group-hover:rotate-180" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.1 1.02l-4.25 4.5a.75.75 0 0 1-1.1 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <div class="invisible absolute left-0 top-full z-50 w-64 pt-2 opacity-0 transition duration-200 group-hover:visible group-hover:opacity-100">
                                <div class="imtgt-nav-dropdown translate-y-2 p-3 transition duration-200 group-hover:translate-y-0">
                                    @foreach ($group['items'] as $item)
                                        <a
                                            href="{{ $item['url'] }}"
                                            class="imtgt-nav-dropdown-link {{ ! empty($item['active']) ? 'is-active' : '' }} mb-1 last:mb-0"
                                        >
                                            <span>{{ $item['label'] }}</span>
                                            <svg viewBox="0 0 20 20" class="h-4 w-4" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 0 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </nav>

                <div class="hidden items-center gap-3 lg:flex">
                    <form action="{{ route('locale.switch') }}" method="POST" class="inline-flex rounded-full border border-white/10 bg-white/8 p-1 text-xs font-semibold text-white/70">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                        @foreach (($availableLocales ?? []) as $localeCode => $localeName)
                            <button
                                type="submit"
                                name="locale"
                                value="{{ $localeCode }}"
                                class="{{ ($currentLocale ?? app()->getLocale()) === $localeCode ? 'bg-white text-[var(--color-primary-900)] shadow-sm' : 'text-white/65' }} rounded-full px-3 py-1.5 transition"
                            >
                                {{ $localeName }}
                            </button>
                        @endforeach
                    </form>
                    @auth
                        <a href="{{ auth()->user()?->hasPermissionTo('dashboard.view') ? route('admin.dashboard') : route('account.company-profile.edit') }}" class="imtgt-button imtgt-button-secondary">{{ auth()->user()?->hasPermissionTo('dashboard.view') ? __('ui.public.dashboard') : (app()->isLocale('en') ? 'My Company Profile' : 'Profil Perusahaan Saya') }}</a>
                    @else
                        <a href="{{ route('registration.create') }}" class="imtgt-button imtgt-button-primary">{{ app()->isLocale('en') ? 'Register Business' : 'Registrasi Bisnis' }}</a>
                        <a href="{{ route('login') }}" class="imtgt-button imtgt-button-secondary">{{ app()->isLocale('en') ? 'Login' : 'Login' }}</a>
                    @endauth
                </div>
            </div>
        </header>

        @yield('content')
    </div>
@endsection
