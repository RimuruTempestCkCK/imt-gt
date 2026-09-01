@php
    $isEnglish = app()->isLocale('en');
@endphp

@extends('layouts.public')

@section('title', $isEnglish ? 'Business Registration' : 'Registrasi Bisnis')

@section('content')
    <main class="mx-auto max-w-6xl px-6 py-12 lg:px-8">
        <div class="mb-8 max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-cyan-700">{{ $isEnglish ? 'Registration' : 'Registrasi' }}</p>
            <h1 class="mt-4 font-['Playfair_Display'] text-4xl text-slate-950">{{ $isEnglish ? 'Create Your Business Account' : 'Buat Akun Bisnis Anda' }}</h1>
            <p class="mt-4 text-base leading-8 text-slate-600">
                {{ $isEnglish ? 'This registration form is designed for supplier and buyer accounts. If you select Buyer, the company section will only require the company name.' : 'Form registrasi ini dirancang untuk akun supplier dan buyer. Jika Anda memilih Buyer, bagian perusahaan hanya akan meminta nama perusahaan saja.' }}
            </p>
        </div>

        @if (session('status'))
            <div class="mb-8 rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('registration.store') }}" method="POST" class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.08)]">
            @csrf

            <section class="border-b border-slate-200 px-6 py-8 lg:px-10">
                <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Account Information' : 'Informasi Akun' }}</h2>
                <div class="mt-8 space-y-6">
                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Account Type' : 'Tipe Akun' }}
                        </label>
                        <div class="flex flex-wrap gap-6">
                            <label class="inline-flex items-center gap-3 text-base text-slate-700">
                                <input type="radio" name="account_type" value="supplier" class="h-4 w-4 border-slate-300 text-cyan-600 focus:ring-cyan-500" {{ old('account_type', 'supplier') === 'supplier' ? 'checked' : '' }}>
                                <span>{{ $isEnglish ? 'Supplier' : 'Supplier' }}</span>
                            </label>
                            <label class="inline-flex items-center gap-3 text-base text-slate-700">
                                <input type="radio" name="account_type" value="buyer" class="h-4 w-4 border-slate-300 text-cyan-600 focus:ring-cyan-500" {{ old('account_type') === 'buyer' ? 'checked' : '' }}>
                                <span>{{ $isEnglish ? 'Buyer' : 'Buyer' }}</span>
                            </label>
                        </div>
                    </div>
                    @error('account_type')<p class="lg:ml-[240px] text-sm text-rose-600">{{ $message }}</p>@enderror

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label for="country_id" class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Country' : 'Negara' }}
                        </label>
                        <div>
                            <select id="country_id" name="country_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? '- Choose Country -' : '- Pilih Negara -' }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected((string) old('country_id') === (string) $country->id)>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label for="region_id" class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Province / State' : 'Provinsi / State' }}
                        </label>
                        <div>
                            <select id="region_id" name="region_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                <option value="">{{ $isEnglish ? '- Choose Province / State -' : '- Pilih Provinsi / State -' }}</option>
                            </select>
                            @error('region_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label for="email" class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>Email
                        </label>
                        <div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            @error('email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr]">
                        <label for="password" class="pt-3 text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Password' : 'Password' }}
                        </label>
                        <div>
                            <input id="password" name="password" type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            <label class="mt-3 inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" data-toggle-password="password" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                                <span>{{ $isEnglish ? 'Show Password' : 'Tampilkan Password' }}</span>
                            </label>
                            @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr]">
                        <label for="password_confirmation" class="pt-3 text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Re-Password' : 'Ulangi Password' }}
                        </label>
                        <div>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            <label class="mt-3 inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" data-toggle-password="password_confirmation" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                                <span>{{ $isEnglish ? 'Show Password' : 'Tampilkan Password' }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-6 py-8 lg:px-10">
                <h2 class="text-2xl font-semibold text-slate-950">{{ $isEnglish ? 'Business Information' : 'Informasi Bisnis' }}</h2>
                <div class="mt-8 space-y-6">
                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-start">
                        <label class="pt-3 text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Company' : 'Perusahaan' }}
                        </label>
                        <div class="grid gap-3 md:grid-cols-[140px_1fr]" data-company-wrapper>
                            <div data-company-type-wrapper>
                                <select name="company_type" id="company_type" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                                    <option value="">{{ $isEnglish ? '-' : '-' }}</option>
                                    @foreach ($companyTypes as $companyType)
                                        <option value="{{ $companyType }}" @selected(old('company_type') === $companyType)>{{ $companyType }}</option>
                                    @endforeach
                                </select>
                                @error('company_type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-1" data-company-name-wrapper>
                                <input id="company_name" name="company_name" type="text" value="{{ old('company_name') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100" placeholder="{{ $isEnglish ? 'Enter company name' : 'Masukkan nama perusahaan' }}">
                                @error('company_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label for="pic_name" class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'PIC (Name)' : 'PIC (Nama)' }}
                        </label>
                        <div>
                            <input id="pic_name" name="pic_name" type="text" value="{{ old('pic_name') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            @error('pic_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-3 lg:grid-cols-[240px_1fr] lg:items-center">
                        <label for="phone" class="text-base font-medium text-slate-800">
                            <span class="mr-1 text-rose-500">*</span>{{ $isEnglish ? 'Phone / Mobile' : 'Telepon / Mobile' }}
                        </label>
                        <div>
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                            @error('phone')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            <div class="border-t border-slate-200 bg-slate-50 px-6 py-6 lg:px-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">
                        {{ $isEnglish ? 'By submitting this form, you agree that your business data will be reviewed by the Indonesia IMT-GT team.' : 'Dengan mengirim form ini, Anda setuju bahwa data bisnis Anda akan ditinjau oleh tim Indonesia IMT-GT.' }}
                    </p>
                    <button type="submit" class="rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-200 transition hover:bg-cyan-700">
                        {{ $isEnglish ? 'Submit Registration' : 'Kirim Registrasi' }}
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const accountTypeInputs = document.querySelectorAll('input[name="account_type"]');
            const companyTypeWrapper = document.querySelector('[data-company-type-wrapper]');
            const companyTypeSelect = document.getElementById('company_type');
            const companyWrapper = document.querySelector('[data-company-wrapper]');
            const countrySelect = document.getElementById('country_id');
            const regionSelect = document.getElementById('region_id');
            const regionsByCountry = @json($regionsByCountry);
            const selectedRegion = @json((string) old('region_id'));

            const syncCompanyFields = () => {
                const selected = document.querySelector('input[name="account_type"]:checked')?.value;
                const isBuyer = selected === 'buyer';

                if (companyTypeWrapper && companyTypeSelect && companyWrapper) {
                    companyTypeWrapper.classList.toggle('hidden', isBuyer);
                    companyWrapper.classList.toggle('md:grid-cols-[140px_1fr]', !isBuyer);
                    companyWrapper.classList.toggle('md:grid-cols-1', isBuyer);

                    if (isBuyer) {
                        companyTypeSelect.value = '';
                    }
                }
            };

            const syncRegions = () => {
                if (!countrySelect || !regionSelect) {
                    return;
                }

                const countryId = countrySelect.value;
                const regions = regionsByCountry[countryId] ?? [];
                const placeholder = @json($isEnglish ? '- Choose Province / State -' : '- Pilih Provinsi / State -');

                regionSelect.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = placeholder;
                regionSelect.appendChild(defaultOption);

                regions.forEach((region) => {
                    const option = document.createElement('option');
                    option.value = String(region.id);
                    option.textContent = region.name;

                    if (String(region.id) === selectedRegion) {
                        option.selected = true;
                    }

                    regionSelect.appendChild(option);
                });
            };

            accountTypeInputs.forEach((input) => input.addEventListener('change', syncCompanyFields));
            syncCompanyFields();
            countrySelect?.addEventListener('change', () => {
                syncRegions();

                if (regionSelect) {
                    regionSelect.value = '';
                }
            });
            syncRegions();

            document.querySelectorAll('[data-toggle-password]').forEach((checkbox) => {
                checkbox.addEventListener('change', (event) => {
                    const target = document.getElementById(event.currentTarget.getAttribute('data-toggle-password'));

                    if (target) {
                        target.type = event.currentTarget.checked ? 'text' : 'password';
                    }
                });
            });
        });
    </script>
@endsection
