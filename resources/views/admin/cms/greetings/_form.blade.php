<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Nama</label>
        <input name="name" value="{{ old('name', $greeting->name ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Jabatan</label>
        <input name="position" value="{{ old('position', $greeting->position ?? '') }}" class="imtgt-input" required>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Headline</label>
        <input name="headline" value="{{ old('headline', $greeting->headline ?? '') }}" class="imtgt-input" required>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Pesan Sambutan</label>
        <textarea name="message" rows="8" class="imtgt-input">{{ old('message', $greeting->message ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Urutan</label>
        <input type="number" min="1" name="sort_order" value="{{ old('sort_order', $greeting->sort_order ?? 1) }}" class="imtgt-input">
    </div>
    <div class="flex items-center gap-3 pt-7">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $greeting->is_active ?? true))>
        <label class="text-sm text-slate-300">Aktif</label>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
