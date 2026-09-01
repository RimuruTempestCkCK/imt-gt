@extends('layouts.admin')

@section('heading', 'Pendaftaran Perusahaan')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <p class="text-sm text-slate-300">Daftar pendaftaran perusahaan yang perlu diverifikasi.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Nama Perusahaan</th>
                        <th class="px-6 py-4">Nama PIC</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($registrations as $reg)
                        <tr>
                            <td class="px-6 py-4 text-white font-medium">{{ $reg->company_name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $reg->pic_name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $reg->email }}</td>
                            <td class="px-6 py-4 text-slate-300">
                                @if($reg->status === 'pending')
                                    <span class="px-2 py-1 rounded text-xs bg-yellow-500/20 text-yellow-400">Pending</span>
                                @elseif($reg->status === 'approved')
                                    <span class="px-2 py-1 rounded text-xs bg-green-500/20 text-green-400">Approved</span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs bg-red-500/20 text-red-400">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $reg->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.business-registrations.show', $reg) }}" class="text-blue-400 hover:text-blue-300">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-slate-400">Belum ada pendaftaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $registrations->links() }}
        </div>
    </section>
@endsection
