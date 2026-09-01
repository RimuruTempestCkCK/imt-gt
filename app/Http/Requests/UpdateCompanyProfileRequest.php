<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'account_email' => ['nullable', 'email:rfc,dns', 'max:255', Rule::unique('users', 'email')->ignore($this->user()->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'company_prefix' => ['nullable', Rule::in(['PT', 'CV', 'UD', 'FA', 'Koperasi', 'Others', 'PD'])],
            'company_name' => ['required', 'string', 'max:255'],
            'year_of_establishment' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'main_product' => ['nullable', 'string', 'max:255'],
            'company_description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'country_id' => ['required', 'exists:countries,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'city' => ['nullable', 'string', 'max:120'],
            'province' => ['nullable', 'string', 'max:120'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'fax' => ['nullable', 'string', 'max:50'],
            'scale_of_business' => ['nullable', Rule::in(['< 1.000.000.000', '1.000.000.000 - 5.000.000.000', '5.000.000.000 - 10.000.000.000', '> 10.000.000.000'])],
            'scale_of_business_detail' => ['nullable', 'string', 'max:255'],
            'incoterm' => ['nullable', 'string', 'max:50'],
            'terms_of_payment' => ['nullable', 'string', 'max:50'],
            'employee_count' => ['nullable', 'integer', 'min:0'],
            'website' => ['nullable', 'url', 'max:255'],
            'business_email' => ['nullable', 'email:rfc,dns', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:50'],
            'type_of_business' => ['nullable', Rule::in(['manufacturer', 'distributor', 'trader', 'service', 'cooperative', 'other'])],
            'type_of_business_detail' => ['nullable', 'string', 'max:255'],
            'google_maps_link' => ['nullable', 'url', 'max:255'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'npwp_number' => ['nullable', 'string', 'max:32'],
            'npwp_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
            'nib_number' => ['nullable', 'string', 'max:64'],
            'nib_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
            'contacts' => ['nullable', 'array'],
            'contacts.*.name' => ['nullable', 'string', 'max:255'],
            'contacts.*.position' => ['nullable', 'string', 'max:255'],
            'contacts.*.phone' => ['nullable', 'string', 'max:50'],
            'contacts.*.email' => ['nullable', 'email:rfc,dns', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Akun / PIC',
            'account_email' => 'Email Akun',
            'password' => 'Password Baru',
            'company_name' => 'Nama Perusahaan',
            'company_prefix' => 'Bentuk Usaha / Badan Hukum',
            'country_id' => 'Negara',
            'region_id' => 'Provinsi / State',
            'logo' => 'Logo Perusahaan',
            'npwp_document' => 'Dokumen NPWP',
            'nib_document' => 'Dokumen NIB',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes('company_prefix', ['required'], function () {
            return auth()->user()?->account_type === 'supplier';
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
