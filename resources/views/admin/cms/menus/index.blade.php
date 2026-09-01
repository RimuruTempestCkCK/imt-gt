@extends('layouts.admin')

@section('heading', 'Menu Navigasi')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola menu navigasi publik yang tampil di header.</p>
        <a href="{{ route('admin.menus.create') }}" class="imtgt-button imtgt-button-primary">Tambah Menu</a>
    </div>
    <section class="imtgt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">URL</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($menuItems as $menuItem)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $menuItem->title }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $menuItem->url }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $menuItem->location }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $menuItem->sort_order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.menus.edit', $menuItem) }}" class="text-cyan-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.menus.destroy', $menuItem) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $menuItems->links() }}</div>
    </section>
@endsection
