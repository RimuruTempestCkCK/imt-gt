@php($isEnglish = app()->isLocale('en'))

@extends('layouts.member')

@section('title', $isEnglish ? 'Add Product' : 'Tambah Produk')
@section('heading', $isEnglish ? 'Add Product' : 'Tambah Produk')

@section('content')
    <div class="space-y-8">
        <div class="max-w-4xl">
            <p class="text-sm uppercase tracking-[0.32em] text-cyan-300/80">{{ $isEnglish ? 'Product Wizard' : 'Wizard Produk' }}</p>
            <h2 class="mt-2 text-3xl font-semibold text-white">{{ $isEnglish ? 'Create a Trading Product Listing' : 'Buat Listing Produk Trading' }}</h2>
            <p class="mt-3 text-sm leading-7 text-slate-300">{{ $isEnglish ? 'We break the form into four clear steps so it is easier to scan and complete. Step 2 is required, step 3 is optional, and step 4 is optional.' : 'Form ini kami pecah menjadi empat langkah yang jelas agar lebih mudah dipindai dan diselesaikan. Step 2 wajib, step 3 opsional, dan step 4 opsional.' }}</p>
        </div>

        <div class="grid gap-4 md:grid-cols-4">
            @foreach ([
                ['title' => $isEnglish ? 'Step 1' : 'Step 1', 'text' => $isEnglish ? 'Product title and category' : 'Judul produk dan kategori'],
                ['title' => $isEnglish ? 'Step 2' : 'Step 2', 'text' => $isEnglish ? 'Required product information' : 'Informasi produk wajib'],
                ['title' => $isEnglish ? 'Step 3' : 'Step 3', 'text' => $isEnglish ? 'Optional specifications' : 'Spesifikasi opsional'],
                ['title' => $isEnglish ? 'Step 4' : 'Step 4', 'text' => $isEnglish ? 'Optional extra details' : 'Detail tambahan opsional'],
            ] as $step)
                <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-5">
                    <p class="text-xs uppercase tracking-[0.24em] text-cyan-300/80">{{ $step['title'] }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-200">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('account.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <section class="rounded-[2rem] border border-white/10 bg-slate-950/40 p-6 lg:p-8">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300/80">Step 1</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Product Identity' : 'Identitas Produk' }}</h3>
                </div>

                <div class="grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Title' : 'Judul Produk' }}</label>
                        <input name="title" value="{{ old('title') }}" maxlength="255" class="imtgt-input" placeholder="{{ $isEnglish ? 'Enter product title' : 'Masukkan judul produk' }}" required>
                        @error('title')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Category' : 'Kategori Produk' }}</label>
                        <select name="product_category_id" class="imtgt-input" required>
                            <option value="">{{ $isEnglish ? '- Select category -' : '- Pilih kategori -' }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) old('product_category_id') === (string) $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-slate-950/40 p-6 lg:p-8">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300/80">Step 2</p>
                        <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Required Product Information' : 'Informasi Produk Wajib' }}</h3>
                    </div>
                    <span class="rounded-full bg-amber-400/15 px-4 py-2 text-sm font-semibold text-amber-200">{{ $isEnglish ? 'Video is optional' : 'Video opsional' }}</span>
                </div>

                <div class="grid gap-8 xl:grid-cols-[1.1fr_0.9fr]">
                    <div class="space-y-5">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Photos' : 'Foto Produk' }}</label>
                            <div class="rounded-[1.5rem] border border-white/10 bg-slate-900/50 p-4">
                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-white">{{ $isEnglish ? 'Upload photos one by one' : 'Upload foto satu per satu' }}</p>
                                        <p class="mt-1 text-xs leading-6 text-slate-400">
                                            {{ $isEnglish ? 'You can browse repeatedly and collect up to 8 photos. Maximum file size is 2MB per image.' : 'Anda bisa browse berulang kali dan mengumpulkan sampai 8 foto. Ukuran maksimal setiap file adalah 2MB.' }}
                                        </p>
                                    </div>
                                    <div class="rounded-full bg-cyan-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-cyan-200" id="images-counter">
                                        0 / 8 Photos
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" id="image-preview-grid">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <div class="overflow-hidden rounded-[1.25rem] border border-dashed border-cyan-300/20 bg-slate-950/70">
                                            <div class="relative flex aspect-square items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(6,182,212,0.18),_transparent_65%)]">
                                                <img
                                                    data-preview-image
                                                    alt="Preview {{ $i }}"
                                                    class="hidden h-full w-full object-cover"
                                                >
                                                <button
                                                    type="button"
                                                    data-remove-image
                                                    data-index="{{ $i - 1 }}"
                                                    class="absolute right-3 top-3 hidden rounded-full bg-slate-950/80 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-rose-500"
                                                >
                                                    {{ $isEnglish ? 'Remove' : 'Hapus' }}
                                                </button>
                                                <div data-preview-placeholder class="px-4 text-center">
                                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/70">Photo {{ $i }}</p>
                                                    <p class="mt-2 text-xs leading-6 text-slate-400">{{ $isEnglish ? 'Preview will appear here' : 'Preview akan muncul di sini' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <input
                                    type="file"
                                    name="images[]"
                                    id="product_images"
                                    accept="image/png,image/jpeg,image/jpg,image/webp"
                                    class="hidden"
                                >
                                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <button
                                        type="button"
                                        id="browse-images"
                                        class="rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-300/20 transition hover:bg-cyan-700"
                                    >
                                        {{ $isEnglish ? 'Browse Photo' : 'Browse Foto' }}
                                    </button>
                                    <p class="text-xs leading-6 text-slate-400">
                                        {{ $isEnglish ? 'The first uploaded photo will become the main image automatically.' : 'Foto pertama yang diunggah akan otomatis menjadi gambar utama.' }}
                                    </p>
                                </div>
                            </div>
                            @error('images')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            @error('images.*')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            <p id="images-feedback" class="mt-2 hidden text-sm text-rose-300"></p>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Video URL' : 'URL Video Produk' }}</label>
                            <input name="video_url" value="{{ old('video_url') }}" class="imtgt-input" placeholder="https://youtube.com/...">
                            @error('video_url')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Description' : 'Deskripsi Produk' }}</label>
                            <textarea name="description" rows="5" class="imtgt-input" placeholder="{{ $isEnglish ? 'Explain your product clearly' : 'Jelaskan produk Anda dengan jelas' }}" required>{{ old('description') }}</textarea>
                            @error('description')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Trading Type' : 'Jenis Trading' }}</label>
                                <select name="trade_kind" class="imtgt-input" required>
                                    <option value="goods" @selected(old('trade_kind', 'goods') === 'goods')>{{ $isEnglish ? 'Imported Goods' : 'Import Barang' }}</option>
                                    <option value="services" @selected(old('trade_kind') === 'services')>{{ $isEnglish ? 'Imported Services' : 'Import Jasa' }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Import Source / Type' : 'Sumber / Jenis Import' }}</label>
                                <input name="import_type" value="{{ old('import_type') }}" class="imtgt-input" placeholder="{{ $isEnglish ? 'Example: China, Malaysia, Overseas service' : 'Contoh: China, Malaysia, Jasa luar negeri' }}" required>
                                @error('import_type')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Origin Country' : 'Negara Asal' }}</label>
                                <input name="origin_country" value="{{ old('origin_country') }}" class="imtgt-input" required>
                                @error('origin_country')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Brand' : 'Merek' }}</label>
                                <input name="brand" value="{{ old('brand') }}" class="imtgt-input" required>
                                @error('brand')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">Model</label>
                                <input name="model" value="{{ old('model') }}" class="imtgt-input" required>
                                @error('model')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">SKU</label>
                                <input name="sku" value="{{ old('sku') }}" class="imtgt-input" required>
                                @error('sku')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">HS Code</label>
                                <input name="hs_code" value="{{ old('hs_code') }}" class="imtgt-input" required>
                                @error('hs_code')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Min Order Qty' : 'Min Order Qty' }}</label>
                                <input name="min_order_qty" value="{{ old('min_order_qty') }}" class="imtgt-input" required>
                                @error('min_order_qty')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Production Capacity' : 'Kapasitas Produksi' }}</label>
                                <input name="production_capacity" value="{{ old('production_capacity') }}" class="imtgt-input" required>
                                @error('production_capacity')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Delivery Time' : 'Waktu Pengiriman' }}</label>
                                <input name="delivery_time" value="{{ old('delivery_time') }}" class="imtgt-input" required>
                                @error('delivery_time')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Packaging' : 'Kemasan' }}</label>
                            <input name="packaging" value="{{ old('packaging') }}" class="imtgt-input" required>
                            @error('packaging')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid gap-5 sm:grid-cols-[auto_1fr_1fr] sm:items-end">
                            <label class="inline-flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200">
                                <input type="hidden" name="show_price" value="0">
                                <input type="checkbox" name="show_price" value="1" id="show_price" class="rounded border-white/20 bg-slate-950" @checked(old('show_price', true))>
                                <span>{{ $isEnglish ? 'Show Price' : 'Tampilkan Harga' }}</span>
                            </label>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Price' : 'Harga' }}</label>
                                <input name="price" value="{{ old('price') }}" class="imtgt-input" id="price_field">
                                @error('price')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Currency' : 'Mata Uang' }}</label>
                                    <select name="currency" class="imtgt-input">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency }}" @selected(old('currency', 'IDR') === $currency)>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Price Unit' : 'Satuan Harga' }}</label>
                                    <input name="price_unit" value="{{ old('price_unit') }}" class="imtgt-input" placeholder="{{ $isEnglish ? 'per item / per hour' : 'per item / per jam' }}">
                                </div>
                            </div>
                        </div>

                        <label class="inline-flex items-center gap-3 text-sm text-slate-300">
                            <input type="hidden" name="is_hazardous" value="0">
                            <input type="checkbox" name="is_hazardous" value="1" class="rounded border-white/20 bg-slate-950" @checked(old('is_hazardous'))>
                            <span>{{ $isEnglish ? 'This product contains hazardous / flammable material' : 'Produk mengandung bahan berbahaya / mudah terbakar' }}</span>
                        </label>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-slate-950/40 p-6 lg:p-8">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300/80">Step 3</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Optional Specifications' : 'Spesifikasi Opsional' }}</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-400">{{ $isEnglish ? 'Use this area to enrich the listing. This section is not required.' : 'Gunakan area ini untuk memperkaya listing. Bagian ini tidak wajib.' }}</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Specifications' : 'Spesifikasi' }}</label>
                    <textarea name="specifications" rows="6" class="imtgt-input" placeholder="{{ $isEnglish ? 'Example: material, dimensions, performance, service scope, warranty' : 'Contoh: material, dimensi, performa, cakupan layanan, garansi' }}">{{ old('specifications') }}</textarea>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-slate-950/40 p-6 lg:p-8">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300/80">Step 4</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">{{ $isEnglish ? 'Optional Additional Details' : 'Detail Tambahan Opsional' }}</h3>
                </div>

                <div class="grid gap-5 lg:grid-cols-2">
                    <div class="lg:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Additional Information' : 'Informasi Tambahan' }}</label>
                        <textarea name="additional_information" rows="5" class="imtgt-input">{{ old('additional_information') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'SEO Keywords' : 'SEO Keywords' }}</label>
                        <input name="seo_keywords" value="{{ old('seo_keywords') }}" class="imtgt-input" placeholder="{{ $isEnglish ? 'keyword 1, keyword 2' : 'keyword 1, keyword 2' }}">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Support Contact' : 'Kontak Support' }}</label>
                        <input name="support_contact" value="{{ old('support_contact') }}" class="imtgt-input" placeholder="{{ $isEnglish ? 'WhatsApp / email / PIC' : 'WhatsApp / email / PIC' }}">
                    </div>
                </div>
            </section>

            <section class="flex flex-col gap-5 rounded-[2rem] border border-white/10 bg-slate-950/40 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-200">{{ $isEnglish ? 'Product Status' : 'Status Produk' }}</label>
                    <select name="status" class="imtgt-input min-w-44">
                        <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status') === 'published')>{{ $isEnglish ? 'Published' : 'Publish' }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('account.products.index') }}" class="rounded-full border border-white/10 px-6 py-3 text-sm font-semibold text-slate-200 transition hover:bg-white/5">
                        {{ $isEnglish ? 'Back' : 'Kembali' }}
                    </a>
                    <button type="submit" class="rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-300/20 transition hover:bg-cyan-700">
                        {{ $isEnglish ? 'Save Product' : 'Simpan Produk' }}
                    </button>
                </div>
            </section>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const showPriceCheckbox = document.getElementById('show_price');
            const priceField = document.getElementById('price_field');
            const imageInput = document.getElementById('product_images');
            const browseImagesButton = document.getElementById('browse-images');
            const previewImages = document.querySelectorAll('[data-preview-image]');
            const previewPlaceholders = document.querySelectorAll('[data-preview-placeholder]');
            const removeImageButtons = document.querySelectorAll('[data-remove-image]');
            const imageFeedback = document.getElementById('images-feedback');
            const imagesCounter = document.getElementById('images-counter');
            const selectedImages = [];

            const syncPriceField = () => {
                if (showPriceCheckbox && priceField) {
                    priceField.disabled = !showPriceCheckbox.checked;
                    priceField.classList.toggle('opacity-50', !showPriceCheckbox.checked);
                }
            };

            const resetPreviews = () => {
                previewImages.forEach((image) => {
                    image.src = '';
                    image.classList.add('hidden');
                });

                previewPlaceholders.forEach((placeholder) => {
                    placeholder.classList.remove('hidden');
                });

                removeImageButtons.forEach((button) => {
                    button.classList.add('hidden');
                });
            };

            const setImageFeedback = (message = '') => {
                if (!imageFeedback) {
                    return;
                }

                imageFeedback.textContent = message;
                imageFeedback.classList.toggle('hidden', message === '');
            };

            const syncImageInputFiles = () => {
                if (!imageInput) {
                    return;
                }

                const dataTransfer = new DataTransfer();
                selectedImages.forEach((file) => dataTransfer.items.add(file));
                imageInput.files = dataTransfer.files;
            };

            const syncImageCounter = () => {
                if (!imagesCounter) {
                    return;
                }

                const label = @json($isEnglish ? 'Photos' : 'Foto');
                imagesCounter.textContent = `${selectedImages.length} / 8 ${label}`;
            };

            const syncImagePreview = () => {
                if (!imageInput) {
                    return;
                }

                resetPreviews();
                setImageFeedback();
                syncImageCounter();

                if (selectedImages.length === 0) {
                    return;
                }

                selectedImages.forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = (event) => {
                        if (!previewImages[index] || !previewPlaceholders[index] || !removeImageButtons[index]) {
                            return;
                        }

                        previewImages[index].src = String(event.target?.result ?? '');
                        previewImages[index].classList.remove('hidden');
                        previewPlaceholders[index].classList.add('hidden');
                        removeImageButtons[index].classList.remove('hidden');
                        removeImageButtons[index].setAttribute('data-index', String(index));
                    };

                    reader.readAsDataURL(file);
                });
            };

            if (showPriceCheckbox) {
                showPriceCheckbox.addEventListener('change', syncPriceField);
                syncPriceField();
            }

            if (browseImagesButton && imageInput) {
                browseImagesButton.addEventListener('click', () => {
                    if (selectedImages.length >= 8) {
                        setImageFeedback(@json($isEnglish ? 'You have reached the maximum of 8 photos.' : 'Anda sudah mencapai batas maksimum 8 foto.'));
                        return;
                    }

                    imageInput.click();
                });

                imageInput.addEventListener('change', () => {
                    const file = imageInput.files?.[0];

                    if (!file) {
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        setImageFeedback(@json($isEnglish ? 'Each image must be 2MB or smaller.' : 'Setiap gambar harus berukuran 2MB atau lebih kecil.'));
                        imageInput.value = '';
                        return;
                    }

                    if (selectedImages.length >= 8) {
                        setImageFeedback(@json($isEnglish ? 'You have reached the maximum of 8 photos.' : 'Anda sudah mencapai batas maksimum 8 foto.'));
                        imageInput.value = '';
                        return;
                    }

                    selectedImages.push(file);
                    syncImageInputFiles();
                    syncImagePreview();
                    imageInput.value = '';
                });
            }

            removeImageButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const index = Number(button.getAttribute('data-index'));

                    if (Number.isNaN(index) || !selectedImages[index]) {
                        return;
                    }

                    selectedImages.splice(index, 1);
                    syncImageInputFiles();
                    syncImagePreview();
                });
            });

            syncImageCounter();
        });
    </script>
@endsection
