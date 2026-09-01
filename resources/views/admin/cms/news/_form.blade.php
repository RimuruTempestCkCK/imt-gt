<div class="grid gap-5 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Judul</label>
        <input name="title" value="{{ old('title', $newsPost->title ?? '') }}" class="imtgt-input" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
        <input name="slug" value="{{ old('slug', $newsPost->slug ?? '') }}" class="imtgt-input" placeholder="opsional, otomatis jika kosong">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Kategori</label>
        <select name="category_id" class="imtgt-input">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $newsPost->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Media Cover</label>
        <select name="media_item_id" class="imtgt-input">
            <option value="">Tanpa media</option>
            @foreach ($mediaItems as $mediaItem)
                <option value="{{ $mediaItem->id }}" @selected((string) old('media_item_id', $newsPost->media_item_id ?? '') === (string) $mediaItem->id)>{{ $mediaItem->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Status</label>
        <select name="status" class="imtgt-input">
            @foreach (['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $newsPost->status ?? 'draft') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($newsPost?->published_at) ? $newsPost->published_at->format('Y-m-d\TH:i') : '') }}" class="imtgt-input">
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Tag</label>
        <div class="grid gap-2 rounded-2xl border border-white/10 bg-slate-950/30 p-4 md:grid-cols-3">
            @foreach ($tags as $tag)
                <label class="flex items-center gap-3 text-sm text-slate-300">
                    <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tag_ids', isset($newsPost) ? $newsPost->tags->pluck('id')->all() : [])))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Excerpt</label>
        <textarea name="excerpt" rows="4" class="imtgt-input">{{ old('excerpt', $newsPost->excerpt ?? '') }}</textarea>
    </div>
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-200">Isi Berita</label>
        <textarea name="body" rows="10" class="imtgt-input">{{ old('body', $newsPost->body ?? '') }}</textarea>
    </div>
    <div class="flex items-center gap-3">
        <input type="checkbox" name="featured" value="1" @checked(old('featured', $newsPost->featured ?? false))>
        <label class="text-sm text-slate-300">Tampilkan sebagai berita unggulan</label>
    </div>
    <div class="lg:col-span-2">
        <button type="submit" class="imtgt-button imtgt-button-primary">{{ $buttonText }}</button>
    </div>
</div>
