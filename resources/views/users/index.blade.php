@extends('layouts.app')

@section('page_title', 'Kelola Pengguna Sistem')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm mb-4 border-b pb-2 flex items-center">
            <i class="fa-solid fa-user-plus text-blue-600 mr-2"></i> Daftarkan Pengguna
        </h3>
        <form action="{{ route('pengguna.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama lengkap petugas..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Username</label>
                <input type="text" name="username" required placeholder="Username unik..."
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@gereja.org"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" minlength="6" required placeholder="Minimal 6 karakter"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Peran Akun (Role)</label>
                <select name="role" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    <option value="bendahara">Bendahara Stasi</option>
                    <option value="ketua_stasi">Ketua Stasi</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow">
                Daftarkan User
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b flex items-center justify-between">
            <h4 class="font-bold text-slate-800 text-sm">Daftar Akun Pengguna</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 uppercase border-b text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Peran</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $u)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $u->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $u->username }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($u->role === 'bendahara' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($u->id !== auth()->id())
                            <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            @else
                            <span class="text-slate-400 italic">Akun Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 border-t">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
