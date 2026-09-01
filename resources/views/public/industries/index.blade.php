@php($isEnglish = app()->isLocale('en'))

@extends('layouts.public')

@section('title', $isEnglish ? 'Industry Directory' : 'Direktori Industri')

@section('content')
    <main class="pb-20 pt-8">
        <section class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-8 overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_80px_rgba(15,23,42,0.08)] lg:grid-cols-[1.1fr_0.9fr] lg:p-10">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.32em] text-cyan-700">{{ $isEnglish ? 'Industry Directory' : 'Direktori Industri' }}</p>
                    <h1 class="mt-4 font-['Playfair_Display'] text-4xl leading-tight text-slate-950 lg:text-5xl">
                        {{ $isEnglish ? 'Explore company profiles, business scale, and published products from supplier members.' : 'Jelajahi profil perusahaan, skala bisnis, dan produk terpublikasi dari member supplier.' }}
                    </h1>
                    <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">
                        {{ $isEnglish ? 'This directory helps you review supplier profiles, business sectors, and published products before continuing to the full company detail page.' : 'Direktori ini membantu Anda meninjau profil supplier, sektor usaha, dan produk yang dipublikasikan sebelum membuka halaman detail perusahaan.' }}
                    </p>
                </div>
                <div class="rounded-[1.75rem] border border-cyan-100 bg-[linear-gradient(135deg,#f0fdfa_0%,#ffffff_48%,#f8fafc_100%)] p-6">
                    <svg viewBox="0 0 420 300" class="h-full w-full" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect x="36" y="52" width="136" height="180" rx="26" fill="#CCFBF1"/>
                        <rect x="196" y="34" width="188" height="54" rx="20" fill="#0F172A"/>
                        <rect x="196" y="104" width="152" height="16" rx="8" fill="#CBD5E1"/>
                        <rect x="196" y="132" width="118" height="16" rx="8" fill="#E2E8F0"/>
                        <rect x="196" y="170" width="174" height="54" rx="24" fill="#14B8A6"/>
                        <circle cx="104" cy="110" r="34" fill="#0F766E"/>
                        <path d="M68 190c7-26 21-44 36-44s29 18 36 44H68Z" fill="#99F6E4"/>
                    </svg>
                </div>
            </div>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-6 lg:px-8">
            <div class="grid gap-8 xl:grid-cols-[19rem_1fr]">
                <aside class="h-fit rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_20px_50px_rgba(15,23,42,0.06)]">
                    <div class="mb-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Filter Industries' : 'Filter Industri' }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Refine Search' : 'Persempit Pencarian' }}</h2>
                    </div>

                    <form action="{{ route('public.industries.index') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Search' : 'Pencarian' }}</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Company, city, main product' : 'Perusahaan, kota, produk utama' }}">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Country' : 'Negara' }}</label>
                            <select id="country_id" name="country_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All countries' : 'Semua negara' }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected((string) ($filters['country_id'] ?? '') === (string) $country->id)>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Province / State' : 'Provinsi / State' }}</label>
                            <select id="region_id" name="region_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All regions' : 'Semua wilayah' }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Type of Business' : 'Jenis Usaha' }}</label>
                            <select name="type_of_business" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All business types' : 'Semua jenis usaha' }}</option>
                                @foreach ($businessTypes as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['type_of_business'] ?? '') === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Scale of Business' : 'Skala Bisnis' }}</label>
                            <select name="scale_of_business" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? 'All scales' : 'Semua skala' }}</option>
                                @foreach ($businessScales as $key => $label)
                                    <option value="{{ $key }}" @selected(($filters['scale_of_business'] ?? '') === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">{{ $isEnglish ? 'Apply Filter' : 'Terapkan Filter' }}</button>
                            <a href="{{ route('public.industries.index') }}" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-900">{{ $isEnglish ? 'Reset' : 'Reset' }}</a>
                        </div>
                    </form>
                </aside>

                <div>
                    <div class="mb-6 flex flex-col gap-4 rounded-[1.5rem] border border-slate-200 bg-white px-5 py-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm font-medium text-slate-500">{{ $isEnglish ? 'Each company card shows its location, line of business, and number of published products to make comparison easier.' : 'Setiap kartu perusahaan menampilkan lokasi, bidang usaha, dan jumlah produk yang dipublikasikan agar lebih mudah dibandingkan.' }}</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $industries->total() }} {{ $isEnglish ? 'companies found' : 'perusahaan ditemukan' }}</p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @forelse ($industries as $industry)
                            <article class="flex flex-col overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_50px_rgba(15,23,42,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_70px_rgba(15,23,42,0.12)]">
                                <div class="border-b border-slate-100 bg-[linear-gradient(135deg,#ecfeff_0%,#ffffff_100%)] p-5">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm border border-slate-100">
                                            @if ($industry->logo_path)
                                                <img src="{{ asset('storage/'.$industry->logo_path) }}" alt="{{ $industry->company_name }}" class="h-full w-full object-contain p-1.5">
                                            @else
                                                <svg viewBox="0 0 64 64" class="h-10 w-10 text-slate-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="22" r="12"/><path d="M12 58c3-14 11-22 20-22s17 8 20 22H12Z"/></svg>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate text-lg font-semibold text-slate-950">{{ trim(($industry->company_prefix ? $industry->company_prefix.' ' : '').$industry->company_name) }}</p>
                                            <p class="truncate text-sm text-slate-500">{{ $industry->region?->name ?? $industry->province ?? '-' }}, {{ $industry->country?->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-1 flex-col p-5">
                                    <div class="mb-4 flex flex-wrap gap-2">
                                        @if ($industry->type_of_business)
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">{{ $businessTypes[$industry->type_of_business] ?? $industry->type_of_business }}</span>
                                        @endif
                                        @if ($industry->scale_of_business)
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700 truncate max-w-[150px]">{{ $industry->scale_of_business }}</span>
                                        @endif
                                    </div>

                                    <p class="text-sm leading-6 text-slate-600 line-clamp-3">{{ $industry->company_description ?: ($industry->main_product ?: '-') }}</p>

                                    <div class="mt-auto pt-6">
                                        <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                            <div>
                                                <p class="text-xs text-slate-400">{{ $isEnglish ? 'Published Products' : 'Produk Publish' }}</p>
                                                <p class="mt-0.5 text-sm font-semibold text-slate-900">{{ $industry->published_products_count }} <span class="font-normal text-slate-500">{{ $isEnglish ? 'Items' : 'Item' }}</span></p>
                                            </div>
                                            <a href="{{ route('public.industries.show', $industry) }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                                                {{ $isEnglish ? 'View Profile' : 'Lihat Profil' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="md:col-span-2 xl:col-span-3 rounded-[1.75rem] border border-dashed border-slate-300 bg-white p-10 text-center">
                                <svg viewBox="0 0 160 120" class="mx-auto h-32 w-40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <rect x="24" y="24" width="112" height="72" rx="18" fill="#CCFBF1"/>
                                    <path d="M48 54h64M48 70h44" stroke="#0F766E" stroke-width="8" stroke-linecap="round"/>
                                </svg>
                                <h3 class="mt-4 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'No industries matched your filter.' : 'Belum ada industri yang cocok dengan filter Anda.' }}</h3>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $industries->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countrySelect = document.getElementById('country_id');
            const regionSelect = document.getElementById('region_id');
            const regionsByCountry = @json($regionsByCountry);
            const selectedRegion = @json((string) ($filters['region_id'] ?? ''));

            const syncRegions = (preserve = true) => {
                if (!countrySelect || !regionSelect) {
                    return;
                }

                const regions = regionsByCountry[countrySelect.value] ?? [];
                const currentValue = preserve ? selectedRegion : '';
                const placeholder = @json($isEnglish ? 'All regions' : 'Semua wilayah');

                regionSelect.innerHTML = '';

                const option = document.createElement('option');
                option.value = '';
                option.textContent = placeholder;
                regionSelect.appendChild(option);

                regions.forEach((region) => {
                    const item = document.createElement('option');
                    item.value = String(region.id);
                    item.textContent = region.name;

                    if (String(region.id) === String(currentValue)) {
                        item.selected = true;
                    }

                    regionSelect.appendChild(item);
                });
            };

            countrySelect?.addEventListener('change', () => syncRegions(false));
            syncRegions();
        });
    </script>
@endsection
