<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Nusantara Sederhana</title>
    @vite('resources/css/app.css') <!-- Untuk Tailwind (Breeze) -->
    <style>
        body {
            font-family: 'Poppins', serif;
            background-color: #f8f1e4;
        }
    </style>
</head>

<body class="bg-[#f8f1e4] text-gray-900">
    <!-- Navbar -->
    <nav class="bg-white bg-opacity-90 shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="/" class="text-3xl font-bold text-[#8B4513] tracking-wider">Resep Nusantara</a>
                <div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-[#8B4513]">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#8B4513] mr-4">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-[#8B4513] text-white px-5 py-2 rounded-lg shadow-md hover:bg-[#A0522D]">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center h-[500px] flex items-center justify-center text-center text-white mt-16"
        style="background-image: url('{{ asset('images/header.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-5xl font-extrabold mb-4 tracking-wide">Eksplorasi Kuliner Nusantara</h1>
            <p class="text-lg">Temukan kelezatan warisan Indonesia dalam setiap resep yang kami sajikan.</p>
            <a href="{{ route('register') }}"
                class="mt-4 inline-block bg-[#8B4513] text-white px-8 py-3 rounded-lg shadow-md text-lg hover:bg-[#A0522D] transition">
                Gabung Sekarang
            </a>
        </div>
    </header>

    <!-- Section: Daftar Resep -->
    <section class="pt-20 pb-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#8B4513]">Resep Pilihan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($reseps as $resep)
                    <div class="bg-white shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-[#8B4513]">{{ $resep->judul }}</h3>
                            <p class="mt-2 text-gray-700"><strong>Bahan:</strong></p>
                            <p class="text-gray-600">{!! nl2br(e($resep->bahan)) !!}</p>
                            <a href="{{ route('resep.show', $resep->id) }}"
                                class="text-[#A0522D] font-semibold mt-4 inline-block hover:underline">Lihat Resep</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#8B4513] text-white text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} Resep Nusantara Sederhana. All Rights Reserved.</p>
    </footer>
</body>

</html>