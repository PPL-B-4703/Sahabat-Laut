<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakar Dashboard - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex items-center justify-center font-[Poppins]">
    <div class="text-center p-10 border border-gray-100 rounded-4xl shadow-sm max-w-lg w-full">
        <div class="mb-6 inline-flex p-4 bg-teal-50 rounded-2xl text-teal-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pakar Dashboard</h1>
        <p class="text-gray-500 mb-8 uppercase tracking-widest text-xs font-bold">Path: /pakar/dashboard</p>
        
        <div class="bg-teal-50 p-4 rounded-2xl mb-8">
            <p class="text-teal-700">Selamat datang Ahli, <strong>{{ Auth::user()->first_name }}</strong></p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl transition-all">
                Logout
            </button>
        </form>
    </div>
</body>
</html>