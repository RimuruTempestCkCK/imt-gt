@extends('layouts.admin')

@section('heading', 'Kategori Produk')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="text-sm text-slate-300">Kelola kategori produk untuk flow member menambahkan produk.</p>
        </div>
        <a href="{{ route('admin.product-categories.create') }}" class="imtgt-button imtgt-button-primary">Tambah Kategori Produk</a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/40">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-white/5 text-slate-300">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 text-white">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-slate-300">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-slate-300">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.product-categories.edit', $category) }}" class="text-cyan-300">Edit</a>
                                <form method="POST" action="{{ route('admin.product-categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-rose-600" type="submit" onclick="return confirm('Hapus kategori produk ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endsection
