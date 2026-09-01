@extends('layouts.admin')

@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $label => $value)
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ str($label)->headline() }}</p>
                <p class="mt-4 text-4xl font-bold text-slate-900">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-8 xl:grid-cols-[0.95fr_1.05fr]">
        <section class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-900">Fondasi sistem yang sudah aktif</p>
            <ul class="mt-5 space-y-3 text-sm leading-7 text-slate-600">
                <li>Authentication berbasis session untuk admin.</li>
                <li>Role dan permission native tanpa package eksternal.</li>
                <li>Policy untuk user, settings, role, dan audit log.</li>
                <li>Public layout dan admin layout terpisah.</li>
                <li>Setting tersimpan di database dan dishare ke view publik.</li>
                <li>Audit log untuk login, logout, dan perubahan setting.</li>
            </ul>
        </section>

        <section class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-900">Audit log terbaru</p>
            <div class="mt-5 space-y-3">
                @forelse ($recentLogs as $log)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-sm font-medium text-slate-900">{{ $log->description }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $log->action }} • {{ optional($log->created_at)->format('d M Y H:i') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada aktivitas yang tercatat.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
