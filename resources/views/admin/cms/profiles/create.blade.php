@extends('layouts.admin')

@section('heading', 'Tambah Section Profil')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.profiles.store') }}">
            @csrf
            @include('admin.cms.profiles._form', ['buttonText' => 'Simpan Section Profil'])
        </form>
    </section>
@endsection
