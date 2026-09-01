@extends('layouts.admin')

@section('heading', 'Banner')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola slider atau banner utama pada beranda publik.</p>
        <a href="{{ route('admin.banners.create') }}" class="imtgt-button imtgt-button-primary">Tambah Banner</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($banners as $banner)
            <article class="imtgt-card p-5">
                @if ($banner->media)
                    <img src="{{ $banner->media->source_url }}" alt="{{ $banner->media->alt_text }}" class="h-44 w-full rounded-2xl object-cover">
                @endif
                <p class="mt-4 text-lg font-semibold text-white">{{ $banner->title }}</p>
                <p class="mt-2 text-sm text-slate-400">{{ $banner->subtitle }}</p>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="text-cyan-300">Edit</a>
                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}">
                        @csrf @method('DELETE')
                        <button class="text-rose-300" type="submit" onclick="return confirm('Hapus banner ini?')">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $banners->links() }}</div>
@endsection
