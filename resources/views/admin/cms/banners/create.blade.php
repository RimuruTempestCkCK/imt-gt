@extends('layouts.admin')

@section('heading', 'Tambah Banner')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.banners.store') }}">
            @csrf
            @include('admin.cms.banners._form', ['buttonText' => 'Simpan Banner'])
        </form>
    </section>
@endsection
