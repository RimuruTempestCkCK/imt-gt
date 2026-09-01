@extends('layouts.admin')

@section('heading', 'Tambah Halaman Statis')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.pages.store') }}">
            @csrf
            @include('admin.cms.pages._form', ['buttonText' => 'Simpan Halaman'])
        </form>
    </section>
@endsection
