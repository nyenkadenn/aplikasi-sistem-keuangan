<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI Keuangan Gereja St. Martinus Selorejo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden p-6 sm:p-8">
        <div class="text-center mb-6">
            <div class="inline-flex w-16 h-16 rounded-full bg-blue-100 text-blue-700 items-center justify-center text-3xl mb-3 shadow-inner">
                <i class="fa-solid fa-cross"></i>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Gereja St. Martinus</h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Sistem Informasi Pengelolaan Keuangan Kas</p>
        </div>

        @if($errors->any())
        <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs p-3 rounded-lg flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-2 text-sm"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                        class="w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="admin / bendahara / ketua">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required
                        class="w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit"
                class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm shadow-md transition duration-150">
                <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk ke Sistem
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-500 leading-relaxed">
            Akun Bawaan:<br>
            <strong>admin</strong> / <strong>bendahara</strong> / <strong>ketua</strong><br>
            Password: <strong>password123</strong>
        </div>
    </div>
</body>
</html>
