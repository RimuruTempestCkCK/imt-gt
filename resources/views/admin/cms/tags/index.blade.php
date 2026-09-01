@extends('layouts.admin')

@section('heading', 'Tag Berita')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Tag dipakai untuk navigasi konten yang lebih fleksibel.</p>
        <a href="{{ route('admin.tags.create') }}" class="imtgt-button imtgt-button-primary">Tambah Tag</a>
    </div>
    <section class="imtgt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($tags as $tag)
                        <tr>
                            <td class="px-6 py-4 text-white">{{ $tag->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $tag->slug }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="text-cyan-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-300" type="submit" onclick="return confirm('Hapus tag ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $tags->links() }}</div>
    </section>
@endsection
