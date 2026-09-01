<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', \App\Models\Setting::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'app_name' => ['required', 'string', 'max:100'],
            'app_tagline' => ['nullable', 'string', 'max:160'],
            'app_email' => ['nullable', 'email', 'max:100'],
            'app_phone' => ['nullable', 'string', 'max:40'],
            'app_address' => ['nullable', 'string', 'max:255'],
            'app_locale' => ['required', 'string', 'max:10'],
            'app_timezone' => ['required', 'timezone'],
            'hero_title' => ['required', 'string', 'max:160'],
            'hero_subtitle' => ['required', 'string', 'max:255'],
        ];
    }
}
