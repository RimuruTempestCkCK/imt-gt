@extends('layouts.app')

@section('body_class', 'bg-slate-50')

@section('body')
    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <aside class="border-b border-slate-200 bg-white px-6 py-6 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto lg:border-b-0 lg:border-r">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4">
                <div class="flex h-12 w-28 items-center overflow-hidden rounded-xl bg-white px-2 py-1 shadow-sm border border-slate-100">
                    <img
                        src="https://imtgt.org/wp-content/uploads/2020/11/LOGO-RED-WHITE-1-1536x768.png"
                        alt="IMT-GT Logo"
                        class="h-full w-full object-contain"
                    >
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">{{ data_get($siteSettings ?? [], 'app_name', 'IMT-GT') }}</p>
                    <p class="text-sm text-slate-500">{{ data_get($siteSettings ?? [], 'app_tagline', 'Indonesia IMT-GT Business Centre') }}</p>
                </div>
            </a>

            <nav class="mt-8 space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.dashboard') }}</a>
                <a href="{{ route('admin.users.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.users.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.user') }}</a>
                <a href="{{ route('admin.access.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.access.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.access') }}</a>
                
                <div class="pt-4 text-xs font-semibold uppercase tracking-[0.26em] text-slate-400">{{ __('ui.admin.core_cms') }}</div>
                <a href="{{ route('admin.news.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.news.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.news') }}</a>
                <a href="{{ route('admin.categories.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.categories.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.categories') }}</a>
                <a href="{{ route('admin.tags.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.tags.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.tags') }}</a>
                <a href="{{ route('admin.pages.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.pages.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.pages') }}</a>
                <a href="{{ route('admin.media.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.media.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.media') }}</a>
                <a href="{{ route('admin.banners.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.banners.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.banners') }}</a>
                <a href="{{ route('admin.menus.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.menus.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.menus') }}</a>
                <a href="{{ route('admin.greetings.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.greetings.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.greetings') }}</a>
                <a href="{{ route('admin.profiles.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.profiles.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.profiles') }}</a>
                <a href="{{ route('admin.product-categories.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.product-categories.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ app()->isLocale('en') ? 'Product Categories' : 'Kategori Produk' }}</a>
                <a href="{{ route('admin.settings.edit') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.settings.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.settings') }}</a>
                <a href="{{ route('admin.audit-logs.index') }}" class="block rounded-2xl px-4 py-3 transition {{ request()->routeIs('admin.audit-logs.*') ? 'bg-cyan-50 text-cyan-800 font-bold border border-cyan-100 shadow-sm relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1.5 before:bg-cyan-600' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 group flex items-center' }}">{{ __('ui.admin.audit_logs') }}</a>
            </nav>
        </aside>

        <div class="flex min-h-screen flex-col">
            <header class="border-b border-slate-200 bg-white px-6 py-4 xl:px-10">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('ui.admin.panel') }}</p>
                        <h1 class="mt-2 text-2xl font-semibold text-slate-900">@yield('heading', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('locale.switch') }}" method="POST" class="hidden rounded-full border border-slate-200 bg-slate-50 p-1 text-xs font-semibold text-slate-500 md:inline-flex">
                            @csrf
                            <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                            @foreach (($availableLocales ?? []) as $localeCode => $localeName)
                                <button
                                    type="submit"
                                    name="locale"
                                    value="{{ $localeCode }}"
                                    class="{{ ($currentLocale ?? app()->getLocale()) === $localeCode ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }} rounded-full px-3 py-1.5 transition"
                                >
                                    {{ $localeName }}
                                </button>
                            @endforeach
                        </form>
                        <span class="hidden rounded-full border border-slate-200 px-4 py-2 text-sm text-slate-600 md:inline-flex">{{ auth()->user()?->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="imtgt-button imtgt-button-secondary" type="submit">{{ __('ui.admin.logout') }}</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8 xl:px-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
@endsection
