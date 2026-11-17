@extends('layouts.app')

@section('page_title', 'Kelola ' . ucfirst($type))

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm mb-4 border-b pb-2 flex items-center">
            <i class="fa-solid fa-plus-circle text-blue-600 mr-2"></i> Tambah {{ ucfirst($type) }} Baru
        </h3>

        <form action="{{ route('transactions.store', $type) }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Kategori</label>
                <select name="category_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Nominal (Rp)</label>
                <input type="number" name="amount" min="100" required placeholder="Contoh: 250000"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Keterangan Transaksi</label>
                <textarea name="description" rows="3" required placeholder="Catatan atau uraian rincian..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg mt-2 shadow transition">
                Simpan {{ ucfirst($type) }}
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-sm">Daftar Rekam {{ ucfirst($type) }}</h4>
            <span class="text-xs text-slate-400">Total: {{ $transactions->total() }} Data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-right">Nominal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-700">{{ $trx->category->name }}</td>
                        <td class="px-4 py-3">{{ $trx->description }}</td>
                        <td class="px-4 py-3 text-right font-bold whitespace-nowrap {{ $trx->type === 'pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800" title="Hapus Transaksi">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-400">Tidak ada data transaksi ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-t">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
