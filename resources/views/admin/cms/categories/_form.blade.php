<div class="grid gap-5">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Nama Kategori</label>
        <input name="name" value="{{ old('name', $category->name ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
        <input name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="imtgt-input" placeholder="opsional, otomatis jika kosong">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Deskripsi</label>
        <textarea name="description" rows="5" class="imtgt-input">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
</div>
