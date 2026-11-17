@extends('layouts.app')

@section('page_title', 'Dashboard Ringkasan Keuangan')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kas Masuk</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-emerald-600 mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                <span class="text-xs text-slate-500 mt-1 block">Bulan ini: Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kas Keluar</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-rose-600 mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                <span class="text-xs text-slate-500 mt-1 block">Bulan ini: Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-arrow-trend-down"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Saldo Bersih Saat Ini</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-blue-700 mt-1">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                <span class="text-xs text-slate-500 mt-1 block">Alokasi Anggaran: Rp {{ number_format($totalAnggaranTahunIni, 0, ',', '.') }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-vault"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-sm">Aktivitas Transaksi Kas Terbaru</h4>
            <a href="{{ route('reports.index') }}" class="text-xs text-blue-600 hover:underline font-semibold">Lihat Semua Laporan</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Tipe</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Keterangan</th>
                        <th class="px-5 py-3 text-right">Nominal</th>
                        <th class="px-5 py-3">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentTransactions as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3.5 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}</td>
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $item->type === 'pemasukan' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $item->type }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 font-medium text-slate-800">{{ $item->category->name }}</td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $item->description }}</td>
                        <td class="px-5 py-3.5 text-right font-bold whitespace-nowrap {{ $item->type === 'pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $item->type === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $item->user->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada catatan transaksi kas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
