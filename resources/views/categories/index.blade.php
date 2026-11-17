@extends('layouts.app')

@section('page_title', 'Master Kategori Kas')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm mb-4 border-b pb-2 flex items-center">
            <i class="fa-solid fa-folder-plus text-blue-600 mr-2"></i> Tambah Kategori
        </h3>
        <form action="{{ route('kategori.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" required placeholder="Contoh: Kolekte I, Lilin Altar..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Jenis Kategori</label>
                <select name="type" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    <option value="pemasukan">Pemasukan (Kas Masuk)</option>
                    <option value="pengeluaran">Pengeluaran (Kas Keluar)</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="2" placeholder="Keterangan peruntukan kategori..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow">
                Simpan Kategori
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-sm">Daftar Kategori Kas Gereja</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 uppercase border-b text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($categories as $cat)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $cat->name }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $cat->type === 'pemasukan' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $cat->type }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $cat->description ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('kategori.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
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
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
