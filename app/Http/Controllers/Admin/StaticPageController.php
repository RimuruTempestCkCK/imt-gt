<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStaticPageRequest;
use App\Models\StaticPage;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.pages.index', [
            'pages' => StaticPage::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.pages.create');
    }

    public function store(StoreStaticPageRequest $request): RedirectResponse
    {
        $page = StaticPage::query()->create([
            ...$request->validated(),
            'user_id' => $request->user()?->id,
            'slug' => Str::slug($request->input('slug') ?: $request->string('title')),
        ]);

        AuditLogger::log('cms.page.created', 'Halaman statis dibuat.', $page);

        return redirect()->route('admin.pages.index')->with('status', 'Halaman berhasil dibuat.');
    }

    public function edit(StaticPage $page): View
    {
        return view('admin.cms.pages.edit', compact('page'));
    }

    public function update(StoreStaticPageRequest $request, StaticPage $page): RedirectResponse
    {
        $page->update([
            ...$request->validated(),
            'slug' => Str::slug($request->input('slug') ?: $request->string('title')),
        ]);

        AuditLogger::log('cms.page.updated', 'Halaman statis diperbarui.', $page);

        return redirect()->route('admin.pages.index')->with('status', 'Halaman berhasil diperbarui.');
    }

    public function destroy(StaticPage $page): RedirectResponse
    {
        $page->delete();

        AuditLogger::log('cms.page.deleted', 'Halaman statis dihapus.');

        return back()->with('status', 'Halaman berhasil dihapus.');
    }
}
