@extends('layouts.admin')

@section('heading', 'Manajemen User')

@section('content')
    <section class="rounded-[1.75rem] border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5 flex justify-between items-center bg-white rounded-t-[2rem]">
            <p class="text-sm text-slate-600">Daftar user yang sudah memiliki akses ke sistem.</p>
            <button onclick="document.getElementById('modal-create').showModal()" class="px-4 py-2 bg-cyan-700 hover:bg-cyan-800 text-white font-medium rounded-xl text-sm transition shadow-sm">
                + Tambah User
            </button>
        </div>
        
        @if($errors->any())
            <div class="m-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600">
                Terjadi kesalahan input. Pastikan form diisi dengan benar.
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Nama</th>
                        <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Email</th>
                        <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Role</th>
                        <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Last Login</th>
                        <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->roles->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($user->roles as $role)
                                            <span class="inline-block px-2 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-md bg-cyan-50 text-cyan-700 border border-cyan-100">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ optional($user->last_login_at)->format('d M Y H:i') ?: 'Belum ada' }}</td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <button onclick="document.getElementById('modal-edit-{{ $user->id }}').showModal()" class="text-cyan-700 hover:text-cyan-800 font-medium">Edit</button>
                                
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-700 font-medium">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                        <!-- EDIT MODAL -->
                        <dialog id="modal-edit-{{ $user->id }}" class="w-full max-w-xl m-auto rounded-[2rem] border border-slate-100 p-0 shadow-2xl backdrop:bg-slate-900/40 backdrop:backdrop-blur-sm open:animate-in open:fade-in open:zoom-in-95">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="border-b border-slate-200 px-6 py-5 flex justify-between items-center bg-white rounded-t-[2rem]">
                                    <h3 class="text-lg font-semibold text-slate-900">Edit User</h3>
                                    <button type="button" onclick="document.getElementById('modal-edit-{{ $user->id }}').close()" class="text-slate-400 hover:text-slate-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                <div class="p-6 md:p-8 space-y-5 bg-white">
                                    <div>
                                        <label class="mb-1 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                                        <input name="name" value="{{ $user->name }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-medium text-slate-700">Password Baru (Opsional)</label>
                                        <input type="password" name="password" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900" placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Role Akses</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            @foreach($roles as $role)
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                                        class="rounded border-slate-300 text-cyan-600 shadow-sm focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                    <span class="text-sm text-slate-700">{{ $role->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="border-t border-slate-200 px-6 py-5 bg-slate-50/50 flex justify-end gap-3 rounded-b-[2rem]">
                                    <button type="button" onclick="document.getElementById('modal-edit-{{ $user->id }}').close()" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Batal</button>
                                    <button type="submit" class="imtgt-button imtgt-button-primary text-white bg-cyan-700 hover:bg-cyan-800">Simpan Perubahan</button>
                                </div>
                            </form>
                        </dialog>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $users->links() }}
        </div>
    </section>

    <!-- CREATE MODAL -->
    <dialog id="modal-create" class="w-full max-w-xl m-auto rounded-[2rem] border border-slate-100 p-0 shadow-2xl backdrop:bg-slate-900/40 backdrop:backdrop-blur-sm open:animate-in open:fade-in open:zoom-in-95" {{ $errors->any() ? 'open' : '' }}>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="border-b border-slate-200 px-6 py-5 flex justify-between items-center bg-white rounded-t-[2rem]">
                <h3 class="text-lg font-semibold text-slate-900">Tambah User Baru</h3>
                <button type="button" onclick="document.getElementById('modal-create').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 md:p-8 space-y-5 bg-white">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-rose-600">*</span></label>
                    <input name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Email <span class="text-rose-600">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Password <span class="text-rose-600">*</span></label>
                    <input type="password" name="password" required minlength="8" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Konfirmasi Password <span class="text-rose-600">*</span></label>
                    <input type="password" name="password_confirmation" required minlength="8" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition border-slate-200 text-slate-900">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Role Akses</label>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($roles as $role)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                    class="rounded border-slate-300 text-cyan-600 shadow-sm focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                    {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : '' }}>
                                <span class="text-sm text-slate-700">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-200 px-6 py-5 bg-slate-50/50 flex justify-end gap-3 rounded-b-[2rem]">
                <button type="button" onclick="document.getElementById('modal-create').close()" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">Batal</button>
                <button type="submit" class="imtgt-button imtgt-button-primary text-white bg-cyan-700 hover:bg-cyan-800">Simpan User</button>
            </div>
        </form>
    </dialog>
@endsection
