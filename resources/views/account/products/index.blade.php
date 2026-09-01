@php($isEnglish = app()->isLocale('en'))

@extends('layouts.member')

@section('title', $isEnglish ? 'My Products' : 'Produk Saya')
@section('heading', $isEnglish ? 'My Products' : 'Produk Saya')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-cyan-300/80">{{ $isEnglish ? 'Trading Catalog' : 'Katalog Perdagangan' }}</p>
                <h2 class="mt-2 text-3xl font-semibold text-white">{{ $isEnglish ? 'Manage Your Products' : 'Kelola Produk Anda' }}</h2>
                <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-300">{{ $isEnglish ? 'Create product listings for imported goods or services, keep them in draft, or publish them when ready.' : 'Buat listing produk untuk barang atau jasa yang diimport, simpan sebagai draft, atau publish saat sudah siap.' }}</p>
            </div>
            <a href="{{ route('account.products.create') }}" class="rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-300/20 transition hover:bg-cyan-700">
                {{ $isEnglish ? 'Add Product' : 'Tambah Produk' }}
            </a>
        </div>

        <div class="grid gap-5 sm:grid-cols-3">
            <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-5">
                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Total Products' : 'Total Produk' }}</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ $products->total() }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-5">
                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Draft</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ $products->where('status', 'draft')->count() }}</p>
            </div>
            <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-5">
                <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $isEnglish ? 'Published' : 'Published' }}</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ $products->where('status', 'published')->count() }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/40">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">{{ $isEnglish ? 'Product' : 'Produk' }}</th>
                        <th class="px-6 py-4">{{ $isEnglish ? 'Category' : 'Kategori' }}</th>
                        <th class="px-6 py-4">{{ $isEnglish ? 'Trade Type' : 'Jenis Perdagangan' }}</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">{{ $isEnglish ? 'Price Visibility' : 'Visibilitas Harga' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-white">{{ $product->title }}</p>
                                <p class="mt-1 text-xs text-slate-400">{{ $product->created_at?->format('d M Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-300">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $product->trade_kind === 'services' ? ($isEnglish ? 'Service Import' : 'Import Jasa') : ($isEnglish ? 'Goods Import' : 'Import Barang') }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ ucfirst($product->status) }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $product->show_price ? ($isEnglish ? 'Visible' : 'Ditampilkan') : ($isEnglish ? 'Hidden' : 'Disembunyikan') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400">{{ $isEnglish ? 'No products yet. Start by adding your first product.' : 'Belum ada produk. Mulai dengan menambahkan produk pertama Anda.' }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
