@extends('layouts.admin')

@section('heading', 'Edit Halaman Statis')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf @method('PUT')
            @include('admin.cms.pages._form', ['buttonText' => 'Perbarui Halaman'])
        </form>
    </section>
@endsection
