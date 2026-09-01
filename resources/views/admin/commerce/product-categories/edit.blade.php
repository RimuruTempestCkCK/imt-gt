@extends('layouts.admin')

@section('heading', 'Edit Kategori Produk')

@section('content')
    <div class="max-w-3xl rounded-[2rem] border border-white/10 bg-slate-950/40 p-6">
        <form method="POST" action="{{ route('admin.product-categories.update', $productCategory) }}">
            @csrf
            @method('PUT')
            @include('admin.commerce.product-categories._form', ['buttonText' => 'Perbarui Kategori Produk'])
        </form>
    </div>
@endsection
