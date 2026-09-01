<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'import_type' => ['required', 'string', 'max:120'],
            'show_price' => ['nullable', 'boolean'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:10'],
            'price_unit' => ['nullable', 'string', 'max:120'],
            'description' => ['required', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'origin_country' => ['required', 'string', 'max:120'],
            'brand' => ['required', 'string', 'max:120'],
            'model' => ['required', 'string', 'max:120'],
            'sku' => ['required', 'string', 'max:120'],
            'hs_code' => ['required', 'string', 'max:120'],
            'min_order_qty' => ['required', 'string', 'max:120'],
            'production_capacity' => ['required', 'string', 'max:120'],
            'delivery_time' => ['required', 'string', 'max:120'],
            'packaging' => ['required', 'string', 'max:255'],
            'is_hazardous' => ['nullable', 'boolean'],
            'specifications' => ['nullable', 'string'],
            'additional_information' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
            'support_contact' => ['nullable', 'string', 'max:255'],
            'images' => ['nullable', 'array', 'max:8'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes('price', ['required'], function ($input) {
            return (bool) ($input->show_price ?? true);
        });
    }
}
