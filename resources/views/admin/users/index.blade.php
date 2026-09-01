@extends('layouts.admin')

@section('heading', 'Manajemen User')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4 flex justify-between items-center">
            <p class="text-sm text-slate-300">Daftar user yang sudah memiliki akses ke sistem.</p>
            <a href="{{ route('admin.users.create') }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm transition-colors">
                + Tambah User
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Last Login</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-slate-300">
                                @if($user->roles->count() > 0)
                                    @foreach($user->roles as $role)
                                        <span class="inline-block px-2 py-1 text-xs rounded bg-white/10">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-slate-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ optional($user->last_login_at)->format('d M Y H:i') ?: 'Belum ada' }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                    </form>
                                @endif
                            </td>
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

