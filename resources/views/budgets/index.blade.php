@extends('layouts.app')

@section('page_title', 'Rencana Anggaran Biaya (RAB)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm mb-4 border-b pb-2 flex items-center">
            <i class="fa-solid fa-chart-pie text-blue-600 mr-2"></i> Buat Alokasi Anggaran
        </h3>
        <form action="{{ route('anggaran.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Tahun Anggaran</label>
                <input type="number" name="year" value="{{ date('Y') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Pos Kategori Pengeluaran</label>
                <select name="category_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    <option value="">-- Pilih Pos Pengeluaran --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Pagu Anggaran (Rp)</label>
                <input type="number" name="allocated_amount" min="0" required placeholder="Contoh: 5000000"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Catatan</label>
                <textarea name="notes" rows="2" placeholder="Catatan anggaran operasional..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow">
                Simpan Anggaran
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-sm">Alokasi Anggaran (RAB) Tahunan</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 uppercase border-b text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Tahun</th>
                        <th class="px-4 py-3">Pos Kategori</th>
                        <th class="px-4 py-3 text-right">Pagu Anggaran</th>
                        <th class="px-4 py-3">Catatan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($budgets as $b)
                    <tr>
                        <td class="px-4 py-3 font-bold text-slate-800">{{ $b->year }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-700">{{ $b->category->name }}</td>
                        <td class="px-4 py-3 text-right font-bold text-blue-700">Rp {{ number_format($b->allocated_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $b->notes ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('anggaran.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus alokasi anggaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 border-t">
            {{ $budgets->links() }}
        </div>
    </div>
</div>
@endsection
