@php
    $isEnglish = app()->isLocale('en');
@endphp

@extends('layouts.public')

@section('title', $isEnglish ? 'Products Catalog' : 'Katalog Produk')

@section('content')
    <main class="pb-20 pt-8">
        <section class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-8 overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_80px_rgba(15,23,42,0.08)] lg:grid-cols-[1.15fr_0.85fr] lg:p-10">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.32em] text-cyan-700">{{ $isEnglish ? 'Public Product Catalog' : 'Katalog Produk Publik' }}</p>
                    <h1 class="mt-4 font-['Playfair_Display'] text-4xl leading-tight text-slate-950 lg:text-5xl">
                        {{ $isEnglish ? 'Find imported products and cross-border services from verified business members.' : 'Temukan produk impor dan layanan lintas negara dari pelaku usaha terverifikasi.' }}
                    </h1>
                    <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">
                        {{ $isEnglish ? 'Browse product categories, supplier information, and trade details in one place to help you identify relevant business opportunities more quickly.' : 'Jelajahi kategori produk, informasi supplier, dan detail perdagangan dalam satu halaman untuk membantu Anda menemukan peluang bisnis yang relevan dengan lebih cepat.' }}
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <span class="rounded-full bg-cyan-50 px-4 py-2 text-sm font-semibold text-cyan-700">{{ $products->total() }} {{ $isEnglish ? 'published products' : 'produk terpublikasi' }}</span>
                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">{{ count($categories) }} {{ $isEnglish ? 'active categories' : 'kategori aktif' }}</span>
                    </div>
                </div>
                <div class="rounded-[1.75rem] border border-cyan-100 bg-[linear-gradient(135deg,#ecfeff_0%,#ffffff_45%,#f8fafc_100%)] p-6">
                    <svg viewBox="0 0 420 300" class="h-full w-full" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect x="20" y="36" width="210" height="210" rx="34" fill="#E0F2FE"/>
                        <rect x="64" y="78" width="126" height="126" rx="26" fill="#06B6D4"/>
                        <circle cx="127" cy="140" r="28" fill="#ECFEFF"/>
                        <path d="M96 190c7-25 23-40 31-40 9 0 23 15 31 40H96Z" fill="#BAE6FD"/>
                        <rect x="196" y="60" width="182" height="40" rx="20" fill="#0F172A"/>
                        <rect x="196" y="118" width="156" height="18" rx="9" fill="#CBD5E1"/>
                        <rect x="196" y="148" width="120" height="18" rx="9" fill="#E2E8F0"/>
                        <rect x="196" y="184" width="90" height="40" rx="20" fill="#0891B2"/>
                        <circle cx="357" cy="210" r="38" fill="#FEF3C7"/>
                        <path d="M341 208h32M357 192v32" stroke="#F59E0B" stroke-width="8" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-6 lg:px-8">
            <div class="grid gap-8 xl:grid-cols-[18rem_1fr]">
                <aside class="h-fit rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_20px_50px_rgba(15,23,42,0.06)]">
                    <div class="mb-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Filter Catalog' : 'Filter Katalog' }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Refine Results' : 'Persempit Hasil' }}</h2>
                    </div>

                    <form action="{{ route('public.products.index') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Search' : 'Pencarian' }}</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Product, brand, supplier' : 'Produk, brand, supplier' }}">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Category' : 'Kategori' }}</label>
                            <select name="category" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All categories' : 'Semua kategori' }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" {{ ($filters['category'] ?? '') === $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Trading Type' : 'Jenis Trading' }}</label>
                            <select name="trade_kind" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All types' : 'Semua jenis' }}</option>
                                @foreach ($tradeKinds as $value => $label)
                                    <option value="{{ $value }}" {{ ($filters['trade_kind'] ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Origin Country' : 'Negara Asal' }}</label>
                            <select name="origin_country" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All countries' : 'Semua negara' }}</option>
                                @foreach ($originCountries as $country)
                                    <option value="{{ $country }}" {{ ($filters['origin_country'] ?? '') === $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                                {{ $isEnglish ? 'Apply Filter' : 'Terapkan Filter' }}
                            </button>
                            <a href="{{ route('public.products.index') }}" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-900">
                                {{ $isEnglish ? 'Reset' : 'Reset' }}
                            </a>
                        </div>
                    </form>
                </aside>

                <div>
                    <div class="mb-6 flex flex-col gap-4 rounded-[1.5rem] border border-slate-200 bg-white px-5 py-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">{{ $isEnglish ? 'Public listings from verified business members are shown here along with supplier details and key product information.' : 'Daftar produk publik dari pelaku usaha terverifikasi ditampilkan di sini lengkap dengan profil supplier dan informasi utama produk.' }}</p>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">{{ $products->total() }} {{ $isEnglish ? 'results found' : 'hasil ditemukan' }}</p>
                    </div>

                    @if ($products->count() === 0)
                        <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white p-10 text-center">
                            <svg viewBox="0 0 160 120" class="mx-auto h-32 w-40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect x="18" y="28" width="92" height="64" rx="18" fill="#E2E8F0"/>
                                <circle cx="116" cy="82" r="22" fill="#BAE6FD"/>
                                <path d="M125 91 136 102" stroke="#0891B2" stroke-width="8" stroke-linecap="round"/>
                                <path d="M52 52h24M52 66h36" stroke="#94A3B8" stroke-width="8" stroke-linecap="round"/>
                            </svg>
                            <h3 class="mt-4 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'No products matched your filter.' : 'Belum ada produk yang cocok dengan filter Anda.' }}</h3>
                            <p class="mt-3 text-base leading-8 text-slate-600">{{ $isEnglish ? 'Please try another keyword or select a broader category to see more product listings.' : 'Silakan coba kata kunci lain atau pilih kategori yang lebih luas untuk melihat lebih banyak daftar produk.' }}</p>
                        </div>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 2xl:grid-cols-3">
                            @foreach ($products as $product)
                                @php
                                    $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                                    $company = $product->companyProfile;
                                    $companyPrefix = $company && $company->company_prefix ? $company->company_prefix.' ' : '';
                                    $companyName = trim($companyPrefix.($company->company_name ?? '-'));
                                    $companyRegion = $company && $company->region ? $company->region->name : ($company->province ?? '-');
                                    $companyCountry = $company && $company->country ? $company->country->name : 'Indonesia IMT-GT';
                                @endphp
                                <article class="group overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_50px_rgba(15,23,42,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_70px_rgba(15,23,42,0.12)]">
                                    <a href="{{ route('public.products.show', $product) }}" class="block">
                                        <div class="relative aspect-[4/3] overflow-hidden bg-[linear-gradient(135deg,#ecfeff_0%,#f8fafc_100%)]">
                                            @if ($primaryImage)
                                                <img src="{{ asset('storage/'.$primaryImage->path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]">
                                            @else
                                                <div class="grid h-full place-items-center">
                                                    <svg viewBox="0 0 220 180" class="h-32 w-36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <rect x="30" y="28" width="160" height="124" rx="28" fill="#CFFAFE"/>
                                                        <circle cx="92" cy="84" r="22" fill="#06B6D4"/>
                                                        <path d="M60 132h100" stroke="#0F172A" stroke-width="10" stroke-linecap="round"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                                                <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-slate-800">{{ $product->category?->name ?? ($isEnglish ? 'Uncategorized' : 'Tanpa kategori') }}</span>
                                                <span class="rounded-full bg-cyan-600/90 px-3 py-1 text-xs font-semibold text-white">{{ $product->trade_kind === 'services' ? ($isEnglish ? 'Service' : 'Jasa') : ($isEnglish ? 'Goods' : 'Barang') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="p-5">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-700">{{ $product->origin_country }}</p>
                                                <h2 class="mt-2 text-xl font-semibold leading-tight text-slate-950">
                                                    <a href="{{ route('public.products.show', $product) }}" class="transition hover:text-cyan-700">{{ $product->title }}</a>
                                                </h2>
                                            </div>
                                            @if ($product->show_price && $product->price)
                                                <div class="text-right">
                                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Starting at' : 'Mulai dari' }}</p>
                                                    <p class="mt-1 text-lg font-bold text-slate-950">{{ $product->currency }} {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                                                </div>
                                            @else
                                                <span class="rounded-full bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">{{ $isEnglish ? 'Ask for price' : 'Harga by request' }}</span>
                                            @endif
                                        </div>

                                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 120) }}</p>

                                        <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
                                            <div>
                                                <p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Supplier' : 'Supplier' }}</p>
                                                <p class="mt-1 font-semibold text-slate-900">{{ $companyName }}</p>
                                                <p class="text-sm text-slate-500">{{ $companyRegion }}, {{ $companyCountry }}</p>
                                            </div>
                                            <a href="{{ route('public.products.show', $product) }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-cyan-200 hover:text-cyan-700">
                                                {{ $isEnglish ? 'View Detail' : 'Lihat Detail' }}
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
