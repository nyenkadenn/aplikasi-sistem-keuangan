@extends('layouts.app')

@section('page_title', 'Laporan Rekapitulasi Kas Stasi')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <form action="{{ route('reports.index') }}" method="GET" class="flex flex-wrap items-end gap-4 text-xs">
            <div>
                <label class="block font-bold text-slate-700 mb-1">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <div>
                <label class="block font-bold text-slate-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-lg shadow">
                    <i class="fa-solid fa-filter mr-1"></i> Filter Data
                </button>
                <a href="{{ route('reports.print', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow flex items-center">
                    <i class="fa-solid fa-print mr-1"></i> Cetak / Ekspor PDF
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl">
            <span class="text-xs font-semibold text-emerald-700">Total Pemasukan Periode</span>
            <div class="text-lg font-bold text-emerald-800 mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="bg-rose-50 border border-rose-200 p-4 rounded-xl">
            <span class="text-xs font-semibold text-rose-700">Total Pengeluaran Periode</span>
            <div class="text-lg font-bold text-rose-800 mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl">
            <span class="text-xs font-semibold text-blue-700">Saldo Akhir Periode</span>
            <div class="text-lg font-bold text-blue-800 mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 uppercase border-b text-slate-500 font-bold">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-right">Pemasukan</th>
                        <th class="px-4 py-3 text-right">Pengeluaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $idx => $t)
                    <tr>
                        <td class="px-4 py-3 text-slate-400">{{ $idx + 1 }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-700">{{ $t->category->name }}</td>
                        <td class="px-4 py-3">{{ $t->description }}</td>
                        <td class="px-4 py-3 text-right font-medium text-emerald-600">
                            {{ $t->type === 'pemasukan' ? 'Rp ' . number_format($t->amount, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-right font-medium text-rose-600">
                            {{ $t->type === 'pengeluaran' ? 'Rp ' . number_format($t->amount, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-400">Tidak ada transaksi pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
