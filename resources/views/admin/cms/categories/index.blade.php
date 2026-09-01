@extends('layouts.admin')

@section('heading', 'Kategori Berita')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kategori untuk pengelompokan berita dan publikasi.</p>
        <a href="{{ route('admin.categories.create') }}" class="imtgt-button imtgt-button-primary">Tambah Kategori</a>
    </div>
    <section class="imtgt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ \Illuminate\Support\Str::limit($category->description, 70) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-cyan-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-300" type="submit" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $categories->links() }}</div>
    </section>
@endsection
