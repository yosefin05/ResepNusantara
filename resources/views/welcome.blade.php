<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Nusantara | Warisan Kuliner Indonesia</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f1e4;
        }
        .recipe-card:hover .recipe-title {
            color: #8B4513;
        }
    </style>
</head>

<body class="bg-[#f8f1e4] text-gray-900">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 border-b-2 border-[#8B4513]/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Enhanced Brand -->
            <a href="/" class="group flex items-center space-x-2">
                <span class="text-3xl font-bold text-[#8B4513] tracking-wider group-hover:text-[#A0522D] transition-all duration-300 transform group-hover:-translate-y-1 drop-shadow-sm">
                    Resep Nusantara
                </span>
                <span class="text-2xl animate-bounce">🍜</span>
            </a>
            
            <!-- Enhanced Navigation -->
            <div class="flex items-center space-x-2">
                @auth
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" 
                       class="group relative px-4 py-2 text-gray-700 hover:text-[#8B4513] transition-all duration-300 rounded-full hover:bg-[#8B4513]/10 font-medium">
                        <i class="fas fa-tachometer-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        Dashboard
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-[#8B4513] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>                    
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                        @csrf
                        <button type="submit" 
                                class="group relative px-4 py-2 text-gray-700 hover:text-white transition-all duration-300 rounded-full hover:bg-[#8B4513] font-medium border-2 border-[#8B4513]/20 hover:border-[#8B4513] transform hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-sign-out-alt mr-2 group-hover:scale-110 transition-transform"></i>
                            Logout
                        </button>
                    </form>
                    
                    <!-- Mobile Menu Button (for authenticated users) -->
                    <div class="md:hidden relative">
                        <button onclick="toggleMobileMenu()" 
                                class="p-2 text-[#8B4513] hover:bg-[#8B4513]/10 rounded-full transition-all duration-300">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-300">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login Link -->
                    <a href="{{ route('login') }}" 
                       class="group relative px-4 py-2 text-gray-700 hover:text-[#8B4513] transition-all duration-300 rounded-full hover:bg-[#8B4513]/10 font-medium hidden md:block">
                        <i class="fas fa-sign-in-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        Login
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-[#8B4513] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                    
                    <!-- Register Button -->
                    <a href="{{ route('register') }}" 
                       class="group relative bg-[#8B4513] text-white px-6 py-3 rounded-full shadow-lg hover:bg-[#A0522D] transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-semibold overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></span>
                        <i class="fas fa-user-plus mr-2"></i>
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center h-screen flex items-center justify-center text-center text-white" style="background-image: url('{{ asset('images/header.jpg') }}'); min-height: 500px;">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 px-6 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 tracking-wide leading-tight">Eksplorasi Kelezatan Kuliner Nusantara</h1>
            <p class="text-lg md:text-xl mb-8">Temukan dan pelajari resep warisan Indonesia yang autentik dari berbagai daerah</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-[#8B4513] text-white px-8 py-3 rounded-lg shadow-md text-lg hover:bg-[#A0522D] transition transform hover:scale-105">
                    Gabung Sekarang
                </a>
                <a href="#resep-pilihan" class="bg-white text-[#8B4513] px-8 py-3 rounded-lg shadow-md text-lg hover:bg-gray-100 transition transform hover:scale-105">
                    Lihat Resep
                </a>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10">
            <a href="#resep-pilihan" class="text-white animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </header>

    <!-- Resep Pilihan Section -->
    <section id="resep-pilihan" class="py-20 bg-[#f8f1e4]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#8B4513] mb-4">Resep Pilihan</h2>
                <div class="w-24 h-1 bg-[#8B4513] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-2xl mx-auto">Temukan resep-resep terbaik dari berbagai daerah di Indonesia</p>
            </div>

            @if($reseps->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500">Belum ada resep yang tersedia</p>
                </div>
            @else       
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($reseps as $resep)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Gambar dari database -->
                    @if($resep->gambar)
                    <img src="{{ $resep->gambar_url }}" alt="{{ $resep->judul }}"class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-[#8B4513]">{{ $resep->judul }}</h3>
                        <a href="{{ route('resep.show', $resep->id) }}" class="text-[#8B4513] font-medium mt-3 inline-block">
                            Lihat Resep →
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-[#8B4513] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Siap Memulai Petualangan Kuliner Anda?</h2>
            <p class="text-lg mb-8">Bergabunglah dengan komunitas kami dan temukan ribuan resep autentik dari seluruh Nusantara</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-[#8B4513] px-8 py-3 rounded-lg shadow-md text-lg font-semibold hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-white hover:text-[#8B4513] transition">
                    Masuk
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#8B4513] text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Resep Nusantara</h3>
                    <p class="text-sm">Platform berbagi resep masakan tradisional Indonesia dari berbagai daerah.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:underline">Beranda</a></li>
                        <li><a href="#resep-pilihan" class="hover:underline">Resep</a></li>
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Makanan Berat</a></li>
                        <li><a href="#" class="hover:underline">Makanan Ringan</a></li>
                        <li><a href="#" class="hover:underline">Minuman</a></li>
                        <li><a href="#" class="hover:underline">Kue Tradisional</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@resepnusantara.id
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 123 4567 890
                        </li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-