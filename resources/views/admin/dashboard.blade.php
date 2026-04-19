<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex items-center justify-center font-[Poppins]">
    <div class="text-center p-10 border border-gray-100 rounded-4xl shadow-sm max-w-lg w-full">
        <div class="mb-6 inline-flex p-4 bg-blue-50 rounded-2xl text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
        <p class="text-gray-500 mb-8 uppercase tracking-widest text-xs font-bold">Path: /admin/dashboard</p>
        
        <div class="bg-slate-50 p-4 rounded-2xl mb-8">
            <p class="text-slate-600">Selamat datang, <strong>{{ Auth::user()->first_name }}</strong></p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl transition-all shadow-lg shadow-red-100">
                Logout
            </button>
        </form>
    </div>
</body>
</html>