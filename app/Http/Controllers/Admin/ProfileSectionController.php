<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfileSectionRequest;
use App\Models\MediaItem;
use App\Models\ProfileSection;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileSectionController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.profiles.index', [
            'profileSections' => ProfileSection::query()->with('media')->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.profiles.create', [
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreProfileSectionRequest $request): RedirectResponse
    {
        $profileSection = ProfileSection::query()->create([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.profile.created', 'Section profil dibuat.', $profileSection);

        return redirect()->route('admin.profiles.index')->with('status', 'Section profil berhasil dibuat.');
    }

    public function edit(ProfileSection $profile): View
    {
        return view('admin.cms.profiles.edit', [
            'profileSection' => $profile,
            'mediaItems' => MediaItem::query()->orderBy('title')->get(),
        ]);
    }

    public function update(StoreProfileSectionRequest $request, ProfileSection $profile): RedirectResponse
    {
        $profile->update([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.profile.updated', 'Section profil diperbarui.', $profile);

        return redirect()->route('admin.profiles.index')->with('status', 'Section profil berhasil diperbarui.');
    }

    public function destroy(ProfileSection $profile): RedirectResponse
    {
        $profile->delete();

        AuditLogger::log('cms.profile.deleted', 'Section profil dihapus.');

        return back()->with('status', 'Section profil berhasil dihapus.');
    }
}
