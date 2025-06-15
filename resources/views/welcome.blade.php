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
<!-- Enhanced Footer -->
<footer class="relative overflow-hidden">
    <!-- Background with Pattern -->
    <div class="bg-gradient-to-br from-[#8B4513] via-[#A0522D] to-[#8B4513] text-white">
        <!-- Decorative Pattern Overlay -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><defs><pattern id=&quot;grain&quot; width=&quot;100&quot; height=&quot;100&quot; patternUnits=&quot;userSpaceOnUse&quot;><circle cx=&quot;25&quot; cy=&quot;25&quot; r=&quot;2&quot; fill=&quot;rgba(255,255,255,0.3)&quot;/><circle cx=&quot;75&quot; cy=&quot;75&quot; r=&quot;1&quot; fill=&quot;rgba(255,255,255,0.2)&quot;/><circle cx=&quot;50&quot; cy=&quot;10&quot; r=&quot;1.5&quot; fill=&quot;rgba(255,255,255,0.25)&quot;/></pattern></defs><rect width=&quot;100&quot; height=&quot;100&quot; fill=&quot;url(%23grain)&quot;/></svg>');"></div>
        </div>
        
        <!-- Main Footer Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-16">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-12">
                
                <!-- Brand Section -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <span class="text-2xl">🍜</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Resep Nusantara</h3>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed mb-6 max-w-md">
                        Platform terpercaya untuk berbagi dan melestarikan resep masakan tradisional Indonesia dari Sabang sampai Merauke.
                    </p>
                    
                    <!-- Social Media -->
                    <div class="flex gap-4">
                        <a href="#" class="group w-12 h-12 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white group-hover:text-[#DAA520] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white group-hover:text-[#DAA520] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white group-hover:text-[#DAA520] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/6287856249352" class="group w-12 h-12 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white group-hover:text-[#DAA520] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 text-white flex items-center gap-2">
                        <i class="fas fa-compass text-[#DAA520]"></i>
                        Navigasi
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="/" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-2 group">
                                <i class="fas fa-home w-4 text-center group-hover:scale-110 transition-transform"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#resep-pilihan" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-2 group">
                                <i class="fas fa-utensils w-4 text-center group-hover:scale-110 transition-transform"></i>
                                Resep Pilihan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-2 group">
                                <i class="fas fa-tachometer-alt w-4 text-center group-hover:scale-110 transition-transform"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/6287856249352" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-2 group">
                                <i class="fas fa-phone w-4 text-center group-hover:scale-110 transition-transform"></i>
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 text-white flex items-center gap-2">
                        <i class="fas fa-address-book text-[#DAA520]"></i>
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="mailto:info@resepnusantara.id" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-[#DAA520]/20 transition-colors backdrop-blur-sm">
                                    <i class="fas fa-envelope text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">Email</div>
                                    <div class="text-sm text-white/70">info@resepnusantara.id</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/6287856249352" class="text-white/80 hover:text-[#DAA520] transition-colors duration-300 flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-[#DAA520]/20 transition-colors backdrop-blur-sm">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium">WhatsApp</div>
                                    <div class="text-sm text-white/70">+62 878-5624-9352</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="relative z-10 border-t border-white/20 bg-black/20">
            <div class="max-w-7xl mx-auto px-6 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
                    <div class="text-white/80">
                        <p>&copy; {{ date('Y') }} <span class="font-semibold text-[#DAA520]">Resep Nusantara</span>. Semua hak dilindungi.</p>
                        <p class="text-sm mt-1">Dibuat dengan ❤️ untuk Indonesia</p>
                    </div>
                    <div class="flex items-center gap-6 text-sm text-white/70">
                        <a href="#" class="hover:text-[#DAA520] transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-[#DAA520] transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="hover:text-[#DAA520] transition-colors">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>