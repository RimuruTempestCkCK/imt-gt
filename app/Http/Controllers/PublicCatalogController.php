<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicCatalogController extends Controller
{
    public function products(Request $request): View
    {
        $products = Product::query()
            ->with(['category', 'images', 'companyProfile.country', 'companyProfile.region'])
            ->where('status', 'published')
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $keyword = trim((string) $request->string('q'));

                $query->where(function (Builder $inner) use ($keyword): void {
                    $inner->where('title', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('brand', 'like', "%{$keyword}%")
                        ->orWhere('origin_country', 'like', "%{$keyword}%")
                        ->orWhereHas('companyProfile', fn (Builder $company) => $company
                            ->where('company_name', 'like', "%{$keyword}%")
                            ->orWhere('main_product', 'like', "%{$keyword}%"));
                });
            })
            ->when($request->filled('category'), fn (Builder $query) => $query->whereHas('category', fn (Builder $category) => $category->where('slug', $request->string('category')->toString())))
            ->when($request->filled('trade_kind'), fn (Builder $query) => $query->where('trade_kind', $request->string('trade_kind')->toString()))
            ->when($request->filled('origin_country'), fn (Builder $query) => $query->where('origin_country', $request->string('origin_country')->toString()))
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('public.products.index', [
            'products' => $products,
            'categories' => ProductCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'originCountries' => Product::query()->where('status', 'published')->whereNotNull('origin_country')->distinct()->orderBy('origin_country')->pluck('origin_country'),
            'tradeKinds' => [
                'goods' => app()->isLocale('en') ? 'Imported Goods' : 'Import Barang',
                'services' => app()->isLocale('en') ? 'Imported Services' : 'Import Jasa',
            ],
            'filters' => $request->only(['q', 'category', 'trade_kind', 'origin_country']),
        ]);
    }

    public function productDetail(Product $product): View
    {
        abort_unless($product->status === 'published', 404);

        $product->load([
            'category',
            'images',
            'companyProfile.country',
            'companyProfile.region',
            'companyProfile.contacts',
        ]);

        $relatedProducts = Product::query()
            ->with(['images', 'category', 'companyProfile'])
            ->where('status', 'published')
            ->whereKeyNot($product->id)
            ->when($product->product_category_id, fn (Builder $query) => $query->where('product_category_id', $product->product_category_id))
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('public.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function industries(Request $request): View
    {
        $countries = Country::query()
            ->with(['regions' => fn ($query) => $query->where('is_active', true)->orderBy('name')])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $industries = CompanyProfile::query()
            ->with(['country', 'region', 'contacts', 'products' => fn ($query) => $query->where('status', 'published')->with('images')->latest('published_at')])
            ->withCount(['products as published_products_count' => fn ($query) => $query->where('status', 'published')])
            ->whereNotNull('profile_completed_at')
            ->whereHas('user', fn (Builder $query) => $query->where('account_type', 'supplier'))
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $keyword = trim((string) $request->string('q'));

                $query->where(function (Builder $inner) use ($keyword): void {
                    $inner->where('company_name', 'like', "%{$keyword}%")
                        ->orWhere('main_product', 'like', "%{$keyword}%")
                        ->orWhere('company_description', 'like', "%{$keyword}%")
                        ->orWhere('city', 'like', "%{$keyword}%")
                        ->orWhere('province', 'like', "%{$keyword}%");
                });
            })
            ->when($request->filled('country_id'), fn (Builder $query) => $query->where('country_id', $request->integer('country_id')))
            ->when($request->filled('region_id'), fn (Builder $query) => $query->where('region_id', $request->integer('region_id')))
            ->when($request->filled('type_of_business'), fn (Builder $query) => $query->where('type_of_business', $request->string('type_of_business')->toString()))
            ->when($request->filled('scale_of_business'), fn (Builder $query) => $query->where('scale_of_business', $request->string('scale_of_business')->toString()))
            ->orderByDesc('published_products_count')
            ->orderBy('company_name')
            ->paginate(9)
            ->withQueryString();

        return view('public.industries.index', [
            'industries' => $industries,
            'countries' => $countries,
            'regionsByCountry' => $countries->mapWithKeys(fn ($country) => [
                (string) $country->id => $country->regions->map(fn ($region) => ['id' => $region->id, 'name' => $region->name])->values()->all(),
            ]),
            'businessTypes' => [
                'manufacturer' => 'Manufacturer',
                'distributor' => 'Distributor',
                'trader' => 'Trader',
                'service' => 'Service',
                'cooperative' => 'Cooperative',
                'other' => 'Other',
            ],
            'businessScales' => [
                '< 1.000.000.000' => '< 1.000.000.000',
                '1.000.000.000 - 5.000.000.000' => '1.000.000.000 - 5.000.000.000',
                '5.000.000.000 - 10.000.000.000' => '5.000.000.000 - 10.000.000.000',
                '> 10.000.000.000' => '> 10.000.000.000',
            ],
            'filters' => $request->only(['q', 'country_id', 'region_id', 'type_of_business', 'scale_of_business']),
        ]);
    }

    public function industryDetail(CompanyProfile $companyProfile): View
    {
        abort_unless($companyProfile->profile_completed_at !== null && $companyProfile->user?->account_type === 'supplier', 404);

        $companyProfile->load([
            'country',
            'region',
            'contacts',
            'products' => fn ($query) => $query->where('status', 'published')->with(['images', 'category'])->latest('published_at'),
        ]);

        $similarIndustries = CompanyProfile::query()
            ->with(['country', 'region'])
            ->withCount(['products as published_products_count' => fn ($query) => $query->where('status', 'published')])
            ->whereNotNull('profile_completed_at')
            ->whereHas('user', fn (Builder $query) => $query->where('account_type', 'supplier'))
            ->whereKeyNot($companyProfile->id)
            ->when($companyProfile->country_id, fn (Builder $query) => $query->where('country_id', $companyProfile->country_id))
            ->orderByDesc('published_products_count')
            ->take(3)
            ->get();

        return view('public.industries.show', [
            'industry' => $companyProfile,
            'similarIndustries' => $similarIndustries,
        ]);
    }
}
