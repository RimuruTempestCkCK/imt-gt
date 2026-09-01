@php($isEnglish = app()->isLocale('en'))

@extends('layouts.member')

@section('title', $isEnglish ? 'Add Product' : 'Tambah Produk')
@section('heading', $isEnglish ? 'Add Product' : 'Tambah Produk')

@section('content')
    <div class="space-y-8">
        <div class="max-w-4xl">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">{{ $isEnglish ? 'Product Wizard' : 'Wizard Produk' }}</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-900">{{ $isEnglish ? 'Create a Trading Product Listing' : 'Buat Listing Produk Trading' }}</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'We break the form into three clear steps so it is easier to scan and complete. Step 2 is required, and step 3 is optional.' : 'Form ini kami pecah menjadi tiga langkah yang jelas agar lebih mudah dipindai dan diselesaikan. Step 2 wajib, dan step 3 opsional.' }}</p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            @foreach ([
                ['title' => $isEnglish ? 'Step 1' : 'Step 1', 'text' => $isEnglish ? 'Product title and category' : 'Judul produk dan kategori'],
                ['title' => $isEnglish ? 'Step 2' : 'Step 2', 'text' => $isEnglish ? 'Required product information' : 'Informasi produk wajib'],
                ['title' => $isEnglish ? 'Step 3' : 'Step 3', 'text' => $isEnglish ? 'Optional specifications' : 'Spesifikasi opsional'],
            ] as $step)
                <div class="rounded-[1.75rem] border border-slate-200 bg-white shadow-sm p-5">
                    <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $step['title'] }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-700">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('account.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <section class="rounded-[2rem] border border-slate-200 bg-white shadow-sm p-6 lg:p-8">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Step 1</p>
                    <h3 class="mt-2 text-2xl font-semibold text-slate-900">{{ $isEnglish ? 'Product Identity' : 'Identitas Produk' }}</h3>
                </div>

                <div class="grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Title' : 'Judul Produk' }}</label>
                        <input name="title" value="{{ old('title') }}" maxlength="255" class="imtgt-input" placeholder="{{ $isEnglish ? 'Enter product title' : 'Masukkan judul produk' }}" required>
                        @error('title')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Category' : 'Kategori Produk' }}</label>
                        <select name="product_category_id" class="imtgt-input" required>
                            <option value="">{{ $isEnglish ? '- Select category -' : '- Pilih kategori -' }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) old('product_category_id') === (string) $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white shadow-sm p-6 lg:p-8">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Step 2</p>
                        <h3 class="mt-2 text-2xl font-semibold text-slate-900">{{ $isEnglish ? 'Required Product Information' : 'Informasi Produk Wajib' }}</h3>
                    </div>
                    <span class="rounded-full bg-amber-400/15 px-4 py-2 text-sm font-semibold text-amber-200">{{ $isEnglish ? 'Video is optional' : 'Video opsional' }}</span>
                </div>

                <div class="grid gap-8 xl:grid-cols-[1.1fr_0.9fr]">
                    <div class="space-y-5">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Photos' : 'Foto Produk' }}</label>
                            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-900/50 p-4">
                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $isEnglish ? 'Upload photos one by one' : 'Upload foto satu per satu' }}</p>
                                        <p class="mt-1 text-xs leading-6 text-slate-500">
                                            {{ $isEnglish ? 'You can browse repeatedly and collect up to 8 photos. Maximum file size is 2MB per image.' : 'Anda bisa browse berulang kali dan mengumpulkan sampai 8 foto. Ukuran maksimal setiap file adalah 2MB.' }}
                                        </p>
                                    </div>
                                    <div class="rounded-full bg-cyan-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-cyan-200" id="images-counter">
                                        0 / 8 Photos
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" id="image-preview-grid">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <div class="overflow-hidden rounded-[1.25rem] border border-dashed border-cyan-300/20 bg-white shadow-sm">
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
                                                    class="absolute right-3 top-3 hidden rounded-full bg-white/80 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-900 transition hover:bg-rose-500"
                                                >
                                                    {{ $isEnglish ? 'Remove' : 'Hapus' }}
                                                </button>
                                                <div data-preview-placeholder class="px-4 text-center">
                                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Photo {{ $i }}</p>
                                                    <p class="mt-2 text-xs leading-6 text-slate-500">{{ $isEnglish ? 'Preview will appear here' : 'Preview akan muncul di sini' }}</p>
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
                                    class="hidden" multiple
                                >
                                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <button
                                        type="button"
                                        id="browse-images"
                                        class="rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-300/20 transition hover:bg-cyan-700"
                                    >
                                        {{ $isEnglish ? 'Browse Photo' : 'Browse Foto' }}
                                    </button>
                                    <p class="text-xs leading-6 text-slate-500">
                                        {{ $isEnglish ? 'The first uploaded photo will become the main image automatically.' : 'Foto pertama yang diunggah akan otomatis menjadi gambar utama.' }}
                                    </p>
                                </div>
                            </div>
                            @error('images')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            @error('images.*')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            <p id="images-feedback" class="mt-2 hidden text-sm text-rose-600"></p>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Video URL' : 'URL Video Produk' }}</label>
                            <input name="video_url" value="{{ old('video_url') }}" class="imtgt-input" placeholder="https://youtube.com/...">
                            @error('video_url')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Description' : 'Deskripsi Produk' }}</label>
                            <textarea name="description" rows="5" class="imtgt-input" placeholder="{{ $isEnglish ? 'Explain your product clearly' : 'Jelaskan produk Anda dengan jelas' }}" required>{{ old('description') }}</textarea>
                            @error('description')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div><label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Trading Type' : 'Jenis Trading' }}</label><select name="trade_kind" class="imtgt-input" required><option value="goods" @selected(old('trade_kind', 'goods') === 'goods')>{{ $isEnglish ? 'Imported Goods' : 'Import Barang' }}</option><option value="services" @selected(old('trade_kind') === 'services')>{{ $isEnglish ? 'Imported Services' : 'Import Jasa' }}</option></select></div>

                        <div class="grid gap-5 sm:grid-cols-2"><div><label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Origin Country' : 'Negara Asal' }}</label><input name="origin_country" value="{{ old('origin_country') }}" class="imtgt-input">@error('origin_country')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror</div><div><label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Min Order Qty' : 'Min Order Qty' }}</label><input name="min_order_qty" value="{{ old('min_order_qty') }}" class="imtgt-input">@error('min_order_qty')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror</div></div>

                        

                        

                        

                        

                        <div class="grid gap-5 sm:grid-cols-[auto_1fr_1fr] sm:items-end">
                            <label class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-900/60 px-4 py-3 text-sm text-slate-700">
                                <input type="hidden" name="show_price" value="0">
                                <input type="checkbox" name="show_price" value="1" id="show_price" class="rounded border-slate-200 bg-white" @checked(old('show_price', true))>
                                <span>{{ $isEnglish ? 'Show Price' : 'Tampilkan Harga' }}</span>
                            </label>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Price' : 'Harga' }}</label>
                                <input name="price" value="{{ old('price') }}" class="imtgt-input" id="price_field">
                                @error('price')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Currency' : 'Mata Uang' }}</label>
                                    <select name="currency" class="imtgt-input">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency }}" @selected(old('currency', 'IDR') === $currency)>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Price Unit' : 'Satuan Harga' }}</label>
                                    <input name="price_unit" value="{{ old('price_unit') }}" class="imtgt-input" placeholder="{{ $isEnglish ? 'per item / per hour' : 'per item / per jam' }}">
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white shadow-sm p-6 lg:p-8">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Step 3</p>
                    <h3 class="mt-2 text-2xl font-semibold text-slate-900">{{ $isEnglish ? 'Optional Specifications' : 'Spesifikasi Opsional' }}</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-500">{{ $isEnglish ? 'Use this area to enrich the listing. This section is not required.' : 'Gunakan area ini untuk memperkaya listing. Bagian ini tidak wajib.' }}</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Specifications' : 'Spesifikasi' }}</label>
                    <textarea name="specifications" rows="6" class="imtgt-input" placeholder="{{ $isEnglish ? 'Example: material, dimensions, performance, service scope, warranty' : 'Contoh: material, dimensi, performa, cakupan layanan, garansi' }}">{{ old('specifications') }}</textarea>
                </div>
            </section>

            

            <section class="flex flex-col gap-5 rounded-[2rem] border border-slate-200 bg-white shadow-sm px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Product Status' : 'Status Produk' }}</label>
                    <select name="status" class="imtgt-input min-w-44">
                        <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status') === 'published')>{{ $isEnglish ? 'Published' : 'Publish' }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('account.products.index') }}" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
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
