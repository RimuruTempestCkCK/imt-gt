<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Models\Banner;
use App\Models\MediaItem;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.banners.index', [
            'banners' => Banner::query()->with('media')->orderBy('sort_order')->paginate(12),
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ]);
    }

    // create view removed, handled by modal
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'media_item_id' => ['nullable', 'exists:media_items,id'],
            'title' => ['required', 'string', 'max:160'],
            'subtitle' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $mediaItemId = $validated['media_item_id'] ?? null;

        // If user uploaded a new image, create MediaItem on the fly
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $media = MediaItem::create([
                'title' => 'Banner ' . $validated['title'],
                'type' => 'image',
                'source_url' => asset('storage/' . $path),
                'alt_text' => $validated['title'],
            ]);
            $mediaItemId = $media->id;
        }

        $banner = Banner::query()->create([
            'media_item_id' => $mediaItemId,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'cta_label' => $validated['cta_label'],
            'cta_url' => $validated['cta_url'],
            'sort_order' => $validated['sort_order'],
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.banner.created', 'Banner baru dibuat.', $banner);

        return redirect()->route('admin.banners.index')->with('status', 'Banner berhasil dibuat.');
    }

    // edit view removed, handled by modal

    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'media_item_id' => ['nullable', 'exists:media_items,id'],
            'title' => ['required', 'string', 'max:160'],
            'subtitle' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $mediaItemId = $validated['media_item_id'] ?? $banner->media_item_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $media = MediaItem::create([
                'title' => 'Banner ' . $validated['title'],
                'type' => 'image',
                'source_url' => asset('storage/' . $path),
                'alt_text' => $validated['title'],
            ]);
            $mediaItemId = $media->id;
        }

        $banner->update([
            'media_item_id' => $mediaItemId,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'cta_label' => $validated['cta_label'],
            'cta_url' => $validated['cta_url'],
            'sort_order' => $validated['sort_order'],
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.banner.updated', 'Banner diperbarui.', $banner);

        return redirect()->route('admin.banners.index')->with('status', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $banner->delete();

        AuditLogger::log('cms.banner.deleted', 'Banner dihapus.');

        return back()->with('status', 'Banner berhasil dihapus.');
    }
}
