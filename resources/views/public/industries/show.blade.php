@php
    $isEnglish = app()->isLocale('en');
@endphp

@extends('layouts.public')

@section('title', trim(($industry->company_prefix ? $industry->company_prefix.' ' : '').$industry->company_name))

@section('content')
    <main class="pb-20 pt-8">
        <section class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="transition hover:text-cyan-700">{{ $isEnglish ? 'Home' : 'Beranda' }}</a>
                <span>/</span>
                <a href="{{ route('public.industries.index') }}" class="transition hover:text-cyan-700">{{ $isEnglish ? 'Industries' : 'Industri' }}</a>
                <span>/</span>
                <span class="text-slate-900">{{ trim(($industry->company_prefix ? $industry->company_prefix.' ' : '').$industry->company_name) }}</span>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.08)]">
                <div class="grid gap-8 p-8 lg:grid-cols-[1.1fr_0.9fr] lg:p-10">
                    <div>
                        <div class="flex flex-wrap gap-2">
                            @if ($industry->type_of_business)
                                <span class="rounded-full bg-cyan-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-cyan-700">{{ ucfirst($industry->type_of_business) }}</span>
                            @endif
                            @if ($industry->scale_of_business)
                                <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-slate-600">{{ $industry->scale_of_business }}</span>
                            @endif
                        </div>
                        <h1 class="mt-4 font-['Playfair_Display'] text-4xl leading-tight text-slate-950 lg:text-5xl">{{ trim(($industry->company_prefix ? $industry->company_prefix.' ' : '').$industry->company_name) }}</h1>
                        <p class="mt-4 max-w-3xl text-base leading-8 text-slate-600">{{ $industry->company_description ?: ($industry->main_product ?: '-') }}</p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-[1.4rem] bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Location' : 'Lokasi' }}</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $industry->region?->name ?? $industry->province ?? '-' }}</p>
                                <p class="text-sm text-slate-500">{{ $industry->country?->name ?? '-' }}</p>
                            </div>
                            <div class="rounded-[1.4rem] bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Main Product' : 'Produk Utama' }}</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $industry->main_product ?: '-' }}</p>
                            </div>
                            <div class="rounded-[1.4rem] bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Published Products' : 'Produk Publish' }}</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $industry->products->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[1.75rem] border border-slate-200 bg-[linear-gradient(135deg,#ecfeff_0%,#ffffff_100%)] p-6 md:p-8">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                            <div class="flex h-32 w-32 shrink-0 items-center justify-center overflow-hidden rounded-[1.8rem] bg-white shadow-sm border border-slate-100">
                                @if ($industry->logo_path)
                                    <img src="{{ asset('storage/'.$industry->logo_path) }}" alt="{{ $industry->company_name }}" class="h-full w-full object-contain p-1">
                                @else
                                    <svg viewBox="0 0 80 80" class="h-14 w-14 text-slate-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="14"/><path d="M15 72c4-17 13-26 25-26s21 9 25 26H15Z"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Company Profile' : 'Profil Perusahaan' }}</p>
                                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Structured to mimic a modern B2B company page: trust signals first, operational details second, product evidence third.' : 'Disusun menyerupai company page B2B modern: trust signal lebih dulu, detail operasional kedua, bukti produk ketiga.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid gap-8 xl:grid-cols-[1fr_24rem]">
                <div class="space-y-8">
                    <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Business Overview' : 'Gambaran Bisnis' }}</h2>
                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Established' : 'Berdiri' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $industry->year_of_establishment ?: '-' }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Employees' : 'Karyawan' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $industry->employee_count ?: '-' }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">Incoterm</p><p class="mt-2 font-semibold text-slate-900">{{ $industry->incoterm ?: '-' }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Terms of Payment' : 'Terms of Payment' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $industry->terms_of_payment ?: '-' }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">Website</p><p class="mt-2 font-semibold text-slate-900 break-all">{{ $industry->website ?: '-' }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Business Phone' : 'Telepon Bisnis' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $industry->business_phone ?: '-' }}</p></div>
                        </div>

                        <div class="mt-6 rounded-[1.4rem] bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Address' : 'Alamat' }}</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">{{ $industry->address ?: '-' }}</p>
                        </div>
                    </section>

                    <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <div class="mb-5 flex items-center justify-between gap-4">
                            <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Published Products' : 'Produk Terpublikasi' }}</h2>
                            <span class="rounded-full bg-cyan-50 px-4 py-2 text-sm font-semibold text-cyan-700">{{ $industry->products->count() }} {{ $isEnglish ? 'items' : 'item' }}</span>
                        </div>
                        @if ($industry->products->isEmpty())
                            <div class="rounded-[1.5rem] border border-dashed border-slate-300 p-8 text-center text-slate-500">
                                {{ $isEnglish ? 'This company profile does not have published products yet.' : 'Profil perusahaan ini belum memiliki produk terpublikasi.' }}
                            </div>
                        @else
                            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                                @foreach ($industry->products as $product)
                                    @php($image = $product->images->firstWhere('is_primary', true) ?? $product->images->first())
                                    <article class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm">
                                        <a href="{{ route('public.products.show', $product) }}" class="block">
                                            <div class="aspect-[4/3] bg-[linear-gradient(135deg,#ecfeff_0%,#f8fafc_100%)]">
                                                @if ($image)
                                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <p class="text-xs uppercase tracking-[0.22em] text-cyan-700">{{ $product->category?->name ?? '-' }}</p>
                                            <h3 class="mt-2 text-lg font-semibold text-slate-950">
                                                <a href="{{ route('public.products.show', $product) }}" class="transition hover:text-cyan-700">{{ $product->title }}</a>
                                            </h3>
                                            <p class="mt-3 text-sm text-slate-500">{{ $product->origin_country }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>

                <aside class="space-y-6">
                    <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Contact Persons' : 'Contact Person' }}</p>
                        <div class="mt-5 space-y-3">
                            @forelse ($industry->contacts as $contact)
                                <article class="rounded-[1.3rem] bg-slate-50 p-4">
                                    <p class="font-semibold text-slate-950">{{ $contact->name }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ $contact->position ?: ($isEnglish ? 'Representative' : 'Perwakilan') }}</p>
                                    <div class="mt-3 space-y-1 text-sm text-slate-700">
                                        <p>{{ $contact->phone ?: '-' }}</p>
                                        <p class="break-all">{{ $contact->email ?: '-' }}</p>
                                    </div>
                                </article>
                            @empty
                                <p class="text-sm text-slate-500">{{ $isEnglish ? 'No contact person is available yet.' : 'Belum ada contact person yang tersedia.' }}</p>
                            @endforelse
                        </div>
                    </section>

                    @if ($similarIndustries->isNotEmpty())
                        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Nearby Context' : 'Konteks Serupa' }}</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Similar Industries' : 'Industri Serupa' }}</h2>
                            <div class="mt-5 space-y-3">
                                @foreach ($similarIndustries as $similar)
                                    <a href="{{ route('public.industries.show', $similar) }}" class="block rounded-[1.3rem] border border-slate-200 p-4 transition hover:border-cyan-200 hover:bg-cyan-50/40">
                                        <p class="font-semibold text-slate-950">{{ trim(($similar->company_prefix ? $similar->company_prefix.' ' : '').$similar->company_name) }}</p>
                                        <p class="mt-1 text-sm text-slate-500">{{ $similar->region?->name ?? $similar->province ?? '-' }}, {{ $similar->country?->name ?? '-' }}</p>
                                        <p class="mt-2 text-sm text-slate-700">{{ $similar->published_products_count }} {{ $isEnglish ? 'published products' : 'produk publish' }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </aside>
            </div>
        </section>
    </main>
@endsection
