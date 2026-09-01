<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul Menu</label>
        <input name="title" value="{{ old('title', $menuItem->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">URL</label>
        <input name="url" value="{{ old('url', $menuItem->url ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Location</label>
        <input name="location" value="{{ old('location', $menuItem->location ?? 'header') }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Urutan</label>
        <input type="number" min="1" name="sort_order" value="{{ old('sort_order', $menuItem->sort_order ?? 1) }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Target</label>
        <select name="target" class="imtgt-input">
            <option value="_self" @selected(old('target', $menuItem->target ?? '_self') === '_self')>Same Tab</option>
            <option value="_blank" @selected(old('target', $menuItem->target ?? '_self') === '_blank')>New Tab</option>
        </select>
    </div>
    <div class="flex items-center gap-3 pt-7">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $menuItem->is_active ?? true))>
        <label class="text-sm text-slate-300">Menu aktif</label>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
