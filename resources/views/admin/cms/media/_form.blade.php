<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul</label>
        <input name="title" value="{{ old('title', $mediaItem->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Tipe</label>
        <select name="type" class="imtgt-input">
            @foreach (['image' => 'Image', 'video' => 'Video', 'document' => 'Document'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $mediaItem->type ?? 'image') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Source URL / Path Dummy</label>
        <input name="source_url" value="{{ old('source_url', $mediaItem->source_url ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Alt Text</label>
        <input name="alt_text" value="{{ old('alt_text', $mediaItem->alt_text ?? '') }}" class="imtgt-input">
    </div>
    <div class="flex items-center gap-3 pt-7">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $mediaItem->is_featured ?? false))>
        <label class="text-sm text-slate-300">Tandai sebagai featured media</label>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Caption</label>
        <textarea name="caption" rows="4" class="imtgt-input">{{ old('caption', $mediaItem->caption ?? '') }}</textarea>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
