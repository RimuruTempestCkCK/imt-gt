@extends('layouts.member')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-slate-900">
            {{ $isEnglish ? 'Welcome back,' : 'Selamat datang,' }} {{ auth()->user()->name }}!
        </h2>
        <p class="mt-2 text-sm text-slate-600">
            {{ $isEnglish ? 'Here is a quick overview of your business account.' : 'Berikut adalah ringkasan dari akun bisnis Anda.' }}
        </p>
    </div>

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($stats as $label => $value)
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $label }}</p>
                <p class="mt-4 text-4xl font-bold text-slate-900">{{ $value }}</p>
            </div>
        @endforeach
        
        <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $isEnglish ? 'Company Profile' : 'Profil Perusahaan' }}</p>
            <div class="mt-4 flex items-center gap-3">
                @if ($profile && $profile->profile_completed_at)
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="text-lg font-semibold text-slate-900">{{ $isEnglish ? 'Completed' : 'Lengkap' }}</span>
                @else
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </span>
                    <span class="text-lg font-semibold text-slate-900">{{ $isEnglish ? 'Incomplete' : 'Belum Lengkap' }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-8">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 md:p-10 shadow-sm">
            <h3 class="text-xl font-semibold text-slate-900">{{ $isEnglish ? 'Quick Actions' : 'Aksi Cepat' }}</h3>
            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ route('account.products.create') }}" class="rounded-full bg-cyan-700 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-700/20 transition hover:bg-cyan-800">
                    {{ $isEnglish ? 'Add New Product' : 'Tambah Produk Baru' }}
                </a>
                <a href="{{ route('account.company-profile.edit') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    {{ $isEnglish ? 'Update Company Profile' : 'Update Profil Perusahaan' }}
                </a>
                @if ($profile && $profile->id)
                    <a href="{{ route('public.industries.show', $profile) }}" target="_blank" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        {{ $isEnglish ? 'View Public Profile' : 'Lihat Profil Publik' }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
