@extends('layouts.admin')

@section('heading', 'Sambutan')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-300">Kelola sambutan singkat yang tampil di beranda publik.</p>
        <a href="{{ route('admin.greetings.create') }}" class="imtgt-button imtgt-button-primary">Tambah Sambutan</a>
    </div>
    <div class="grid gap-5">
        @foreach ($greetings as $greeting)
            <article class="imtgt-card p-6">
                <p class="text-lg font-semibold text-white">{{ $greeting->headline }}</p>
                <p class="mt-2 text-sm text-slate-300">{{ $greeting->name }} • {{ $greeting->position }}</p>
                <p class="mt-4 text-sm leading-7 text-slate-400">{{ \Illuminate\Support\Str::limit($greeting->message, 180) }}</p>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.greetings.edit', $greeting) }}" class="text-cyan-300">Edit</a>
                    <form method="POST" action="{{ route('admin.greetings.destroy', $greeting) }}">
                        @csrf @method('DELETE')
                        <button class="text-rose-600" type="submit" onclick="return confirm('Hapus sambutan ini?')">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $greetings->links() }}</div>
@endsection
