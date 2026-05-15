<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Sahabat Laut</title>
    <link href="https://rsms.me/inter/inter.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #0f172a;
            color: #e2e8f0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 border-r border-slate-800 fixed h-screen overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-800">
                <h1 class="text-2xl font-bold text-white">Sahabat Laut</h1>
                <p class="text-xs text-slate-400 mt-1">Admin Panel</p>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg @if(Route::currentRouteName() === 'admin.dashboard') bg-blue-600 text-white @else text-slate-300 hover:bg-slate-800 @endif transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg @if(str_contains(Route::currentRouteName(), 'admin.users')) bg-blue-600 text-white @else text-slate-300 hover:bg-slate-800 @endif transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M15 19H9a6 6 0 016-6h0a6 6 0 016 6v1H9v-1a4 4 0 00-8 0v1H0" />
                    </svg>
                    <span>Manajemen User</span>
                </a>

                <a href="{{ route('landing') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-800 opacity-50 cursor-not-allowed transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v4m2 0h-4m0 0l2-2m-2 2l-2-2" />
                    </svg>
                    <span>Manajemen Berita</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-800 bg-slate-900">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div class="text-sm">
                            <p class="font-medium">{{ Auth::user()->first_name }}</p>
                            <p class="text-xs text-slate-400">Admin</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm px-3 py-2 text-red-400 hover:bg-red-900/20 rounded transition-colors">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Top Bar -->
            <div class="bg-slate-900 border-b border-slate-800 sticky top-0 z-10">
                <div class="flex justify-between items-center px-8 py-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white">@yield('page_title', 'Admin')</h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-sm text-slate-400">
                            <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </div>
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
