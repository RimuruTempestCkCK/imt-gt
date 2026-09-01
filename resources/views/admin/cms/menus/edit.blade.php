@extends('layouts.admin')

@section('heading', 'Edit Menu')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.menus.update', $menuItem) }}">
            @csrf @method('PUT')
            @include('admin.cms.menus._form', ['buttonText' => 'Perbarui Menu'])
        </form>
    </section>
@endsection
