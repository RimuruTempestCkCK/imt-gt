@extends('layouts.admin')

@section('heading', 'Tambah Berita')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.news.store') }}">
            @csrf
            @include('admin.cms.news._form', ['buttonText' => 'Simpan Berita'])
        </form>
    </section>
@endsection
