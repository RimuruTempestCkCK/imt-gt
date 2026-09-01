<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'trade_kind' => ['required', Rule::in(['goods', 'services'])],
            'import_type' => ['nullable', 'string', 'max:120'],
            'show_price' => ['nullable', 'boolean'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:10'],
            'price_unit' => ['nullable', 'string', 'max:120'],
            'description' => ['required', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'origin_country' => ['nullable', 'string', 'max:120'],
            'brand' => ['nullable', 'string', 'max:120'],
            'model' => ['nullable', 'string', 'max:120'],
            'sku' => ['nullable', 'string', 'max:120'],
            'hs_code' => ['nullable', 'string', 'max:120'],
            'min_order_qty' => ['nullable', 'string', 'max:120'],
            'production_capacity' => ['nullable', 'string', 'max:120'],
            'delivery_time' => ['nullable', 'string', 'max:120'],
            'packaging' => ['nullable', 'string', 'max:255'],
            'is_hazardous' => ['nullable', 'boolean'],
            'specifications' => ['nullable', 'string'],
            'additional_information' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
            'support_contact' => ['nullable', 'string', 'max:255'],
            'images' => ['required', 'array', 'min:1', 'max:8'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes('price', ['required'], function ($input) {
            return (bool) ($input->show_price ?? true);
        });
    }
}
