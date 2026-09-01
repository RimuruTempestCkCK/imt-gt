@extends('layouts.admin')

@section('heading', 'Banner')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-600">Kelola slider atau banner utama pada beranda publik.</p>
        <button onclick="document.getElementById('modal-create').showModal()" class="imtgt-button imtgt-button-primary text-white">Tambah Banner</button>
    </div>

    @if($errors->any())
        <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600">
            Terjadi kesalahan input. Pastikan form diisi dengan benar.
        </div>
    @endif

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($banners as $banner)
            <article class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                @if ($banner->media)
                    <img src="{{ $banner->media->source_url }}" alt="{{ $banner->media->alt_text }}" class="h-44 w-full rounded-2xl object-cover">
                @endif
                <p class="mt-4 text-lg font-semibold text-slate-900">{{ $banner->title }}</p>
                <p class="mt-2 text-sm text-slate-500">{{ $banner->subtitle }}</p>
                <div class="mt-4 flex gap-3">
                    <button onclick="document.getElementById('modal-edit-{{ $banner->id }}').showModal()" class="text-cyan-700 hover:text-cyan-800 font-medium">Edit</button>
                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 hover:text-rose-700 font-medium" type="submit" onclick="return confirm('Hapus banner ini?')">Hapus</button>
                    </form>
                </div>
            </article>

            <!-- EDIT MODAL -->
            <dialog id="modal-edit-{{ $banner->id }}" class="w-full max-w-2xl rounded-2xl p-0 shadow-2xl backdrop:bg-slate-900/50 open:animate-in open:fade-in open:zoom-in-95">
                <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="border-b border-slate-200 px-6 py-4 flex justify-between items-center bg-slate-50">
                        <h3 class="text-lg font-semibold text-slate-900">Edit Banner</h3>
                        <button type="button" onclick="document.getElementById('modal-edit-{{ $banner->id }}').close()" class="text-slate-400 hover:text-slate-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Upload Foto Banner Baru (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                            <p class="mt-1 text-xs text-slate-500">Akan mengganti foto saat ini jika diisi.</p>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Judul Utama</label>
                            <input name="title" value="{{ $banner->title }}" required class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Sub-judul / Deskripsi Singkat</label>
                            <textarea name="subtitle" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" rows="2">{{ $banner->subtitle }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-slate-700">Teks Tombol (CTA)</label>
                                <input name="cta_label" value="{{ $banner->cta_label }}" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" placeholder="Misal: Lihat Promo">
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium text-slate-700">URL Tombol (CTA)</label>
                                <input name="cta_url" value="{{ $banner->cta_url }}" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" placeholder="https://...">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-slate-700">Urutan Tampil</label>
                                <input type="number" name="sort_order" value="{{ $banner->sort_order }}" required min="1" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium text-slate-700">Status</label>
                                <select name="is_active" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                                    <option value="1" {{ $banner->is_active ? 'selected' : '' }}>Aktif (Tampil)</option>
                                    <option value="0" {{ !$banner->is_active ? 'selected' : '' }}>Nonaktif (Sembunyikan)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 px-6 py-4 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('modal-edit-{{ $banner->id }}').close()" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Batal</button>
                        <button type="submit" class="imtgt-button imtgt-button-primary text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </dialog>
        @endforeach
    </div>
    <div class="mt-6">{{ $banners->links() }}</div>

    <!-- CREATE MODAL -->
    <dialog id="modal-create" class="w-full max-w-2xl rounded-2xl p-0 shadow-2xl backdrop:bg-slate-900/50 open:animate-in open:fade-in open:zoom-in-95" {{ $errors->any() ? 'open' : '' }}>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="border-b border-slate-200 px-6 py-4 flex justify-between items-center bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-900">Tambah Banner Baru</h3>
                <button type="button" onclick="document.getElementById('modal-create').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Upload Foto Banner <span class="text-rose-600">*</span></label>
                    <input type="file" name="image" accept="image/*" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Judul Utama <span class="text-rose-600">*</span></label>
                    <input name="title" value="{{ old('title') }}" required class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Sub-judul / Deskripsi Singkat</label>
                    <textarea name="subtitle" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" rows="2">{{ old('subtitle') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Teks Tombol (CTA)</label>
                        <input name="cta_label" value="{{ old('cta_label') }}" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" placeholder="Misal: Lihat Promo">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">URL Tombol (CTA)</label>
                        <input name="cta_url" value="{{ old('cta_url') }}" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900" placeholder="https://...">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Urutan Tampil <span class="text-rose-600">*</span></label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" required min="1" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Status</label>
                        <select name="is_active" class="imtgt-input bg-slate-50 border-slate-200 text-slate-900">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif (Tampil)</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-200 px-6 py-4 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-create').close()" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Batal</button>
                <button type="submit" class="imtgt-button imtgt-button-primary text-white">Simpan Banner</button>
            </div>
        </form>
    </dialog>
@endsection
