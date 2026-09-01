@extends('layouts.admin')

@section('heading', 'Tambah Kategori Produk')

@section('content')
    <div class="max-w-3xl rounded-[2rem] border border-white/10 bg-slate-950/40 p-6">
        <form method="POST" action="{{ route('admin.product-categories.store') }}">
            @csrf
            @include('admin.commerce.product-categories._form', ['productCategory' => new \App\Models\ProductCategory(), 'buttonText' => 'Simpan Kategori Produk'])
        </form>
    </div>
@endsection
