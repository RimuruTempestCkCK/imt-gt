@extends('layouts.admin')

@section('heading', 'Edit Banner')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.banners.update', $banner) }}">
            @csrf @method('PUT')
            @include('admin.cms.banners._form', ['buttonText' => 'Perbarui Banner'])
        </form>
    </section>
@endsection
