@extends('layouts.admin')

@section('heading', 'Audit Log')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <p class="text-sm text-slate-300">Aktivitas sistem yang tercatat untuk kebutuhan audit dan troubleshooting.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Action</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">User</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($logs as $log)
                        <tr>
                            <td class="px-6 py-4 text-slate-400">{{ $log->created_at?->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-white">{{ $log->action }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $log->description }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $log->user?->email ?? 'System' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $logs->links() }}
        </div>
    </section>
@endsection
