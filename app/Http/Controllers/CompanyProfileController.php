<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Models\CompanyContact;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Region;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    public function edit(): View
    {
        $user = auth()->user();
        $profile = $user->companyProfile()->with('contacts')->firstOrCreate(
            ['user_id' => $user->id],
            [
                'company_name' => null,
                'province' => $user->province,
                'business_email' => $user->email,
            ]
        );

        return view('account.company-profile', [
            'user' => $user,
            'profile' => $profile,
            'companyPrefixes' => ['PT', 'CV', 'UD', 'FA', 'Koperasi', 'Others', 'PD'],
            'businessScales' => [
                '< 1.000.000.000' => '< 1.000.000.000',
                '1.000.000.000 - 5.000.000.000' => '1.000.000.000 - 5.000.000.000',
                '5.000.000.000 - 10.000.000.000' => '5.000.000.000 - 10.000.000.000',
                '> 10.000.000.000' => '> 10.000.000.000',
            ],
            'businessTypes' => [
                'manufacturer' => 'Manufacturer',
                'distributor' => 'Distributor',
                'trader' => 'Trader',
                'service' => 'Service',
                'cooperative' => 'Cooperative',
                'other' => 'Other',
            ],
            'countries' => Country::query()->with(['regions' => fn ($query) => $query->where('is_active', true)->orderBy('name')])
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(UpdateCompanyProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->companyProfile()->firstOrCreate(['user_id' => $user->id]);
        $data = $request->validated();
        $region = Region::query()->whereKey($data['region_id'])->firstOrFail();

        DB::transaction(function () use ($request, $user, $profile, $data, $region): void {
            if ($request->hasFile('logo')) {
                $data['logo_path'] = $request->file('logo')->store('company-profiles/logos', 'public');
            }

            if ($request->hasFile('npwp_document')) {
                $data['npwp_document_path'] = $request->file('npwp_document')->store('company-profiles/documents', 'public');
            }

            if ($request->hasFile('nib_document')) {
                $data['nib_document_path'] = $request->file('nib_document')->store('company-profiles/documents', 'public');
            }

            unset($data['logo'], $data['npwp_document'], $data['nib_document']);

            $userUpdates = [
                'country_id' => $request->integer('country_id') ?: $user->country_id,
                'region_id' => $request->integer('region_id') ?: $user->region_id,
                'province' => $region->name,
            ];

            if ($request->filled('name')) {
                $userUpdates['name'] = $request->string('name')->toString();
            } elseif ($request->filled('contacts.0.name')) {
                $userUpdates['name'] = $request->string('contacts.0.name')->toString();
            }

            if ($request->filled('account_email')) {
                $userUpdates['email'] = $request->string('account_email')->toString();
            }

            if ($request->filled('password')) {
                $userUpdates['password'] = $request->string('password')->toString();
            }

            $user->forceFill($userUpdates)->save();

            // Clean user-specific fields before filling company profile
            unset($data['name'], $data['account_email'], $data['password'], $data['password_confirmation']);

            $contactsData = $data['contacts'] ?? [];
            unset($data['contacts']);

            $profile->fill($data);
            $profile->province = $region->name;
            $profile->profile_completed_at = now();
            $profile->save();

            $profile->contacts()->delete();

            collect($contactsData)
                ->filter(fn (array $contact) => filled($contact['name'] ?? null))
                ->values()
                ->each(function (array $contact, int $index) use ($profile): void {
                    CompanyContact::query()->create([
                        'company_profile_id' => $profile->id,
                        'name' => $contact['name'],
                        'position' => $contact['position'] ?? null,
                        'phone' => $contact['phone'] ?? null,
                        'email' => $contact['email'] ?? null,
                        'sort_order' => $index + 1,
                    ]);
                });

            AuditLogger::log('company-profile.updated', 'Profil perusahaan diperbarui oleh pengguna.', $profile, [
                'user_id' => $user->id,
                'account_type' => $user->account_type,
            ]);
        });

        return redirect()->route('account.company-profile.edit')->with('status', app()->isLocale('en')
            ? 'Company profile and account information saved successfully.'
            : 'Profil perusahaan dan informasi akun berhasil disimpan.');
    }
}
