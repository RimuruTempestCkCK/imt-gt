@extends('layouts.admin')

@section('heading', 'Pengaturan Website')

@section('content')
    <section class="imtgt-card p-6 lg:p-8">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="grid gap-5 lg:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="lg:col-span-2">
                <p class="text-sm text-slate-300">Pengaturan ini dipakai sebagai fondasi layout publik dan metadata sistem.</p>
            </div>

            @foreach ([
                'app_name' => 'Nama aplikasi',
                'app_tagline' => 'Tagline',
                'app_email' => 'Email',
                'app_phone' => 'Telepon',
                'app_address' => 'Alamat',
                'app_locale' => 'Locale',
                'app_timezone' => 'Timezone',
                'hero_title' => 'Hero title',
                'hero_subtitle' => 'Hero subtitle',
            ] as $key => $label)
                <div class="{{ in_array($key, ['app_address', 'hero_title', 'hero_subtitle']) ? 'lg:col-span-2' : '' }}">
                    <label for="{{ $key }}" class="mb-2 block text-sm font-medium text-slate-200">{{ $label }}</label>
                    @if (in_array($key, ['app_address', 'hero_subtitle']))
                        <textarea id="{{ $key }}" name="{{ $key }}" rows="3" class="imtgt-input">{{ old($key, $settings[$key] ?? '') }}</textarea>
                    @else
                        <input id="{{ $key }}" name="{{ $key }}" type="text" value="{{ old($key, $settings[$key] ?? '') }}" class="imtgt-input">
                    @endif
                    @error($key)
                        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="lg:col-span-2">
                <button type="submit" class="imtgt-button imtgt-button-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </section>
@endsection
