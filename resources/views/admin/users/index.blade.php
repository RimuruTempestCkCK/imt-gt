@extends('layouts.admin')

@section('heading', 'Manajemen User')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <p class="text-sm text-slate-300">Daftar user yang sudah memiliki akses ke sistem.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Last Login</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $user->roles->pluck('name')->join(', ') ?: '-' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ optional($user->last_login_at)->format('d M Y H:i') ?: 'Belum ada' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $users->links() }}
        </div>
    </section>
@endsection
