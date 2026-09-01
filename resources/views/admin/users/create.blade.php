@extends('layouts.admin')

@section('heading', 'Tambah User Baru')

@section('content')
    <section class="imtgt-card">
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full bg-slate-800 border-white/10 rounded-md text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full bg-slate-800 border-white/10 rounded-md text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">Password</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full bg-slate-800 border-white/10 rounded-md text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="mt-1 block w-full bg-slate-800 border-white/10 rounded-md text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Roles (Hak Akses)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($roles as $role)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                       class="rounded bg-slate-800 border-white/10 text-blue-500 focus:ring-blue-500"
                                       {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-slate-300">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('roles') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-white/10">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm text-slate-300 hover:text-white mr-4">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition-colors">
                    Simpan User
                </button>
            </div>
        </form>
    </section>
@endsection
