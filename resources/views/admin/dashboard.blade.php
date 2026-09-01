@extends('layouts.admin')

@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $label => $value)
            <div class="imtgt-card p-6">
                <p class="text-xs uppercase tracking-[0.3em] text-cyan-200/70">{{ str($label)->headline() }}</p>
                <p class="mt-4 text-4xl font-bold text-white">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-8 xl:grid-cols-[0.95fr_1.05fr]">
        <section class="imtgt-card p-6">
            <p class="text-sm font-semibold text-white">Fondasi sistem yang sudah aktif</p>
            <ul class="mt-5 space-y-3 text-sm leading-7 text-slate-300">
                <li>Authentication berbasis session untuk admin.</li>
                <li>Role dan permission native tanpa package eksternal.</li>
                <li>Policy untuk user, settings, role, dan audit log.</li>
                <li>Public layout dan admin layout terpisah.</li>
                <li>Setting tersimpan di database dan dishare ke view publik.</li>
                <li>Audit log untuk login, logout, dan perubahan setting.</li>
            </ul>
        </section>

        <section class="imtgt-card p-6">
            <p class="text-sm font-semibold text-white">Audit log terbaru</p>
            <div class="mt-5 space-y-3">
                @forelse ($recentLogs as $log)
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                        <p class="text-sm font-medium text-white">{{ $log->description }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $log->action }} • {{ optional($log->created_at)->format('d M Y H:i') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada aktivitas yang tercatat.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
