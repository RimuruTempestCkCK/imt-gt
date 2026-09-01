<div class="grid gap-5">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Nama Tag</label>
        <input name="name" value="{{ old('name', $tag->name ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
        <input name="slug" value="{{ old('slug', $tag->slug ?? '') }}" class="imtgt-input" placeholder="opsional, otomatis jika kosong">
    </div>
    <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
</div>
