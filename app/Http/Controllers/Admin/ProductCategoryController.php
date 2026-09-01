<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductCategoryRequest;
use App\Models\ProductCategory;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.commerce.product-categories.index', [
            'categories' => ProductCategory::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.commerce.product-categories.create');
    }

    public function store(StoreProductCategoryRequest $request): RedirectResponse
    {
        $category = ProductCategory::query()->create([
            'name' => $request->string('name')->toString(),
            'slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('name')->toString()),
            'description' => $request->input('description'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::log('product-category.created', 'Kategori produk dibuat.', $category);

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori produk berhasil dibuat.');
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('admin.commerce.product-categories.edit', compact('productCategory'));
    }

    public function update(StoreProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $productCategory->update([
            'name' => $request->string('name')->toString(),
            'slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('name')->toString()),
            'description' => $request->input('description'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::log('product-category.updated', 'Kategori produk diperbarui.', $productCategory);

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        $productCategory->delete();

        AuditLogger::log('product-category.deleted', 'Kategori produk dihapus.');

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori produk berhasil dihapus.');
    }
}
