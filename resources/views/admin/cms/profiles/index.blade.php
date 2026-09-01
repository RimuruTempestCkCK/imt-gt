@extends('layouts.admin')

@section('heading', 'Profil')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola section profil seperti sejarah, visi, misi, tujuan, dan jejaring.</p>
        <a href="{{ route('admin.profiles.create') }}" class="imtgt-button imtgt-button-primary">Tambah Section Profil</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach ($profileSections as $profileSection)
            <article class="imtgt-card p-5">
                <p class="text-xs uppercase tracking-[0.24em] text-cyan-200/72">{{ $profileSection->section_key }}</p>
                <p class="mt-2 text-xl font-semibold text-white">{{ $profileSection->title }}</p>
                <p class="mt-3 text-sm leading-7 text-slate-400">{{ \Illuminate\Support\Str::limit($profileSection->summary ?: $profileSection->body, 160) }}</p>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.profiles.edit', $profileSection) }}" class="text-cyan-300">Edit</a>
                    <form method="POST" action="{{ route('admin.profiles.destroy', $profileSection) }}">
                        @csrf @method('DELETE')
                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus section profil ini?')">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $profileSections->links() }}</div>
@endsection
