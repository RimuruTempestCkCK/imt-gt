@extends('layouts.admin')

@section('heading', 'Edit Tag')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.tags.update', $tag) }}">
            @csrf @method('PUT')
            @include('admin.cms.tags._form', ['buttonText' => 'Perbarui Tag'])
        </form>
    </section>
@endsection
