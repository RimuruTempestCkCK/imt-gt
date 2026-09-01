@extends('layouts.admin')

@section('heading', 'Detail Pendaftaran Perusahaan')

@section('content')
    <section class="imtgt-card overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-medium text-white">{{ $businessRegistration->company_name }}</h2>
            <div>
                @if($businessRegistration->status === 'pending')
                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-500/20 text-yellow-400 font-semibold border border-yellow-500/30">Pending</span>
                @elseif($businessRegistration->status === 'approved')
                    <span class="px-3 py-1 rounded-full text-sm bg-green-500/20 text-green-400 font-semibold border border-green-500/30">Approved</span>
                @else
                    <span class="px-3 py-1 rounded-full text-sm bg-red-500/20 text-red-400 font-semibold border border-red-500/30">Rejected</span>
                @endif
            </div>
        </div>

        <div class="px-6 py-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-slate-400 mb-1">Informasi Perusahaan</h3>
                    <div class="bg-white/5 p-4 rounded-lg space-y-3">
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Nama Perusahaan</p>
                            <p class="text-white">{{ $businessRegistration->company_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Provinsi/Negara</p>
                            <p class="text-white">{{ $businessRegistration->province }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Telepon Bisnis</p>
                            <p class="text-white">{{ $businessRegistration->phone }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-400 mb-1">Informasi PIC (Person in Charge)</h3>
                    <div class="bg-white/5 p-4 rounded-lg space-y-3">
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Nama PIC</p>
                            <p class="text-white">{{ $businessRegistration->pic_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Email Akun</p>
                            <p class="text-white">{{ $businessRegistration->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Tipe Akun</p>
                            <p class="text-white">{{ $businessRegistration->account_type }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($businessRegistration->status === 'pending')
        <div class="bg-slate-800/50 border-t border-white/10 px-6 py-4 flex justify-end space-x-3">
            <form action="{{ route('admin.business-registrations.reject', $businessRegistration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium transition-colors">Tolak Pendaftaran</button>
            </form>
            
            <form action="{{ route('admin.business-registrations.approve', $businessRegistration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pendaftaran ini? Akun dan Profil Perusahaan akan otomatis dibuat.')">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-medium transition-colors">Setujui & Buat Akun</button>
            </form>
        </div>
        @endif
    </section>

    <div class="mt-4">
        <a href="{{ route('admin.business-registrations.index') }}" class="text-sm text-slate-400 hover:text-white transition-colors">&larr; Kembali ke Daftar Pendaftaran</a>
    </div>
@endsection
