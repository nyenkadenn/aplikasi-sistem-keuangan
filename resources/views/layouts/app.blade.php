<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI Keuangan Gereja St. Martinus Selorejo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 font-sans text-slate-800">
    <div class="flex flex-col md:flex-row h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-slate-200 flex flex-col justify-between shadow-xl flex-shrink-0">
            <div>
                <div class="p-4 sm:p-5 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-white text-lg">
                            <i class="fa-solid fa-church"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-sm tracking-wide text-white">St. Martinus</h1>
                            <p class="text-xs text-slate-400">Selorejo - SI Kas</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="md:hidden">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-400">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>

                <nav class="mt-2 sm:mt-4 px-3 space-y-1 flex md:block overflow-x-auto pb-2 md:pb-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-gauge w-5 mr-1.5 sm:mr-2"></i> Dashboard
                    </a>

                    @if(in_array(auth()->user()->role, ['admin', 'bendahara']))
                    <a href="{{ route('transactions.index', 'pemasukan') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->is('transaksi/pemasukan*') ? 'bg-emerald-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-circle-arrow-down w-5 mr-1.5 sm:mr-2"></i> Pemasukan
                    </a>
                    <a href="{{ route('transactions.index', 'pengeluaran') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->is('transaksi/pengeluaran*') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-circle-arrow-up w-5 mr-1.5 sm:mr-2"></i> Pengeluaran
                    </a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                    <div class="hidden md:block pt-3 pb-1 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Master Data</div>
                    <a href="{{ route('kategori.index') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->routeIs('kategori.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-tags w-5 mr-1.5 sm:mr-2"></i> Kategori
                    </a>
                    <a href="{{ route('anggaran.index') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->routeIs('anggaran.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-chart-pie w-5 mr-1.5 sm:mr-2"></i> Anggaran
                    </a>
                    <a href="{{ route('pengguna.index') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->routeIs('pengguna.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-users-gear w-5 mr-1.5 sm:mr-2"></i> Pengguna
                    </a>
                    @endif

                    <div class="hidden md:block pt-3 pb-1 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Laporan</div>
                    <a href="{{ route('reports.index') }}" class="flex items-center px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-lg hover:bg-slate-800 whitespace-nowrap {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-5 mr-1.5 sm:mr-2"></i> Laporan Kas
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-800 hidden md:block">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-white">{{ auth()->user()->name }}</div>
                        <span class="inline-block px-2 py-0.5 mt-0.5 text-[10px] font-bold rounded bg-slate-800 text-amber-400 uppercase tracking-wide">
                            {{ auth()->user()->role }}
                        </span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white border-b border-slate-200 px-4 sm:px-6 py-3.5 flex items-center justify-between sticky top-0 z-10">
                <h2 class="text-base sm:text-xl font-bold text-slate-800">@yield('page_title', 'Dashboard')</h2>
                <div class="text-xs sm:text-sm text-slate-500">
                    <i class="fa-regular fa-calendar mr-1"></i> {{ now()->translatedFormat('d M Y') }}
                </div>
            </header>

            <main class="p-4 sm:p-6">
                @if(session('success'))
                <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 p-3 sm:p-4 rounded-r-lg text-emerald-800 text-xs sm:text-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-check text-emerald-500 mr-2 text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">&times;</button>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 bg-rose-50 border-l-4 border-rose-500 p-3 sm:p-4 rounded-r-lg text-rose-800 text-xs sm:text-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-xmark text-rose-500 mr-2 text-lg"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900">&times;</button>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
