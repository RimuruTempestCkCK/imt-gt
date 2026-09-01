<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Section Key</label>
        <input name="section_key" value="{{ old('section_key', $profileSection->section_key ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul</label>
        <input name="title" value="{{ old('title', $profileSection->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Media</label>
        <select name="media_item_id" class="imtgt-input">
            <option value="">Tanpa media</option>
            @foreach ($mediaItems as $mediaItem)
                <option value="{{ $mediaItem->id }}" @selected((string) old('media_item_id', $profileSection->media_item_id ?? '') === (string) $mediaItem->id)>{{ $mediaItem->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Urutan</label>
        <input type="number" min="1" name="sort_order" value="{{ old('sort_order', $profileSection->sort_order ?? 1) }}" class="imtgt-input">
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Ringkasan</label>
        <textarea name="summary" rows="4" class="imtgt-input">{{ old('summary', $profileSection->summary ?? '') }}</textarea>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Isi Profil</label>
        <textarea name="body" rows="10" class="imtgt-input">{{ old('body', $profileSection->body ?? '') }}</textarea>
    </div>
    <div class="flex items-center gap-3">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $profileSection->is_active ?? true))>
        <label class="text-sm text-slate-300">Aktif</label>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
