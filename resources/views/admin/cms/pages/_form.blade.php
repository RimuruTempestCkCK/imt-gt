<div class="grid gap-5">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul</label>
        <input name="title" value="{{ old('title', $page->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
        <input name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Status</label>
        <select name="status" class="imtgt-input">
            @foreach (['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $page->status ?? 'draft') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($page?->published_at) ? $page->published_at->format('Y-m-d\TH:i') : '') }}" class="imtgt-input">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Excerpt</label>
        <textarea name="excerpt" rows="4" class="imtgt-input">{{ old('excerpt', $page->excerpt ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Body</label>
        <textarea name="body" rows="10" class="imtgt-input">{{ old('body', $page->body ?? '') }}</textarea>
    </div>
    <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
</div>
