@extends('layouts.admin')

@section('heading', 'Tambah Media')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.media.store') }}">
            @csrf
            @include('admin.cms.media._form', ['buttonText' => 'Simpan Media'])
        </form>
    </section>
@endsection
