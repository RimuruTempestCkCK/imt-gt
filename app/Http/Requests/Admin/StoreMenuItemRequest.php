<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'url' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:40'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'target' => ['required', 'in:_self,_blank'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
