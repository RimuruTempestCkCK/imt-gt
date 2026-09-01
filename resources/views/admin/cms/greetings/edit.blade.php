@extends('layouts.admin')

@section('heading', 'Edit Sambutan')

@section('content')
    <section class="imtgt-card p-6">
        <form method="POST" action="{{ route('admin.greetings.update', $greeting) }}">
            @csrf @method('PUT')
            @include('admin.cms.greetings._form', ['buttonText' => 'Perbarui Sambutan'])
        </form>
    </section>
@endsection
