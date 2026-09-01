<div class="space-y-5">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Nama Kategori Produk</label>
        <input name="name" value="{{ old('name', $productCategory->name ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
        <input name="slug" value="{{ old('slug', $productCategory->slug ?? '') }}" class="imtgt-input" placeholder="opsional, otomatis jika kosong">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Deskripsi</label>
        <textarea name="description" rows="5" class="imtgt-input">{{ old('description', $productCategory->description ?? '') }}</textarea>
    </div>
    <label class="flex items-center gap-3 text-sm text-slate-300">
        <input type="checkbox" name="is_active" value="1" class="rounded border-white/20 bg-slate-900" @checked(old('is_active', $productCategory->is_active ?? true))>
        Kategori aktif
    </label>
    <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
</div>
