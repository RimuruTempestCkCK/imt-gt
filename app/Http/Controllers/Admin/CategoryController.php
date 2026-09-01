<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.categories.index', [
            'categories' => Category::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = Category::query()->create([
            ...$request->validated(),
            'slug' => Str::slug($request->input('slug') ?: $request->string('name')),
        ]);

        AuditLogger::log('cms.category.created', 'Kategori baru dibuat.', $category);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori berhasil dibuat.');
    }

    public function edit(Category $category): View
    {
        return view('admin.cms.categories.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            ...$request->validated(),
            'slug' => Str::slug($request->input('slug') ?: $request->string('name')),
        ]);

        AuditLogger::log('cms.category.updated', 'Kategori diperbarui.', $category);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        AuditLogger::log('cms.category.deleted', 'Kategori dihapus.');

        return back()->with('status', 'Kategori berhasil dihapus.');
    }
}
