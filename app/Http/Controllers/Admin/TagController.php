<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Models\Tag;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.tags.index', [
            'tags' => Tag::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.tags.create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        $tag = Tag::query()->create([
            ...$request->validated(),
            'slug' => Str::slug($request->input('slug') ?: $request->string('name')),
        ]);

        AuditLogger::log('cms.tag.created', 'Tag baru dibuat.', $tag);

        return redirect()->route('admin.tags.index')->with('status', 'Tag berhasil dibuat.');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.cms.tags.edit', compact('tag'));
    }

    public function update(StoreTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update([
            ...$request->validated(),
            'slug' => Str::slug($request->input('slug') ?: $request->string('name')),
        ]);

        AuditLogger::log('cms.tag.updated', 'Tag diperbarui.', $tag);

        return redirect()->route('admin.tags.index')->with('status', 'Tag berhasil diperbarui.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        AuditLogger::log('cms.tag.deleted', 'Tag dihapus.');

        return back()->with('status', 'Tag berhasil dihapus.');
    }
}
