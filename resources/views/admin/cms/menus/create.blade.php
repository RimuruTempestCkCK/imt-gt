@extends('layouts.admin')

@section('heading', 'Tambah Menu')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.menus.store') }}">
            @csrf
            @include('admin.cms.menus._form', ['buttonText' => 'Simpan Menu'])
        </form>
    </section>
@endsection
