@extends('layouts.admin')

@section('heading', 'Halaman Statis')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola halaman company profile dan informasi statis lainnya.</p>
        <a href="{{ route('admin.pages.create') }}" class="imtgt-button imtgt-button-primary">Tambah Halaman</a>
    </div>
    <section class="imtgt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($pages as $page)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $page->title }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $page->slug }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $page->status }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="text-cyan-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus halaman ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $pages->links() }}</div>
    </section>
@endsection
