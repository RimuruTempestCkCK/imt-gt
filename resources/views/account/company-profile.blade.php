@php
    $isEnglish = app()->isLocale('en');
    $regionsByCountry = $countries->mapWithKeys(fn ($country) => [
        (string) $country->id => $country->regions->map(fn ($region) => [
            'id' => $region->id,
            'name' => $region->name,
        ])->values()->all(),
    ]);
    $contacts = old('contacts', $profile->contacts->map(fn ($contact) => [
        'name' => $contact->name,
        'position' => $contact->position,
        'phone' => $contact->phone,
        'email' => $contact->email,
    ])->all());

    if ($contacts === []) {
        $contacts = [[
            'name' => $user->name,
            'position' => 'PIC',
            'phone' => $profile->business_phone,
            'email' => $profile->business_email ?: $user->email,
        ]];
    }
@endphp

@extends('layouts.member')

@section('title', $isEnglish ? 'Complete Company Profile' : 'Lengkapi Profil Perusahaan')
@section('heading', $isEnglish ? 'Company Profile' : 'Profil Perusahaan')

@section('content')
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 max-w-4xl">
                <p class="text-sm font-semibold uppercase tracking-[0.32em] text-cyan-700">{{ $isEnglish ? 'Business Onboarding' : 'Onboarding Bisnis' }}</p>
            <h1 class="mt-4 font-['Playfair_Display'] text-4xl text-slate-950">{{ $isEnglish ? 'Complete Your Company Profile' : 'Lengkapi Profil Perusahaan Anda' }}</h1>
            <p class="mt-4 text-base leading-8 text-slate-600">
                {{ $isEnglish ? 'We simplified the form into clear sections so you can finish it faster: account summary, company profile, legal documents, and contact persons.' : 'Form ini kami pecah menjadi beberapa bagian yang jelas agar lebih cepat diselesaikan: ringkasan akun, profil perusahaan, dokumen legal, dan contact person.' }}
            </p>
        </div>

        <div class="mb-8 grid gap-4 lg:grid-cols-3">
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Step 1' : 'Langkah 1' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Review Account Info' : 'Cek Informasi Akun' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Confirm your account type, email, and province before completing the business data.' : 'Pastikan tipe akun, email, dan provinsi Anda sudah benar sebelum melengkapi data bisnis.' }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Step 2' : 'Langkah 2' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Complete Company Details' : 'Lengkapi Data Perusahaan' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Use the grouped fields below. We keep related inputs together to reduce cognitive load.' : 'Gunakan kelompok field di bawah. Input yang saling berkaitan didekatkan agar beban kognitif lebih ringan.' }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Step 3' : 'Langkah 3' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Upload Legal Documents' : 'Upload Dokumen Legal' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Finish with NPWP, NIB, and your key company contacts so the team can review faster.' : 'Akhiri dengan NPWP, NIB, dan contact person utama agar tim lebih cepat melakukan review.' }}</p>
            </div>
        </div>

        <form action="{{ route('account.company-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <section class="grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                    <div class="mb-8 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Account Information' : 'Informasi Akun' }}</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Account Information '.ucfirst($user->account_type ?? 'User') : 'Informasi Akun '.ucfirst($user->account_type ?? 'User') }}</h2>
                        </div>
                        <span class="rounded-full bg-cyan-50 px-4 py-2 text-sm font-semibold text-cyan-700">{{ $isEnglish ? 'Required before approval' : 'Wajib sebelum approval' }}</span>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $isEnglish ? 'PIC Name' : 'PIC Nama' }}</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $user->name }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Email</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $user->email }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $isEnglish ? 'Region' : 'Wilayah' }}</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $profile->province ?: $user->province ?: '-' }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $isEnglish ? 'Password' : 'Password' }}</p>
                            <p class="mt-2 text-lg font-semibold tracking-[0.3em] text-slate-900">••••••••••</p>
                        </div>
                    </div>
                </div>

                <aside class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6 text-center">
                        <div class="mx-auto grid h-56 w-56 place-items-center rounded-[1.5rem] bg-white shadow-sm">
                            <svg viewBox="0 0 240 240" class="h-44 w-44 text-slate-900" fill="currentColor" aria-hidden="true">
                                <rect x="20" y="20" width="56" height="56" rx="6"></rect>
                                <rect x="164" y="20" width="56" height="56" rx="6"></rect>
                                <rect x="20" y="164" width="56" height="56" rx="6"></rect>
                                <rect x="36" y="36" width="24" height="24" fill="white"></rect>
                                <rect x="180" y="36" width="24" height="24" fill="white"></rect>
                                <rect x="36" y="180" width="24" height="24" fill="white"></rect>
                                <path d="M104 28h12v12h-12zM128 28h12v12h-12zM104 52h12v12h-12zM128 52h12v12h-12zM92 92h12v12H92zM116 92h12v12h-12zM140 92h12v12h-12zM92 116h12v12H92zM140 116h12v12h-12zM92 140h12v12H92zM116 140h12v12h-12zM164 104h12v12h-12zM188 104h12v12h-12zM164 128h12v12h-12zM188 128h12v12h-12zM104 164h12v12h-12zM128 164h12v12h-12zM152 164h12v12h-12zM128 188h12v12h-12zM152 188h12v12h-12zM176 188h12v12h-12z"></path>
                            </svg>
                        </div>
                        <p class="mt-5 text-2xl font-semibold text-slate-900">QR Code</p>
                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'The business card QR will be refined after your profile is fully reviewed.' : 'QR kartu bisnis akan disempurnakan setelah profil Anda selesai direview.' }}</p>
                    </div>
                    <div class="mt-6 rounded-[1.5rem] border border-slate-200 p-4 text-center">
                        <p class="text-sm font-medium text-slate-700">{{ $isEnglish ? 'Share your profile later to social media' : 'Bagikan profil Anda nanti ke media sosial' }}</p>
                        <div class="mt-4 flex items-center justify-center gap-4 text-cyan-600">
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-cyan-50 text-lg font-bold">X</span>
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-cyan-50 text-lg font-bold">f</span>
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-cyan-50 text-lg font-bold">wa</span>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Company Profile' : 'Profil Perusahaan' }}</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Company Profile' : 'Profil Perusahaan' }}</h2>
                </div>

                <div class="grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
                    <div class="space-y-5">
                        <div class="grid gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Name of Company' : 'Nama Perusahaan' }}</label>
                                <div class="grid gap-3" data-company-profile-wrapper>
                                    <div class="grid gap-3 md:grid-cols-[140px_1fr] {{ $user->account_type === 'buyer' ? 'md:grid-cols-1' : '' }}" data-company-prefix-grid>
                                        <div data-company-prefix-wrapper class="{{ $user->account_type === 'buyer' ? 'hidden' : '' }}">
                                            <select name="company_prefix" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                                <option value="">-</option>
                                                @foreach ($companyPrefixes as $prefix)
                                                    <option value="{{ $prefix }}" @selected(old('company_prefix', $profile->company_prefix) === $prefix)>{{ $prefix }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_prefix')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <input name="company_name" value="{{ old('company_name', $profile->company_name) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Enter company name' : 'Masukkan nama perusahaan' }}">
                                            @error('company_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Year of Establishment' : 'Tahun Berdiri' }}</label>
                                <input name="year_of_establishment" type="number" value="{{ old('year_of_establishment', $profile->year_of_establishment) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Main Product' : 'Produk Utama' }}</label>
                                <input name="main_product" value="{{ old('main_product', $profile->main_product) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Company Description' : 'Deskripsi Perusahaan' }}</label>
                                <textarea name="company_description" rows="4" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">{{ old('company_description', $profile->company_description) }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Address' : 'Alamat' }}</label>
                                <textarea name="address" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">{{ old('address', $profile->address) }}</textarea>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'City' : 'Kota' }}</label>
                                <input name="city" value="{{ old('city', $profile->city) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Country' : 'Negara' }}</label>
                                <select id="country_id" name="country_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                    <option value="">{{ $isEnglish ? '- Choose Country -' : '- Pilih Negara -' }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected((string) old('country_id', $profile->country_id ?: $user->country_id) === (string) $country->id)>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Province / State' : 'Provinsi / State' }}</label>
                                <select id="region_id" name="region_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                    <option value="">{{ $isEnglish ? '- Choose Province / State -' : '- Pilih Provinsi / State -' }}</option>
                                </select>
                                <input type="hidden" id="province" name="province" value="{{ old('province', $profile->province ?: $user->province) }}">
                                @error('region_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Zip Code' : 'Kode Pos' }}</label>
                                <input name="zip_code" value="{{ old('zip_code', $profile->zip_code) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Fax</label>
                                <input name="fax" value="{{ old('fax', $profile->fax) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Scale of Business' : 'Skala Bisnis' }}</label>
                                <select name="scale_of_business" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                    <option value="">-</option>
                                    @foreach ($businessScales as $scaleKey => $scaleLabel)
                                        <option value="{{ $scaleKey }}" @selected(old('scale_of_business', $profile->scale_of_business) === $scaleKey)>{{ $scaleLabel }}</option>
                                    @endforeach
                                </select>
                                @error('scale_of_business')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Incoterm</label>
                                <input name="incoterm" value="{{ old('incoterm', $profile->incoterm) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="CIF, FOB, EXW">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Terms of Payment' : 'Terms of Payment' }}</label>
                                <input name="terms_of_payment" value="{{ old('terms_of_payment', $profile->terms_of_payment) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="LC, TT">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Employee' : 'Jumlah Karyawan' }}</label>
                                <input name="employee_count" type="number" value="{{ old('employee_count', $profile->employee_count) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Website</label>
                                <input name="website" value="{{ old('website', $profile->website) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">E-mail</label>
                                <input name="business_email" value="{{ old('business_email', $profile->business_email ?: $user->email) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                                <input name="business_phone" value="{{ old('business_phone', $profile->business_phone) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Type of Business' : 'Jenis Usaha' }}</label>
                                <div class="grid gap-3 md:grid-cols-[1fr_1fr]">
                                    <select name="type_of_business" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                        <option value="">-</option>
                                        @foreach ($businessTypes as $typeKey => $typeLabel)
                                            <option value="{{ $typeKey }}" @selected(old('type_of_business', $profile->type_of_business) === $typeKey)>{{ $typeLabel }}</option>
                                        @endforeach
                                    </select>
                                    <input name="type_of_business_detail" value="{{ old('type_of_business_detail', $profile->type_of_business_detail) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Optional detail' : 'Detail opsional' }}">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Link Google Maps' : 'Link Google Maps' }}</label>
                                <input name="google_maps_link" value="{{ old('google_maps_link', $profile->google_maps_link) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="https://maps.google.com/...">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Longitude</label>
                                <input name="longitude" value="{{ old('longitude', $profile->longitude) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Latitude</label>
                                <input name="latitude" value="{{ old('latitude', $profile->latitude) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <div class="mx-auto flex h-64 w-full max-w-[18rem] items-center justify-center overflow-hidden rounded-[1.5rem] bg-white shadow-sm">
                                @if ($profile->logo_path)
                                    <img src="{{ asset('storage/'.$profile->logo_path) }}" alt="Company logo" class="h-full w-full object-cover">
                                @else
                                    <svg viewBox="0 0 240 240" class="h-40 w-40 text-slate-300" fill="currentColor" aria-hidden="true">
                                        <circle cx="120" cy="78" r="40"></circle>
                                        <path d="M50 214c5-46 31-72 70-72s65 26 70 72H50Z"></path>
                                    </svg>
                                @endif
                            </div>
                            <p class="mt-5 text-2xl font-semibold text-slate-900">{{ $isEnglish ? 'Company logo' : 'Logo perusahaan' }}</p>
                            <label class="mt-4 inline-flex cursor-pointer rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                                {{ $isEnglish ? 'Upload logo' : 'Upload logo' }}
                                <input type="file" name="logo" class="hidden" accept="image/*">
                            </label>
                            <p class="mt-3 text-sm text-slate-500">{{ $isEnglish ? 'Use a clear square image for the best result.' : 'Gunakan gambar persegi yang jelas agar hasil lebih baik.' }}</p>
                            @error('logo')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Company Documents' : 'Dokumen Perusahaan' }}</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Company Documents' : 'Dokumen Perusahaan' }}</h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">NPWP</label>
                        <input name="npwp_number" value="{{ old('npwp_number', $profile->npwp_number) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Numbers only, without dots' : 'Angka saja tanpa titik' }}">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'NPWP Document' : 'Dokumen NPWP' }}</label>
                        <input type="file" name="npwp_document" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">
                        @if ($profile->npwp_document_path)
                            <p class="mt-2 text-sm text-slate-500">{{ $isEnglish ? 'Current file is already uploaded.' : 'File saat ini sudah terunggah.' }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Business Identification Number (NIB)' : 'Nomor Induk Berusaha (NIB)' }}</label>
                        <input name="nib_number" value="{{ old('nib_number', $profile->nib_number) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'NIB Document' : 'Dokumen NIB' }}</label>
                        <input type="file" name="nib_document" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">
                        @if ($profile->nib_document_path)
                            <p class="mt-2 text-sm text-slate-500">{{ $isEnglish ? 'Current file is already uploaded.' : 'File saat ini sudah terunggah.' }}</p>
                        @endif
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Contact Persons' : 'Contact Person' }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Company Contacts' : 'Kontak Perusahaan' }}</h2>
                    </div>
                    <button type="button" id="add-contact" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        {{ $isEnglish ? '+ Add Contact' : '+ Tambah Contact' }}
                    </button>
                </div>

                <div id="contact-list" class="space-y-4">
                    @foreach ($contacts as $index => $contact)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5" data-contact-row>
                            <div class="grid gap-4 lg:grid-cols-4">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Name' : 'Nama' }}</label>
                                    <input name="contacts[{{ $index }}][name]" value="{{ $contact['name'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Position' : 'Posisi' }}</label>
                                    <input name="contacts[{{ $index }}][position]" value="{{ $contact['position'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                                    <input name="contacts[{{ $index }}][phone]" value="{{ $contact['phone'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                                    <input name="contacts[{{ $index }}][email]" value="{{ $contact['email'] ?? '' }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="flex flex-col gap-4 rounded-[2rem] border border-slate-200 bg-white px-6 py-5 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Save the profile once all key fields are filled. We intentionally keep the main action fixed at the end to match the natural reading flow.' : 'Simpan profil setelah semua field penting terisi. Aksi utama sengaja diletakkan di akhir agar sesuai alur baca pengguna.' }}</p>
                <button type="submit" class="rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-200 transition hover:bg-cyan-700">
                    {{ $isEnglish ? 'Save Company Profile' : 'Simpan Profil Perusahaan' }}
                </button>
            </div>
        </form>
    </div>

    <template id="contact-template">
        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5" data-contact-row>
            <div class="grid gap-4 lg:grid-cols-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Name' : 'Nama' }}</label>
                    <input data-field="name" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Position' : 'Posisi' }}</label>
                    <input data-field="position" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                    <input data-field="phone" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input data-field="email" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900">
                </div>
            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addContactButton = document.getElementById('add-contact');
            const contactList = document.getElementById('contact-list');
            const template = document.getElementById('contact-template');
            const countrySelect = document.getElementById('country_id');
            const regionSelect = document.getElementById('region_id');
            const provinceInput = document.getElementById('province');
            const regionsByCountry = @json($regionsByCountry);
            const selectedRegion = @json((string) old('region_id', $profile->region_id ?: $user->region_id));

            if (addContactButton && contactList && template) {
                addContactButton.addEventListener('click', () => {
                    const index = contactList.querySelectorAll('[data-contact-row]').length;
                    const clone = template.content.cloneNode(true);

                    clone.querySelectorAll('[data-field]').forEach((field) => {
                        const key = field.getAttribute('data-field');
                        field.name = `contacts[${index}][${key}]`;
                    });

                    contactList.appendChild(clone);
                });
            }

            const syncRegions = (preserveSelection = true) => {
                if (!countrySelect || !regionSelect) {
                    return;
                }

                const countryId = countrySelect.value;
                const regions = regionsByCountry[countryId] ?? [];
                const placeholder = @json($isEnglish ? '- Choose Province / State -' : '- Pilih Provinsi / State -');
                const currentValue = preserveSelection ? selectedRegion : '';

                regionSelect.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = placeholder;
                regionSelect.appendChild(defaultOption);

                regions.forEach((region) => {
                    const option = document.createElement('option');
                    option.value = String(region.id);
                    option.textContent = region.name;

                    if (String(region.id) === String(currentValue)) {
                        option.selected = true;
                        if (provinceInput) {
                            provinceInput.value = region.name;
                        }
                    }

                    regionSelect.appendChild(option);
                });
            };

            countrySelect?.addEventListener('change', () => {
                syncRegions(false);

                if (regionSelect) {
                    regionSelect.value = '';
                }

                if (provinceInput) {
                    provinceInput.value = '';
                }
            });

            regionSelect?.addEventListener('change', () => {
                const selectedOption = regionSelect.options[regionSelect.selectedIndex];

                if (provinceInput) {
                    provinceInput.value = selectedOption?.text && regionSelect.value ? selectedOption.text : '';
                }
            });

            syncRegions();
        });
    </script>
@endsection
