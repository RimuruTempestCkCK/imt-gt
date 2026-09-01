@extends('layouts.admin')

@section('heading', 'Berita')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola artikel, press release, dan berita terbaru untuk publik.</p>
        <a href="{{ route('admin.news.create') }}" class="imtgt-button imtgt-button-primary">Tambah Berita</a>
    </div>
    <section class="imtgt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tag</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($newsPosts as $newsPost)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $newsPost->title }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $newsPost->category?->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $newsPost->status }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $newsPost->tags->pluck('name')->join(', ') ?: '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.news.edit', $newsPost) }}" class="text-cyan-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $newsPost) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $newsPosts->links() }}</div>
    </section>
@endsection
