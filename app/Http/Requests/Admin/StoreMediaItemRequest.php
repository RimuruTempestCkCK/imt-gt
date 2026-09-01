<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'type' => ['required', 'in:image,video,document'],
            'source_url' => ['required', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:160'],
            'caption' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }
}
