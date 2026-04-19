<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sahabat Laut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white overflow-hidden min-h-screen">

    <div class="flex min-h-screen w-full">
        
        <div class="hidden lg:block lg:w-[60%] relative bg-slate-100">
            <img 
                src="{{ asset('storage/images/login.png') }}" 
                alt="Login Background" 
                class="absolute inset-0 w-full h-full object-cover"
            >
        </div>

        <div class="w-full lg:w-[40%] flex flex-col p-8 md:p-12 lg:p-16 bg-white shadow-2xl z-10">
            
            <div class="flex flex-col gap-8 w-full max-w-md mx-auto my-auto">
                
                <div class="flex items-center gap-3 h-12">
                    <img src="{{ asset('storage/images/logo.png') }}" class="w-10 h-10 object-contain" alt="Logo">
                    <span class="font-bold text-black text-xl tracking-tight">Sahabat Laut</span>
                </div>

                <div>
                    <h1 class="text-4xl font-bold text-gray-900 leading-tight">Sign In</h1>
                    <p class="text-base text-gray-500 mt-2 opacity-75">Selamat datang kembali! Silakan masuk ke akun Anda.</p>

                    @if(session('success'))
                        <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm font-medium animate-pulse">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </div>

                <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-6 w-full">
                    @csrf
                    
                    <div class="relative h-14 bg-white rounded-lg border border-[#79747e] px-4 flex items-center">
                        <label class="absolute -top-2.5 left-3 bg-white px-1 text-xs font-medium text-[#1c1b1f]">Email address</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            placeholder="nama@email.com"
                            class="w-full bg-transparent outline-none text-base text-[#1c1b1f] pt-1 placeholder:text-gray-300"
                        >
                    </div>

                    <div class="relative h-14 bg-white rounded-lg border border-[#79747e] px-4 flex items-center" x-data="{ show: false }">
                        <label class="absolute -top-2.5 left-3 bg-white px-1 text-xs font-medium text-[#1c1b1f]">Password</label>
                        <input 
                            :type="show ? 'text' : 'password'" 
                            name="password" 
                            required 
                            placeholder="Masukkan password"
                            class="w-full bg-transparent outline-none text-base text-[#1c1b1f] pt-1 placeholder:text-gray-300"
                        >
                        <button type="button" @click="show = !show" class="ml-2 text-gray-400 hover:text-blue-500 focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>

                    <div class="pt-2 flex flex-col gap-4">
                        <button 
                            type="submit" 
                            class="w-full h-12 bg-[#007aff] hover:bg-[#0062cc] text-white font-bold rounded-lg shadow-lg shadow-blue-100 transition-all active:scale-[0.98]"
                        >
                            Masuk Sekarang
                        </button>
                        
                        <p class="text-sm text-center">
                            <span class="font-medium text-[#303030]">Belum punya akun? </span>
                            <a href="{{ route('register.view') }}" class="font-bold text-[#ff8682] hover:text-red-500 transition-colors">Daftar Sekarang</a>
                        </p>
                    </div>
                </form>
            </div>
            
            <div class="text-center text-xs text-gray-400 mt-auto pt-8">
                © 2026 Sahabat Laut. All rights reserved.
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>