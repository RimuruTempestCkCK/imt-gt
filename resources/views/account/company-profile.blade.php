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

@section('title', $isEnglish ? 'Manage Company Profile' : 'Kelola Profil Perusahaan')
@section('heading', $isEnglish ? 'Company Profile' : 'Profil Perusahaan')

@section('content')
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 max-w-4xl">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-cyan-700">{{ $isEnglish ? 'Business Center' : 'Pusat Bisnis' }}</p>
            <h1 class="mt-4 font-['Playfair_Display'] text-4xl text-slate-950">{{ $isEnglish ? 'Manage Your Company Profile & Account' : 'Kelola Profil Perusahaan & Akun Anda' }}</h1>
            <p class="mt-4 text-base leading-8 text-slate-600">
                {{ $isEnglish ? 'Update your business information, legal documents, contacts, and account credentials to keep your directory listing up to date.' : 'Perbarui informasi bisnis, dokumen legalitas, kontak person, dan informasi akun Anda agar data profil selalu mutakhir di direktori.' }}
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-8 rounded-2xl border border-rose-200 bg-rose-50 p-6 text-rose-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-6 w-6 shrink-0 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <h3 class="text-base font-semibold">{{ $isEnglish ? 'Please check the following errors:' : 'Mohon periksa beberapa kesalahan berikut:' }}</h3>
                </div>
                <ul class="mt-3 list-inside list-disc space-y-1 text-sm text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-8 grid gap-4 lg:grid-cols-3">
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Section 1' : 'Bagian 1' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Account Credentials' : 'Informasi Akun & Login' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Manage your PIC name, login email, and change password.' : 'Kelola nama PIC, email untuk login, serta ubah password akun Anda.' }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Section 2' : 'Bagian 2' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Company Details' : 'Profil Perusahaan' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Manage company identity, logo, address, and business scale.' : 'Lengkapi identitas bisnis, logo resmi, lokasi usaha, dan skala bisnis.' }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">{{ $isEnglish ? 'Section 3' : 'Bagian 3' }}</p>
                <h2 class="mt-3 text-lg font-semibold text-slate-950">{{ $isEnglish ? 'Legal Docs & Contacts' : 'Dokumen Legalitas & Kontak' }}</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">{{ $isEnglish ? 'Upload NPWP/NIB files and add multiple contact persons.' : 'Unggah NPWP, NIB, dan tambahkan beberapa kontak person penanggung jawab.' }}</p>
            </div>
        </div>

        <form action="{{ route('account.company-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- SECTION 1: ACCOUNT INFORMATION --}}
            <section class="grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                    <div class="mb-8 flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-5">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Account Information' : 'Informasi Akun' }}</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Account Information ('.ucfirst($user->account_type ?? 'User').')' : 'Informasi Akun ('.ucfirst($user->account_type ?? 'User').')' }}</h2>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="rounded-full bg-cyan-50 px-3.5 py-1.5 text-xs font-semibold text-cyan-700">@ {{ $user->username ?: 'user' }}</span>
                            <span class="rounded-full bg-emerald-50 px-3.5 py-1.5 text-xs font-semibold text-emerald-700">{{ ucfirst($user->account_type ?? 'Supplier') }}</span>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    {{ $isEnglish ? 'PIC Name' : 'Nama PIC / Pengelola' }}
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                    placeholder="{{ $isEnglish ? 'Enter PIC name' : 'Nama PIC penanggung jawab' }}"
                                    required
                                >
                                @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    {{ $isEnglish ? 'Account Email (Login)' : 'Email Akun (Login)' }}
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="account_email"
                                    value="{{ old('account_email', $user->email) }}"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                    placeholder="email@domain.com"
                                    required
                                >
                                @error('account_email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50/75 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">{{ $isEnglish ? 'Change Password (Optional)' : 'Ganti Password (Opsional)' }}</h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $isEnglish ? 'Leave blank if you do not want to change your current password.' : 'Kosongkan jika Anda tidak ingin mengubah password yang saat ini digunakan.' }}</p>
                            
                            <div class="mt-4 grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-1.5 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'New Password' : 'Password Baru' }}</label>
                                    <input
                                        type="password"
                                        name="password"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                        placeholder="{{ $isEnglish ? 'Min. 8 characters' : 'Minimal 8 karakter' }}"
                                        autocomplete="new-password"
                                    >
                                    @error('password')<p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Confirm New Password' : 'Konfirmasi Password Baru' }}</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                        placeholder="{{ $isEnglish ? 'Repeat new password' : 'Ulangi password baru' }}"
                                        autocomplete="new-password"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="flex flex-col justify-between rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6 text-center">
                        <div class="mx-auto grid h-48 w-48 place-items-center rounded-[1.5rem] bg-white shadow-sm">
                            <svg viewBox="0 0 240 240" class="h-36 w-36 text-slate-900" fill="currentColor" aria-hidden="true">
                                <rect x="20" y="20" width="56" height="56" rx="6"></rect>
                                <rect x="164" y="20" width="56" height="56" rx="6"></rect>
                                <rect x="20" y="164" width="56" height="56" rx="6"></rect>
                                <rect x="36" y="36" width="24" height="24" fill="white"></rect>
                                <rect x="180" y="36" width="24" height="24" fill="white"></rect>
                                <rect x="36" y="180" width="24" height="24" fill="white"></rect>
                                <path d="M104 28h12v12h-12zM128 28h12v12h-12zM104 52h12v12h-12zM128 52h12v12h-12zM92 92h12v12H92zM116 92h12v12h-12zM140 92h12v12h-12zM92 116h12v12H92zM140 116h12v12h-12zM92 140h12v12H92zM116 140h12v12h-12zM164 104h12v12h-12zM188 104h12v12h-12zM164 128h12v12h-12zM188 128h12v12h-12zM104 164h12v12h-12zM128 164h12v12h-12zM152 164h12v12h-12zM128 188h12v12h-12zM152 188h12v12h-12zM176 188h12v12h-12z"></path>
                            </svg>
                        </div>
                        <p class="mt-4 text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Digital Business Card' : 'Kartu Bisnis Digital' }}</p>
                        <p class="mt-2 text-xs leading-6 text-slate-600">{{ $isEnglish ? 'Your QR and public listing are active on the directory.' : 'QR Code dan profil publik Anda aktif di direktori IMT-GT.' }}</p>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $isEnglish ? 'Public Status' : 'Status Publik' }}</p>
                            <p class="text-sm font-medium text-slate-900">{{ $profile->profile_completed_at ? ($isEnglish ? 'Completed' : 'Lengkap') : ($isEnglish ? 'Draft' : 'Belum Lengkap') }}</p>
                        </div>
                        @if ($profile->id)
                            <a href="{{ route('public.industries.show', $profile) }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-full bg-cyan-600 px-3.5 py-1.5 text-xs font-semibold text-white transition hover:bg-cyan-700">
                                <span>{{ $isEnglish ? 'View Public Page' : 'Lihat Halaman Publik' }}</span>
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @endif
                    </div>
                </aside>
            </section>

            {{-- SECTION 2: COMPANY DETAILS --}}
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Company Profile' : 'Profil Perusahaan' }}</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Company & Business Details' : 'Data & Identitas Bisnis' }}</h2>
                </div>

                <div class="grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
                    <div class="space-y-5">
                        <div class="grid gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    {{ $isEnglish ? 'Name of Company' : 'Nama Perusahaan' }}
                                    <span class="text-rose-500">*</span>
                                </label>
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
                                            <input name="company_name" value="{{ old('company_name', $profile->company_name) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Enter company name' : 'Masukkan nama perusahaan' }}" required>
                                            @error('company_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Year of Establishment' : 'Tahun Berdiri' }}</label>
                                <input name="year_of_establishment" type="number" value="{{ old('year_of_establishment', $profile->year_of_establishment) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Contoh: 2018">
                                @error('year_of_establishment')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Main Product' : 'Produk Utama' }}</label>
                                <input name="main_product" value="{{ old('main_product', $profile->main_product) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'e.g. Palm oil, Organic spices' : 'Contoh: Olahan Sawit, Rempah Organik' }}">
                                @error('main_product')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Company Description' : 'Deskripsi Perusahaan' }}</label>
                                <textarea name="company_description" rows="4" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Explain your business profile, values, and competitive advantage...' : 'Jelaskan profil perusahaan, keunggulan produk, dan jangkauan pasar...' }}">{{ old('company_description', $profile->company_description) }}</textarea>
                                @error('company_description')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Address' : 'Alamat Lengkap' }}</label>
                                <textarea name="address" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Jl. / Road name, number, building...' : 'Jalan, nomor gedung, kelurahan, kecamatan...' }}">{{ old('address', $profile->address) }}</textarea>
                                @error('address')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    {{ $isEnglish ? 'Country' : 'Negara' }}
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select id="country_id" name="country_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" required>
                                    <option value="">{{ $isEnglish ? '- Choose Country -' : '- Pilih Negara -' }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected((string) old('country_id', $profile->country_id ?: $user->country_id) === (string) $country->id)>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    {{ $isEnglish ? 'Province / State' : 'Provinsi / State' }}
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select id="region_id" name="region_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" required>
                                    <option value="">{{ $isEnglish ? '- Choose Province / State -' : '- Pilih Provinsi / State -' }}</option>
                                </select>
                                <input type="hidden" id="province" name="province" value="{{ old('province', $profile->province ?: $user->province) }}">
                                @error('region_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'City' : 'Kota / Kabupaten' }}</label>
                                <input name="city" value="{{ old('city', $profile->city) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'e.g. Pekanbaru' : 'Contoh: Pekanbaru' }}">
                                @error('city')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Zip Code' : 'Kode Pos' }}</label>
                                <input name="zip_code" value="{{ old('zip_code', $profile->zip_code) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="28282">
                                @error('zip_code')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Fax</label>
                                <input name="fax" value="{{ old('fax', $profile->fax) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                @error('fax')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
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
                                @error('incoterm')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Terms of Payment' : 'Terms of Payment' }}</label>
                                <input name="terms_of_payment" value="{{ old('terms_of_payment', $profile->terms_of_payment) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="LC, TT">
                                @error('terms_of_payment')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Number of Employees' : 'Jumlah Karyawan' }}</label>
                                <input name="employee_count" type="number" value="{{ old('employee_count', $profile->employee_count) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                @error('employee_count')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Website</label>
                                <input name="website" value="{{ old('website', $profile->website) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="https://perusahaan.example">
                                @error('website')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Business Email' : 'Email Bisnis' }}</label>
                                <input name="business_email" value="{{ old('business_email', $profile->business_email ?: $user->email) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="sales@perusahaan.example">
                                @error('business_email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Business Phone' : 'Telepon Bisnis' }}</label>
                                <input name="business_phone" value="{{ old('business_phone', $profile->business_phone) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="+62 21 0000 0000">
                                @error('business_phone')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
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
                                    <input name="type_of_business_detail" value="{{ old('type_of_business_detail', $profile->type_of_business_detail) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Detail / specifics (optional)' : 'Detail spesifik usaha (opsional)' }}">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">{{ $isEnglish ? 'Google Maps Link' : 'Link Google Maps' }}</label>
                                <input name="google_maps_link" value="{{ old('google_maps_link', $profile->google_maps_link) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="https://maps.google.com/?q=...">
                                @error('google_maps_link')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Longitude</label>
                                <input name="longitude" value="{{ old('longitude', $profile->longitude) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="101.4478">
                                @error('longitude')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Latitude</label>
                                <input name="latitude" value="{{ old('latitude', $profile->latitude) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="0.5071">
                                @error('latitude')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <div class="mx-auto flex h-64 w-full max-w-[18rem] items-center justify-center overflow-hidden rounded-[1.5rem] bg-white shadow-sm" id="logo-preview-container">
                                @if ($profile->logo_path)
                                    <img id="logo-preview" src="{{ asset('storage/'.$profile->logo_path) }}" alt="Company logo" class="h-full w-full object-contain p-2">
                                @else
                                    <img id="logo-preview" src="" alt="Company logo" class="hidden h-full w-full object-contain p-2">
                                    <div id="logo-placeholder" class="grid place-items-center">
                                        <svg viewBox="0 0 240 240" class="h-32 w-32 text-slate-600" fill="currentColor" aria-hidden="true">
                                            <circle cx="120" cy="78" r="40"></circle>
                                            <path d="M50 214c5-46 31-72 70-72s65 26 70 72H50Z"></path>
                                        </svg>
                                        <span class="mt-2 text-xs text-slate-500">{{ $isEnglish ? 'No logo uploaded' : 'Belum ada logo' }}</span>
                                    </div>
                                @endif
                            </div>
                            <p class="mt-5 text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Company Logo' : 'Logo Perusahaan' }}</p>
                            <label class="mt-4 inline-flex cursor-pointer rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow transition hover:bg-cyan-700">
                                {{ $isEnglish ? 'Choose New Logo' : 'Pilih Logo Baru' }}
                                <input type="file" id="logo-input" name="logo" class="hidden" accept="image/*">
                            </label>
                            <p class="mt-3 text-xs text-slate-500">{{ $isEnglish ? 'JPG, PNG, or WEBP (Max. 2MB).' : 'Format JPG, PNG, atau WEBP (Maks. 2MB).' }}</p>
                            @error('logo')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- SECTION 3: LEGAL DOCUMENTS --}}
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Company Documents' : 'Dokumen Legalitas' }}</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'NPWP & Business Identification (NIB)' : 'NPWP & Nomor Induk Berusaha (NIB)' }}</h2>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5">
                        <div class="mb-4 flex items-center justify-between">
                            <label class="text-sm font-semibold text-slate-900">1. NPWP (Nomor Pokok Wajib Pajak)</label>
                            @if ($profile->npwp_document_path)
                                <a href="{{ asset('storage/'.$profile->npwp_document_path) }}" target="_blank" class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800 transition hover:bg-emerald-200">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>{{ $isEnglish ? 'View File' : 'Lihat File' }}</span>
                                </a>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <input name="npwp_number" value="{{ old('npwp_number', $profile->npwp_number) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'NPWP Number (digits only)' : 'Nomor NPWP (angka saja)' }}">
                            @error('npwp_number')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror

                            <label class="block text-xs font-medium text-slate-600">{{ $isEnglish ? 'Upload NPWP Document (PDF, JPG, PNG)' : 'Unggah Dokumen NPWP (PDF, JPG, PNG)' }}</label>
                            <input type="file" name="npwp_document" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-50 file:px-4 file:py-1 file:text-xs file:font-semibold file:text-cyan-700 hover:file:bg-cyan-100">
                            @error('npwp_document')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5">
                        <div class="mb-4 flex items-center justify-between">
                            <label class="text-sm font-semibold text-slate-900">2. NIB (Nomor Induk Berusaha)</label>
                            @if ($profile->nib_document_path)
                                <a href="{{ asset('storage/'.$profile->nib_document_path) }}" target="_blank" class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800 transition hover:bg-emerald-200">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>{{ $isEnglish ? 'View File' : 'Lihat File' }}</span>
                                </a>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <input name="nib_number" value="{{ old('nib_number', $profile->nib_number) }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'NIB Number' : 'Nomor NIB' }}">
                            @error('nib_number')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror

                            <label class="block text-xs font-medium text-slate-600">{{ $isEnglish ? 'Upload NIB Document (PDF, JPG, PNG)' : 'Unggah Dokumen NIB (PDF, JPG, PNG)' }}</label>
                            <input type="file" name="nib_document" class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-50 file:px-4 file:py-1 file:text-xs file:font-semibold file:text-cyan-700 hover:file:bg-cyan-100">
                            @error('nib_document')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- SECTION 4: CONTACT PERSONS --}}
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] lg:p-8">
                <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">{{ $isEnglish ? 'Contact Persons' : 'Contact Person' }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Company Representatives & Trade Contacts' : 'Daftar Kontak Penanggung Jawab' }}</h2>
                    </div>
                    <button type="button" id="add-contact" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-slate-900 shadow transition hover:bg-emerald-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>{{ $isEnglish ? 'Add Contact' : 'Tambah Kontak' }}</span>
                    </button>
                </div>

                <div id="contact-list" class="space-y-4">
                    @foreach ($contacts as $index => $contact)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5" data-contact-row>
                            <div class="mb-3 flex items-center justify-between border-b border-slate-200/60 pb-2">
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500" data-contact-title>{{ $isEnglish ? 'Contact' : 'Kontak' }} #{{ $index + 1 }}</span>
                                <button type="button" class="btn-remove-contact inline-flex items-center gap-1 text-xs font-semibold text-rose-600 transition hover:text-rose-700" title="{{ $isEnglish ? 'Remove contact' : 'Hapus kontak' }}">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>{{ $isEnglish ? 'Delete' : 'Hapus' }}</span>
                                </button>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                <div>
                                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Name' : 'Nama Lengkap' }}</label>
                                    <input name="contacts[{{ $index }}][name]" value="{{ $contact['name'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Nama kontak">
                                </div>
                                <div>
                                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Position' : 'Jabatan / Posisi' }}</label>
                                    <input name="contacts[{{ $index }}][position]" value="{{ $contact['position'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Contoh: Manager Export">
                                </div>
                                <div>
                                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Phone / WhatsApp' : 'No. HP / WhatsApp' }}</label>
                                    <input name="contacts[{{ $index }}][phone]" value="{{ $contact['phone'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="+62 812 0000 0000">
                                </div>
                                <div>
                                    <label class="mb-2 block text-xs font-medium text-slate-700">Email</label>
                                    <input name="contacts[{{ $index }}][email]" value="{{ $contact['email'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="kontak@perusahaan.example">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- SUBMIT BAR --}}
            <div class="sticky bottom-6 z-20 flex flex-col gap-4 rounded-[2rem] border border-slate-200 bg-white/95 px-6 py-5 shadow-[0_20px_60px_rgba(15,23,42,0.14)] backdrop-blur sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-900">{{ $isEnglish ? 'Ready to save changes?' : 'Simpan semua perubahan profil & akun' }}</p>
                    <p class="text-xs text-slate-500">{{ $isEnglish ? 'Make sure all required fields marked with * are filled.' : 'Pastikan field wajib yang bertanda bintang (*) telah terisi.' }}</p>
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-cyan-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-cyan-500/25 transition hover:bg-cyan-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ $isEnglish ? 'Save All Changes' : 'Simpan Semua Perubahan' }}</span>
                </button>
            </div>
        </form>
    </div>

    {{-- TEMPLATE FOR NEW CONTACT --}}
    <template id="contact-template">
        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5" data-contact-row>
            <div class="mb-3 flex items-center justify-between border-b border-slate-200/60 pb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500" data-contact-title>{{ $isEnglish ? 'Contact' : 'Kontak' }}</span>
                <button type="button" class="btn-remove-contact inline-flex items-center gap-1 text-xs font-semibold text-rose-600 transition hover:text-rose-700" title="{{ $isEnglish ? 'Remove contact' : 'Hapus kontak' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>{{ $isEnglish ? 'Delete' : 'Hapus' }}</span>
                </button>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Name' : 'Nama Lengkap' }}</label>
                    <input data-field="name" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Nama kontak">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Position' : 'Jabatan / Posisi' }}</label>
                    <input data-field="position" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Contoh: Manager Export">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-medium text-slate-700">{{ $isEnglish ? 'Phone / WhatsApp' : 'No. HP / WhatsApp' }}</label>
                    <input data-field="phone" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="+62 812 0000 0000">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-medium text-slate-700">Email</label>
                    <input data-field="email" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="kontak@perusahaan.example">
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
            const logoInput = document.getElementById('logo-input');
            const logoPreview = document.getElementById('logo-preview');
            const logoPlaceholder = document.getElementById('logo-placeholder');

            const regionsByCountry = @json($regionsByCountry);
            const selectedRegion = @json((string) old('region_id', $profile->region_id ?: $user->region_id));

            // Re-index contacts
            const updateContactIndexes = () => {
                const rows = contactList.querySelectorAll('[data-contact-row]');
                rows.forEach((row, idx) => {
                    const title = row.querySelector('[data-contact-title]');
                    if (title) {
                        title.textContent = `{{ $isEnglish ? 'Contact' : 'Kontak' }} #${idx + 1}`;
                    }
                    row.querySelectorAll('input').forEach((input) => {
                        const match = input.name ? input.name.match(/contacts\[\d+\]\[(\w+)\]/) : null;
                        const fieldName = match ? match[1] : input.getAttribute('data-field');
                        if (fieldName) {
                            input.name = `contacts[${idx}][${fieldName}]`;
                        }
                    });
                });
            };

            // Add contact
            if (addContactButton && contactList && template) {
                addContactButton.addEventListener('click', () => {
                    const clone = template.content.cloneNode(true);
                    contactList.appendChild(clone);
                    updateContactIndexes();
                });
            }

            // Remove contact
            contactList?.addEventListener('click', (e) => {
                const removeBtn = e.target.closest('.btn-remove-contact');
                if (removeBtn) {
                    const row = removeBtn.closest('[data-contact-row]');
                    const totalRows = contactList.querySelectorAll('[data-contact-row]').length;
                    if (totalRows <= 1) {
                        // Clear inputs instead of deleting last remaining row
                        row.querySelectorAll('input').forEach(input => input.value = '');
                    } else {
                        row.remove();
                        updateContactIndexes();
                    }
                }
            });

            // Sync regions by country
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

            // Logo preview
            if (logoInput && logoPreview) {
                logoInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            logoPreview.src = e.target.result;
                            logoPreview.classList.remove('hidden');
                            if (logoPlaceholder) {
                                logoPlaceholder.classList.add('hidden');
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
