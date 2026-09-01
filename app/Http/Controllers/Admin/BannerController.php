<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Models\Banner;
use App\Models\MediaItem;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.banners.index', [
            'banners' => Banner::query()->with('media')->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.banners.create', [
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $banner = Banner::query()->create([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.banner.created', 'Banner baru dibuat.', $banner);

        return redirect()->route('admin.banners.index')->with('status', 'Banner berhasil dibuat.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.cms.banners.edit', [
            'banner' => $banner,
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ]);
    }

    public function update(StoreBannerRequest $request, Banner $banner): RedirectResponse
    {
        $banner->update([
            ...$request->validated(),
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
