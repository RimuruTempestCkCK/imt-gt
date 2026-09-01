@extends('layouts.admin')

@section('heading', 'Tambah Tag')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.tags.store') }}">
            @csrf
            @include('admin.cms.tags._form', ['buttonText' => 'Simpan Tag'])
        </form>
    </section>
@endsection
