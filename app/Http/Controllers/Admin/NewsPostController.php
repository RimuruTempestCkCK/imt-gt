<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsPostRequest;
use App\Models\Category;
use App\Models\MediaItem;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsPostController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.news.index', [
            'newsPosts' => NewsPost::query()->with(['category', 'tags'])->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.news.create', $this->formData());
    }

    public function store(StoreNewsPostRequest $request): RedirectResponse
    {
        $newsPost = NewsPost::query()->create([
            ...$request->safe()->except('tag_ids'),
            'user_id' => $request->user()?->id,
            'slug' => Str::slug($request->input('slug') ?: $request->string('title')),
            'featured' => $request->boolean('featured'),
        ]);

        $newsPost->tags()->sync($request->input('tag_ids', []));

        AuditLogger::log('cms.news.created', 'Berita baru dibuat.', $newsPost);

        return redirect()->route('admin.news.index')->with('status', 'Berita berhasil dibuat.');
    }

    public function edit(NewsPost $news): View
    {
        return view('admin.cms.news.edit', $this->formData() + ['newsPost' => $news]);
    }

    public function update(StoreNewsPostRequest $request, NewsPost $news): RedirectResponse
    {
        $news->update([
            ...$request->safe()->except('tag_ids'),
            'slug' => Str::slug($request->input('slug') ?: $request->string('title')),
            'featured' => $request->boolean('featured'),
        ]);

        $news->tags()->sync($request->input('tag_ids', []));

        AuditLogger::log('cms.news.updated', 'Berita diperbarui.', $news);

        return redirect()->route('admin.news.index')->with('status', 'Berita berhasil diperbarui.');
    }

    public function destroy(NewsPost $news): RedirectResponse
    {
        $news->delete();

        AuditLogger::log('cms.news.deleted', 'Berita dihapus.');

        return back()->with('status', 'Berita berhasil dihapus.');
    }

    protected function formData(): array
    {
        return [
            'categories' => Category::query()->orderBy('name')->get(),
            'tags' => Tag::query()->orderBy('name')->get(),
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ];
    }
}
