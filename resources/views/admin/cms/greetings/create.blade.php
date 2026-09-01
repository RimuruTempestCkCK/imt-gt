@extends('layouts.admin')

@section('heading', 'Tambah Sambutan')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.greetings.store') }}">
            @csrf
            @include('admin.cms.greetings._form', ['buttonText' => 'Simpan Sambutan'])
        </form>
    </section>
@endsection
