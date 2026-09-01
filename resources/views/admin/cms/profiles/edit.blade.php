@extends('layouts.admin')

@section('heading', 'Edit Section Profil')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.profiles.update', $profileSection) }}">
            @csrf @method('PUT')
            @include('admin.cms.profiles._form', ['buttonText' => 'Perbarui Section Profil'])
        </form>
    </section>
@endsection
