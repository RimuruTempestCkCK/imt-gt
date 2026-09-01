@extends('layouts.admin')

@section('heading', 'Edit Media')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.media.update', $mediaItem) }}">
            @csrf @method('PUT')
            @include('admin.cms.media._form', ['buttonText' => 'Perbarui Media'])
        </form>
    </section>
@endsection
