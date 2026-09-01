<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBusinessRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_type' => ['required', Rule::in(['supplier', 'buyer'])],
            'country_id' => ['required', 'exists:countries,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'email' => ['required', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_type' => ['nullable', Rule::in(['PT', 'CV', 'UD', 'FA', 'Koperasi', 'Others', 'PD'])],
            'company_name' => ['required', 'string', 'max:255'],
            'pic_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes('company_type', ['required'], function ($input) {
            return $input->account_type === 'supplier';
        });

        $validator->after(function ($validator) {
            $countryId = (int) $this->input('country_id');
            $regionId = (int) $this->input('region_id');

            if ($countryId && $regionId) {
                $exists = \App\Models\Region::query()
                    ->whereKey($regionId)
                    ->where('country_id', $countryId)
                    ->exists();

                if (! $exists) {
                    $validator->errors()->add('region_id', __('Provinsi / state tidak sesuai dengan negara yang dipilih.'));
                }
            }
        });
    }
}
