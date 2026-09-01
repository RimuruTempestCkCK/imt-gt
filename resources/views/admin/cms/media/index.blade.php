@extends('layouts.admin')

@section('heading', 'Media Library')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Media library saat ini memakai source URL/path dummy agar CMS siap lebih dulu.</p>
        <a href="{{ route('admin.media.create') }}" class="imtgt-button imtgt-button-primary">Tambah Media</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($mediaItems as $mediaItem)
            <article class="imtgt-card p-5">
                <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                    <img src="{{ $mediaItem->source_url }}" alt="{{ $mediaItem->alt_text }}" class="h-44 w-full object-cover">
                </div>
                <p class="mt-4 text-lg font-semibold text-white">{{ $mediaItem->title }}</p>
                <p class="mt-2 text-sm text-slate-400">{{ $mediaItem->type }} • {{ $mediaItem->alt_text ?: 'Tanpa alt text' }}</p>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.media.edit', $mediaItem) }}" class="text-cyan-300">Edit</a>
                    <form method="POST" action="{{ route('admin.media.destroy', $mediaItem) }}">
                        @csrf @method('DELETE')
                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus media ini?')">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $mediaItems->links() }}</div>
@endsection
