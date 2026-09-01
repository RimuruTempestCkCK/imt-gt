<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('account.products.index', [
            'products' => auth()->user()->products()->with('category')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('account.products.create', [
            'product' => new Product([
                'status' => 'draft',
                'trade_kind' => 'goods',
                'show_price' => true,
                'currency' => 'IDR',
            ]),
            'categories' => ProductCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'currencies' => ['IDR', 'USD', 'MYR', 'THB'],
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->companyProfile;
        $data = $request->validated();

        DB::transaction(function () use ($request, $user, $profile, $data): void {
            $product = Product::query()->create([
                'user_id' => $user->id,
                'company_profile_id' => $profile?->id,
                'product_category_id' => $data['product_category_id'],
                'title' => $data['title'],
                'slug' => $this->generateSlug($data['title']),
                'status' => $data['status'],
                'trade_kind' => $data['trade_kind'],
                'import_type' => $data['import_type'],
                'show_price' => (bool) ($data['show_price'] ?? false),
                'price' => ($data['show_price'] ?? false) ? $data['price'] : null,
                'currency' => $data['currency'],
                'price_unit' => $data['price_unit'] ?? null,
                'description' => $data['description'],
                'video_url' => $data['video_url'] ?? null,
                'origin_country' => $data['origin_country'],
                'brand' => $data['brand'],
                'model' => $data['model'],
                'sku' => $data['sku'],
                'hs_code' => $data['hs_code'],
                'min_order_qty' => $data['min_order_qty'],
                'production_capacity' => $data['production_capacity'],
                'delivery_time' => $data['delivery_time'],
                'packaging' => $data['packaging'],
                'is_hazardous' => (bool) ($data['is_hazardous'] ?? false),
                'specifications' => $data['specifications'] ?? null,
                'additional_information' => $data['additional_information'] ?? null,
                'seo_keywords' => $data['seo_keywords'] ?? null,
                'support_contact' => $data['support_contact'] ?? null,
                'published_at' => $data['status'] === 'published' ? now() : null,
            ]);

            foreach ($request->file('images', []) as $index => $image) {
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'path' => $image->store('products/images', 'public'),
                    'sort_order' => $index + 1,
                    'is_primary' => $index === 0,
                ]);
            }

            AuditLogger::log('product.created', 'Produk baru dibuat oleh member.', $product, [
                'status' => $product->status,
                'trade_kind' => $product->trade_kind,
            ]);
        });

        return redirect()->route('account.products.index')->with('status', app()->isLocale('en')
            ? 'Product saved successfully.'
            : 'Produk berhasil disimpan.');
    }

    protected function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 1;

        $query = Product::query()->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
            $query = Product::query()->where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }

    public function edit(Product $product): View
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        return view('account.products.edit', [
            'product' => $product,
            'categories' => ProductCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'currencies' => ['IDR', 'USD', 'MYR', 'THB'],
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validated();

        DB::transaction(function () use ($request, $product, $data): void {
            $product->update([
                'product_category_id' => $data['product_category_id'],
                'title' => $data['title'],
                'slug' => $product->title !== $data['title'] ? $this->generateSlug($data['title'], $product->id) : $product->slug,
                'status' => $data['status'],
                'trade_kind' => $data['trade_kind'],
                'import_type' => $data['import_type'],
                'show_price' => (bool) ($data['show_price'] ?? false),
                'price' => ($data['show_price'] ?? false) ? $data['price'] : null,
                'currency' => $data['currency'],
                'price_unit' => $data['price_unit'] ?? null,
                'description' => $data['description'],
                'video_url' => $data['video_url'] ?? null,
                'origin_country' => $data['origin_country'],
                'brand' => $data['brand'],
                'model' => $data['model'],
                'sku' => $data['sku'],
                'hs_code' => $data['hs_code'],
                'min_order_qty' => $data['min_order_qty'],
                'production_capacity' => $data['production_capacity'],
                'delivery_time' => $data['delivery_time'],
                'packaging' => $data['packaging'],
                'is_hazardous' => (bool) ($data['is_hazardous'] ?? false),
                'specifications' => $data['specifications'] ?? null,
                'additional_information' => $data['additional_information'] ?? null,
                'seo_keywords' => $data['seo_keywords'] ?? null,
                'support_contact' => $data['support_contact'] ?? null,
                'published_at' => $data['status'] === 'published' && !$product->published_at ? now() : $product->published_at,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    ProductImage::query()->create([
                        'product_id' => $product->id,
                        'path' => $image->store('products/images', 'public'),
                        'sort_order' => $product->images()->count() + 1,
                        'is_primary' => $product->images()->count() === 0,
                    ]);
                }
            }

            AuditLogger::log('product.updated', 'Produk diperbarui oleh member.', $product, [
                'status' => $product->status,
                'trade_kind' => $product->trade_kind,
            ]);
        });

        return redirect()->route('account.products.index')->with('status', app()->isLocale('en')
            ? 'Product updated successfully.'
            : 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->delete();

        AuditLogger::log('product.deleted', 'Produk dihapus oleh member.');

        return redirect()->route('account.products.index')->with('status', app()->isLocale('en')
            ? 'Product deleted successfully.'
            : 'Produk berhasil dihapus.');
    }
}
