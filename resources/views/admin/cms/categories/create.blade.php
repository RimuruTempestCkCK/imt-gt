@extends('layouts.admin')

@section('heading', 'Tambah Kategori')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            @include('admin.cms.categories._form', ['buttonText' => 'Simpan Kategori'])
        </form>
    </section>
@endsection
