<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaItemRequest;
use App\Models\MediaItem;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaItemController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.media.index', [
            'mediaItems' => MediaItem::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.media.create');
    }

    public function store(StoreMediaItemRequest $request): RedirectResponse
    {
        $mediaItem = MediaItem::query()->create([
            ...$request->validated(),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        AuditLogger::log('cms.media.created', 'Media baru ditambahkan.', $mediaItem);

        return redirect()->route('admin.media.index')->with('status', 'Media berhasil ditambahkan.');
    }

    public function edit(MediaItem $medium): View
    {
        return view('admin.cms.media.edit', ['mediaItem' => $medium]);
    }

    public function update(StoreMediaItemRequest $request, MediaItem $medium): RedirectResponse
    {
        $medium->update([
            ...$request->validated(),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        AuditLogger::log('cms.media.updated', 'Media diperbarui.', $medium);

        return redirect()->route('admin.media.index')->with('status', 'Media berhasil diperbarui.');
    }

    public function destroy(MediaItem $medium): RedirectResponse
    {
        $medium->delete();

        AuditLogger::log('cms.media.deleted', 'Media dihapus.');

        return back()->with('status', 'Media berhasil dihapus.');
    }
}
