<div class="grid gap-5 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul Banner</label>
        <input name="title" value="{{ old('title', $banner->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Subtitle</label>
        <textarea name="subtitle" rows="4" class="imtgt-input">{{ old('subtitle', $banner->subtitle ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Media</label>
        <select name="media_item_id" class="imtgt-input">
            <option value="">Tanpa media</option>
            @foreach ($mediaItems as $mediaItem)
                <option value="{{ $mediaItem->id }}" @selected((string) old('media_item_id', $banner->media_item_id ?? '') === (string) $mediaItem->id)>{{ $mediaItem->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Urutan</label>
        <input type="number" min="1" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 1) }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Label CTA</label>
        <input name="cta_label" value="{{ old('cta_label', $banner->cta_label ?? '') }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">URL CTA</label>
        <input name="cta_url" value="{{ old('cta_url', $banner->cta_url ?? '') }}" class="imtgt-input">
    </div>
    <div class="flex items-center gap-3">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active ?? true))>
        <label class="text-sm text-slate-300">Banner aktif</label>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
