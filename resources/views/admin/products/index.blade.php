@extends('layouts.admin')

@section('heading', 'Manajemen Produk')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4 flex justify-between items-center">
            <p class="text-sm text-slate-300">Daftar produk yang terdaftar di sistem.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama Produk</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Perusahaan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-6 py-4 text-white font-medium">{{ $product->title }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ optional($product->category)->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ optional($product->companyProfile)->company_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-300">
                                <span class="px-2 py-1 rounded text-xs {{ $product->status === 'published' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 ml-3">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-slate-400">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $products->links() }}
        </div>
    </section>
@endsection
