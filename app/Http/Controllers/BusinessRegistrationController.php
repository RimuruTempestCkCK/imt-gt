<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessRegistrationRequest;
use App\Models\CompanyContact;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Region;
use App\Models\User;
use App\Support\AuditLogger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessRegistrationController extends Controller
{
    public function create(): View
    {
        $countries = Country::query()->with(['regions' => fn ($query) => $query->where('is_active', true)->orderBy('name')])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('public.registration', [
            'countries' => $countries,
            'regionsByCountry' => $countries->mapWithKeys(fn ($country) => [
                (string) $country->id => $country->regions->map(fn ($region) => [
                    'id' => $region->id,
                    'name' => $region->name,
                ])->values()->all(),
            ]),
            'companyTypes' => ['PT', 'CV', 'UD', 'FA', 'Koperasi', 'Others', 'PD'],
        ]);
    }

    public function store(StoreBusinessRegistrationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $region = Region::query()->whereKey($data['region_id'])->firstOrFail();

        DB::transaction(function () use ($data, $region): void {
            $user = User::query()->create([
                'name' => $data['pic_name'],
                'username' => $this->generateUsername($data['email']),
                'account_type' => $data['account_type'],
                'country_id' => $data['country_id'],
                'region_id' => $data['region_id'],
                'province' => $region->name,
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $profile = CompanyProfile::query()->create([
                'user_id' => $user->id,
                'company_prefix' => $data['account_type'] === 'buyer' ? null : $data['company_type'],
                'company_name' => $data['company_name'],
                'country_id' => $data['country_id'],
                'region_id' => $data['region_id'],
                'province' => $region->name,
                'business_email' => $data['email'],
                'business_phone' => $data['phone'],
            ]);

            CompanyContact::query()->create([
                'company_profile_id' => $profile->id,
                'name' => $data['pic_name'],
                'position' => 'PIC',
                'phone' => $data['phone'],
                'email' => $data['email'],
                'sort_order' => 1,
            ]);

            AuditLogger::log('business.registration.created', 'User registrasi bisnis baru dibuat.', $user, [
                'account_type' => $user->account_type,
                'email' => $user->email,
            ]);
        });

        return redirect()->route('login')->with('status', app()->isLocale('en')
            ? 'Registration successful. Please log in and complete your company profile.'
            : 'Registrasi berhasil. Silakan login dan lengkapi profil perusahaan Anda.');
    }

    protected function generateUsername(string $email): string
    {
        $base = Str::slug(Str::before($email, '@'), '');
        $base = $base !== '' ? strtolower($base) : 'user';
        $username = $base;
        $counter = 1;

        while (User::query()->where('username', $username)->exists()) {
            $username = $base.$counter;
            $counter++;
        }

        return $username;
    }
}
