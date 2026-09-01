<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Models\MenuItem;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.menus.index', [
            'menuItems' => MenuItem::query()->orderBy('location')->orderBy('sort_order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.menus.create');
    }

    public function store(StoreMenuItemRequest $request): RedirectResponse
    {
        $menuItem = MenuItem::query()->create([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.menu.created', 'Menu baru dibuat.', $menuItem);

        return redirect()->route('admin.menus.index')->with('status', 'Menu berhasil dibuat.');
    }

    public function edit(MenuItem $menu): View
    {
        return view('admin.cms.menus.edit', ['menuItem' => $menu]);
    }

    public function update(StoreMenuItemRequest $request, MenuItem $menu): RedirectResponse
    {
        $menu->update([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.menu.updated', 'Menu diperbarui.', $menu);

        return redirect()->route('admin.menus.index')->with('status', 'Menu berhasil diperbarui.');
    }

    public function destroy(MenuItem $menu): RedirectResponse
    {
        $menu->delete();

        AuditLogger::log('cms.menu.deleted', 'Menu dihapus.');

        return back()->with('status', 'Menu berhasil dihapus.');
    }
}
