@extends('layouts.admin')

@section('heading', 'Role & Permission')

@section('content')
    <div class="grid gap-8 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="imtgt-card p-6">
            <p class="text-lg font-semibold text-white">Role Sistem</p>
            <div class="mt-5 space-y-4">
                @foreach ($roles as $role)
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <p class="font-semibold text-white">{{ $role->name }}</p>
                            <span class="rounded-full border border-cyan-300/20 px-3 py-1 text-xs uppercase tracking-[0.2em] text-cyan-200/75">{{ $role->code }}</span>
                        </div>
                        <p class="mt-3 text-sm text-slate-300">{{ $role->permissions->pluck('code')->join(', ') }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="imtgt-card p-6">
            <p class="text-lg font-semibold text-white">Permission Registry</p>
            <div class="mt-5 space-y-5">
                @foreach ($permissions as $group => $items)
                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-cyan-200/70">{{ $group }}</p>
                        <div class="mt-3 flex flex-wrap gap-3">
                            @foreach ($items as $permission)
                                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs text-slate-200">{{ $permission->code }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
