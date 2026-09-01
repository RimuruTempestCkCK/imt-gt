@extends('layouts.admin')

@section('heading', 'Edit Kategori')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            @include('admin.cms.categories._form', ['buttonText' => 'Perbarui Kategori'])
        </form>
    </section>
@endsection
