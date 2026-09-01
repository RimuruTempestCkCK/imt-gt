@extends('layouts.admin')

@section('heading', 'Edit Berita')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.news.update', $newsPost) }}">
            @csrf @method('PUT')
            @include('admin.cms.news._form', ['buttonText' => 'Perbarui Berita'])
        </form>
    </section>
@endsection
