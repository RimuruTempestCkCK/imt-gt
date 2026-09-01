@php
    $isEnglish = app()->isLocale('en');
@endphp

@extends('layouts.public')

@section('title', $product->title)

@section('content')
    @php
        $images = $product->images;
        $primaryImage = $images->firstWhere('is_primary', true) ?? $images->first();
        $company = $product->companyProfile;
    @endphp

    <main class="pb-20 pt-8">
        <section class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="transition hover:text-cyan-700">{{ $isEnglish ? 'Home' : 'Beranda' }}</a>
                <span>/</span>
                <a href="{{ route('public.products.index') }}" class="transition hover:text-cyan-700">{{ $isEnglish ? 'Products' : 'Produk' }}</a>
                <span>/</span>
                <span class="text-slate-900">{{ $product->title }}</span>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="space-y-4">
                    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <div class="aspect-[4/3] bg-[linear-gradient(135deg,#ecfeff_0%,#f8fafc_100%)]">
                            @if ($primaryImage)
                                <img id="primary-product-image" src="{{ asset('storage/'.$primaryImage->path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="grid h-full place-items-center">
                                    <svg viewBox="0 0 260 200" class="h-40 w-52" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <rect x="26" y="24" width="208" height="152" rx="34" fill="#E0F2FE"/>
                                        <circle cx="104" cy="86" r="26" fill="#06B6D4"/>
                                        <path d="M72 148h116" stroke="#0F172A" stroke-width="12" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($images->isNotEmpty())
                        <div class="grid grid-cols-4 gap-3 md:grid-cols-6">
                            @foreach ($images as $image)
                                <button type="button" class="product-thumb overflow-hidden rounded-[1.1rem] border border-slate-200 bg-white shadow-sm transition hover:border-cyan-300" data-image="{{ asset('storage/'.$image->path) }}">
                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->title }}" class="aspect-square h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-cyan-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-cyan-700">{{ $product->category?->name ?? ($isEnglish ? 'Uncategorized' : 'Tanpa kategori') }}</span>
                            <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-slate-600">{{ $product->trade_kind === 'services' ? ($isEnglish ? 'Imported Service' : 'Import Jasa') : ($isEnglish ? 'Imported Goods' : 'Import Barang') }}</span>
                        </div>
                        <h1 class="mt-4 font-['Playfair_Display'] text-4xl leading-tight text-slate-950">{{ $product->title }}</h1>
                        <p class="mt-4 text-base leading-8 text-slate-600">{{ $product->description }}</p>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.4rem] bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Price' : 'Harga' }}</p>
                                <p class="mt-2 text-2xl font-bold text-slate-950">
                                    @if ($product->show_price && $product->price)
                                        {{ $product->currency }} {{ number_format((float) $product->price, 0, ',', '.') }}
                                        @if ($product->price_unit)
                                            <span class="text-sm font-medium text-slate-500">/ {{ $product->price_unit }}</span>
                                        @endif
                                    @else
                                        {{ $isEnglish ? 'Contact supplier' : 'Hubungi supplier' }}
                                    @endif
                                </p>
                            </div>
                            <div class="rounded-[1.4rem] bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Origin' : 'Asal' }}</p>
                                <p class="mt-2 text-2xl font-bold text-slate-950">{{ $product->origin_country }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3">
                            @if ($company)
                                <button type="button" onclick="document.getElementById('inquiry-modal').classList.remove('hidden')" class="rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                                    {{ $isEnglish ? 'Send Inquiry' : 'Kirim Inquiry' }}
                                </button>
                                <a href="{{ route('public.industries.show', $company) }}" class="rounded-full border border-cyan-600 px-5 py-3 text-sm font-semibold text-cyan-600 transition hover:bg-cyan-50">
                                    {{ $isEnglish ? 'View Supplier Profile' : 'Lihat Profil Industri' }}
                                </a>
                            @endif
                            <a href="{{ route('public.products.index') }}" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:text-slate-900">
                                {{ $isEnglish ? 'Back to Catalog' : 'Kembali ke Katalog' }}
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                        <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Product Snapshot' : 'Ringkasan Produk' }}</h2>
                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">Brand</p><p class="mt-2 font-semibold text-slate-900">{{ $product->brand }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">Model</p><p class="mt-2 font-semibold text-slate-900">{{ $product->model }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">SKU</p><p class="mt-2 font-semibold text-slate-900">{{ $product->sku }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">HS Code</p><p class="mt-2 font-semibold text-slate-900">{{ $product->hs_code }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Min Order' : 'Min Order' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $product->min_order_qty }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Delivery' : 'Pengiriman' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $product->delivery_time }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Capacity' : 'Kapasitas' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $product->production_capacity }}</p></div>
                            <div class="rounded-[1.25rem] border border-slate-100 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-400">{{ $isEnglish ? 'Packaging' : 'Kemasan' }}</p><p class="mt-2 font-semibold text-slate-900">{{ $product->packaging }}</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_24rem]">
                <div class="space-y-8">
                    @if ($product->specifications)
                        <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                            <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Specifications' : 'Spesifikasi' }}</h2>
                            <div class="prose mt-4 max-w-none text-slate-600">{!! nl2br(e($product->specifications)) !!}</div>
                        </section>
                    @endif

                    @if ($product->additional_information)
                        <section class="rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                            <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Additional Information' : 'Informasi Tambahan' }}</h2>
                            <div class="prose mt-4 max-w-none text-slate-600">{!! nl2br(e($product->additional_information)) !!}</div>
                        </section>
                    @endif

                    @if ($relatedProducts->isNotEmpty())
                        <section>
                            <div class="mb-5 flex items-center justify-between gap-4">
                                <h2 class="font-['Playfair_Display'] text-3xl text-slate-950">{{ $isEnglish ? 'Related Products' : 'Produk Terkait' }}</h2>
                                <a href="{{ route('public.products.index') }}" class="text-sm font-semibold text-cyan-700 transition hover:text-cyan-800">{{ $isEnglish ? 'Explore more' : 'Lihat lainnya' }}</a>
                            </div>
                            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                                @foreach ($relatedProducts as $related)
                                    @php($relatedImage = $related->images->firstWhere('is_primary', true) ?? $related->images->first())
                                    <article class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm">
                                        <a href="{{ route('public.products.show', $related) }}" class="block">
                                            <div class="aspect-[4/3] bg-slate-100">
                                                @if ($relatedImage)
                                                    <img src="{{ asset('storage/'.$relatedImage->path) }}" alt="{{ $related->title }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <p class="text-xs uppercase tracking-[0.22em] text-cyan-700">{{ $related->category?->name ?? '-' }}</p>
                                            <h3 class="mt-2 text-lg font-semibold text-slate-950"><a href="{{ route('public.products.show', $related) }}" class="transition hover:text-cyan-700">{{ $related->title }}</a></h3>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="space-y-6">
                    @if ($company)
                        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.08)]">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Supplier Profile' : 'Profil Supplier' }}</p>
                            <div class="mt-5 flex items-center gap-4">
                                <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-slate-100">
                                    @if ($company->logo_path)
                                        <img src="{{ asset('storage/'.$company->logo_path) }}" alt="{{ $company->company_name }}" class="h-full w-full object-cover">
                                    @else
                                        <svg viewBox="0 0 64 64" class="h-10 w-10 text-slate-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="22" r="12"/><path d="M12 58c3-14 11-22 20-22s17 8 20 22H12Z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-slate-950">{{ trim(($company->company_prefix ? $company->company_prefix.' ' : '').$company->company_name) }}</h3>
                                    <p class="text-sm text-slate-500">{{ $company->region?->name ?? $company->province ?? '-' }}, {{ $company->country?->name ?? '-' }}</p>
                                </div>
                            </div>
                            <p class="mt-4 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($company->company_description ?: ($company->main_product ?: ''), 160) }}</p>
                            <a href="{{ route('public.industries.show', $company) }}" class="mt-5 inline-flex rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                                {{ $isEnglish ? 'Open Industry Detail' : 'Buka Detail Industri' }}
                            </a>
                        </section>
                    @endif

                    <section class="rounded-[2rem] border border-cyan-100 bg-[linear-gradient(180deg,#ecfeff_0%,#ffffff_100%)] p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Product Information' : 'Informasi Produk' }}</p>
                        <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-600">
                            <li>{{ $product->is_hazardous ? ($isEnglish ? 'This product includes a note related to hazardous or flammable materials.' : 'Produk ini memiliki keterangan terkait bahan berbahaya atau mudah terbakar.') : ($isEnglish ? 'No hazardous or flammable material notice is listed for this product.' : 'Tidak ada keterangan bahan berbahaya atau mudah terbakar pada produk ini.') }}</li>
                            <li>{{ $isEnglish ? 'Product videos are shown only when the supplier provides a valid link.' : 'Video produk hanya ditampilkan apabila supplier menambahkan tautan yang valid.' }}</li>
                            <li>{{ $isEnglish ? 'Some suppliers choose to display prices directly, while others ask prospective buyers to contact them first.' : 'Sebagian supplier menampilkan harga secara langsung, sementara yang lain meminta calon pembeli untuk menghubungi mereka terlebih dahulu.' }}</li>
                        </ul>
                    </section>
                </aside>
            </div>
            
            @if ($company)
            <!-- Inquiry Modal -->
            <div id="inquiry-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative w-full max-w-lg transform overflow-hidden rounded-[2rem] bg-white text-left shadow-xl transition-all sm:my-8">
                        <form action="{{ route('inquiries.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $company->user_id }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="company_profile_id" value="{{ $company->id }}">
                            
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-xl font-semibold leading-6 text-slate-900" id="modal-title">
                                        {{ $isEnglish ? 'Send Inquiry' : 'Kirim Inquiry' }}
                                    </h3>
                                    <div class="mt-4 space-y-4">
                                        @auth
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Subject' : 'Subjek' }}</label>
                                                <input type="text" name="subject" required class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="{{ $isEnglish ? 'Interested in your product' : 'Tertarik dengan produk Anda' }}" value="{{ $isEnglish ? 'Inquiry for ' : 'Pertanyaan tentang ' }}{{ $product->title }}">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Message' : 'Pesan' }}</label>
                                                <textarea name="message" rows="4" required class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="{{ $isEnglish ? 'Please provide more details...' : 'Mohon berikan informasi lebih lanjut...' }}"></textarea>
                                            </div>
                                        @else
                                            <p class="text-sm text-slate-600">{{ $isEnglish ? 'You must be logged in to send an inquiry.' : 'Anda harus login untuk mengirim pesan kerja sama.' }}</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                @auth
                                    <button type="submit" class="inline-flex w-full justify-center rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 sm:ml-3 sm:w-auto">
                                        {{ $isEnglish ? 'Send Message' : 'Kirim Pesan' }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex w-full justify-center rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 sm:ml-3 sm:w-auto">
                                        {{ $isEnglish ? 'Login Now' : 'Login Sekarang' }}
                                    </a>
                                @endauth
                                <button type="button" onclick="document.getElementById('inquiry-modal').classList.add('hidden')" class="mt-3 inline-flex w-full justify-center rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 sm:mt-0 sm:w-auto">
                                    {{ $isEnglish ? 'Cancel' : 'Batal' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const primaryImage = document.getElementById('primary-product-image');

            document.querySelectorAll('.product-thumb').forEach((button) => {
                button.addEventListener('click', () => {
                    if (primaryImage) {
                        primaryImage.src = button.getAttribute('data-image') ?? primaryImage.src;
                    }
                });
            });
        });
    </script>
@endsection
