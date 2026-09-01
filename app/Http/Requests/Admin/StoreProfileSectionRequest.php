<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'media_item_id' => ['nullable', 'exists:media_items,id'],
            'section_key' => ['required', 'string', 'max:60'],
            'title' => ['required', 'string', 'max:160'],
            'summary' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
