<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resep Nusantara | Warisan Kuliner Indonesia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --light-brown: #D4A574;
            --cream: #f8f1e4;
            --dark-brown: #6B4423;
            --accent-gold: #DAA520;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream);
            color: var(--dark-brown);
            line-height: 1.6;
        }

        /* Enhanced Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
            box-shadow: 0 4px 20px rgba(139, 69, 19, 0.3);
            padding: 1rem 0;
            position: 
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        /* Navbar Container - Flex untuk align brand dan nav items */
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .navbar-brand-custom {
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            flex-shrink: 0;
        }

        .navbar-brand-custom:hover {
            color: var(--accent-gold) !important;
            transform: translateY(-2px);
        }

        .navbar-brand-custom::after {
            content: '🍜';
            margin-left: 0.5rem;
            font-size: 1.2rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
            60% { transform: translateY(-3px); }
        }

        .navbar-nav-custom {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-item {
            margin: 0;
        }

        .nav-link-custom {
            color: white !important;
            font-weight: 500;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link-custom:hover::before {
            left: 100%;
        }

        .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            color: var(--accent-gold) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .nav-link-custom.active {
            background: var(--accent-gold);
            color: var(--primary-brown) !important;
            font-weight: 600;
        }

        .btn-logout {
            background: transparent;
            border: 2px solid white;
            color: white !important;
            padding: 0.75rem 1.25rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: white;
            color: var(--primary-brown) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn-register {
            background: var(--accent-gold);
            color: var(--primary-brown) !important;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(218, 165, 32, 0.3);
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }

        .btn-register:hover {
            background: #FFD700;
            color: var(--primary-brown) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(218, 165, 32, 0.4);
        }

        /* Mobile Menu Toggle */
        .navbar-toggler-custom {
            border: none;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler-custom:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .navbar-toggler-icon-custom {
            width: 24px;
            height: 2px;
            background: white;
            display: block;
            margin: 4px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        /* Content Container */
        .main-content {
            min-height: calc(100vh - 100px);
            padding: 2rem 0;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Footer */
        .footer-custom {
            background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .footer-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .footer-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--accent-gold);
        }

        .footer-text {
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 1rem;
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: var(--primary-brown);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: var(--secondary-brown);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        }

    </style>
</head>

<body>
    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-custom">
            <a class="navbar-brand-custom" href="/">Resep Nusantara</a>
            
            <button class="navbar-toggler navbar-toggler-custom d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon-custom"></span>
                <span class="navbar-toggler-icon-custom"></span>
                <span class="navbar-toggler-icon-custom"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-nav-custom">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="/">
                                <i class="fas fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('reseps.create') ? 'active' : '' }}" href="{{ route('reseps.create') }}">
                                <i class="fas fa-plus-circle me-1"></i> Upload Resep
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('my-index') ? 'active' : '' }}" href="{{ route('my-index') }}">
                                <i class="fas fa-book me-1"></i> Resep Saya
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-logout">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="/">
                                <i class="fas fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-register" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-custom">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container-custom">
            <div class="footer-content">
                <div class="footer-brand">Resep Nusantara</div>
                <p class="footer-text">Platform berbagi resep masakan tradisional Indonesia dari berbagai daerah</p>
                
                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} Resep Nusantara. Semua hak dilindungi. Dibuat dengan ❤️ untuk Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Scroll to top functionality
        const scrollTopBtn = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Navbar collapse on mobile after click
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    bootstrap.Collapse.getInstance(navbarCollapse).hide();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>