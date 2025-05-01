<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OyunSepetim') }} - @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC5ElEQVRYR8WXS2gTURSGz0lmkk7SpE3S2KaJL2hr1YWiVcSFCi4EQRAXdaGCK124cKWILgQXIi50oSjiwoWv+sKFKFLQhY+FIGhbqw8kNq+2NJM0j8moZ5JJzGOm6dQsDHMf5/7f/88999xzCPKYZVnucrm8bjAYGggh63meJ4SQw4SQg0KIfgaDYQIASp1O5yc/BFWAsbGxg6ZisbXD4eiYmpqafDRQXdPT0bYCz9eJonjcZrONUkoNGo+1AA6Hg2a93gNGo/GZw+HoO6gxiqJ4xuFwXLfb7R/r6+troyi9qwBGR0dPOZ3OLiJJDvkJKeVvEkJuLSwsvHe5XBcnJyfnqqqqmpLJ5OXl5eVP29ra3uUCyQEYGxs7PTAw0GE2m88FAgG30Wjc0i4Wi/2oqak5Mjs7255MJq9aloVHNpttYmxs7I7b7X5ZX19/xOPxXAuHw/1erzdECPnXNocw9xKUmEwmG0v+3ufzfZIkTUqShCiKQjabbent7Z0oLi7uKC0tfd7T0/NJkG/FarV+jkQiF+vq6m5KkhRdWVm5T7LZ7L+U4/YlIAgCYZiCYDB4M5PJwNLSUi8hvDCCwtVcgDNtbW0vBEHwFRUVdblcLndhYeExGZmfn7eazea9LquZBUEQ0Ol0TsRisWcMw5xGu7VabVHmXMJkMmm1Wj3CarWnFxcX32JmUALI0sKy7C6KTxdAYU/WQK6tpDY0A9AKQK0CXatE2KkZQAnAfxUC5VuQr0M2m9WUBsYYzBYXF2/vJMSZVCr1oLS09Go4HB6ura19uDEg/UMBkKOKnWIkEsGx6wLLsjcopcfxtWRZlsYYf9cLgDE2Y4y3hcPhk6Ojo1cwxnfS6fRVxtgTVKFbTVo5jTGmCONPGOM3TNMUNjQYozYY44+MHuUfQg5AacBmA0Wp/wlA4+9ALGTm5XneiDFOY4z/YIxXYY0xnmMYxocwxnN6nCotPgMK+C0QQpIY42XGmF8xxtOUUhvGePt/kJZWB5RuU28AAAAASUVORK5CYII=">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #121212;
            --secondary-dark: #1e1e1e;
            --accent-dark: #2a2a2a;
            --text-light: #f1f1f1;
            --text-gray: #a0a0a0;
            --accent-color: #1a9fff;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--primary-dark);
            color: var(--text-light);
            margin: 0;
            padding: 0;
        }
        
        .navbar {
            background-color: var(--secondary-dark);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo span {
            color: var(--accent-color);
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
            font-size: 1.6rem;
        }
        
        .logo span strong {
            color: white;
            font-weight: 800;
        }
        
        .logo:hover span {
            color: #3aafff;
        }
        
        .logo:hover span strong {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
        
        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent-color), #0066cc);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(26, 159, 255, 0.3);
            position: relative;
            overflow: visible;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 1;
        }
        
        .logo:hover .logo-icon {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(26, 159, 255, 0.5);
        }
        
        .logo-icon i.primary {
            font-size: 20px;
            color: white;
            z-index: 2;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-link {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--text-light);
        }
        
        .nav-link.active {
            color: var(--accent-color);
        }
        
        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .user-actions a {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .user-actions a:hover {
            color: var(--text-light);
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #0d8bf0;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .footer {
            background-color: var(--secondary-dark);
            padding: 2rem;
            margin-top: 3rem;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .footer-link {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-link:hover {
            color: var(--text-light);
        }
        
        .search-container {
            margin: 0;
            padding: 0;
            display: block;
        }
        
        .search-bar {
            display: flex;
            background-color: var(--accent-dark);
            border-radius: 8px;
            overflow: hidden;
            width: 300px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            position: relative;
        }
        
        .search-bar:focus-within {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2);
            background-color: rgba(42, 42, 42, 0.8);
        }
        
        .search-input {
            background-color: transparent;
            border: none;
            color: var(--text-light);
            padding: 0.8rem 1rem;
            flex-grow: 1;
            outline: none;
            font-size: 0.95rem;
        }
        
        .search-input::placeholder {
            color: var(--text-gray);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        
        .search-input:focus::placeholder {
            opacity: 0.5;
        }
        
        .search-btn {
            background-color: var(--accent-color);
            border: none;
            color: white;
            padding: 0.8rem 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .search-btn:hover {
            background-color: #0d8bf0;
        }
        
        .search-btn i {
            font-size: 1rem;
        }
        
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: var(--secondary-dark);
            border-radius: 0 0 8px 8px;
            border: 1px solid var(--accent-color);
            border-top: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 999;
            max-height: 300px;
            overflow-y: auto;
            display: none;
        }
        
        .search-bar:focus-within .search-suggestions {
            max-height: 300px;
        }
        
        .suggestion-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--accent-dark);
        }
        
        .suggestion-item:last-child {
            border-bottom: none;
        }
        
        .suggestion-item:hover {
            background-color: var(--accent-dark);
        }
        
        .suggestion-thumb {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .suggestion-info {
            flex-grow: 1;
        }
        
        .suggestion-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
        
        .suggestion-category {
            font-size: 0.8rem;
            color: var(--text-gray);
        }
        
        .suggestion-price {
            font-weight: 700;
            color: var(--accent-color);
            font-size: 0.9rem;
        }
        
        .search-no-results {
            padding: 1rem;
            text-align: center;
            color: var(--text-gray);
            font-style: italic;
        }
        
        @media (max-width: 768px) {
            .navbar-content, .footer-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                flex-direction: column;
                align-items: center;
            }
            
            .search-bar {
                width: 100%;
            }
        }
        
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--text-light);
            font-weight: 600;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--secondary-dark);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 10;
            border-radius: 4px;
            margin-top: 0.5rem;
        }
        
        .dropdown-content a {
            color: var(--text-gray);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }
        
        .dropdown-content a:hover {
            background-color: var(--accent-dark);
            color: var(--text-light);
        }
        
        .dropdown-content.show {
            display: block;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background-color: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .cart-icon {
            position: relative;
            padding-right: 0.2rem;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--accent-color);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>

    @yield('styles')
</head>
<body>
    <header class="navbar">
        <div class="navbar-content">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-gamepad primary"></i>
                </div>
                <span>Oyun<strong>Sepetim</strong></span>
            </a>
            
            <form action="/games" method="GET" class="search-container" id="search-form">
                <div class="search-bar">
                    <input type="text" class="search-input" name="search" placeholder="Oyun ara..." autocomplete="off" id="game-search">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
            
            <nav class="nav-links">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Ana Sayfa</a>
                <a href="/games" class="nav-link {{ request()->is('games*') ? 'active' : '' }}">Oyunlar</a>
                <a href="/deals" class="nav-link {{ request()->is('deals*') ? 'active' : '' }}">Fırsatlar</a>
                <a href="/wishlist" class="nav-link {{ request()->is('wishlist*') ? 'active' : '' }}">İstek Listesi</a>
                <a href="/library" class="nav-link {{ request()->is('library*') ? 'active' : '' }}">Kütüphanem</a>
            </nav>
            
            <div class="user-actions">
                @php
                    $cartCount = session('cart') ? count(session('cart')) : 0;
                @endphp
                
                <a href="/cart" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    @if($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                    Sepet
                </a>
                
                @auth
                    <div class="user-dropdown">
                        <div class="dropdown-btn">
                            <div class="user-avatar">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('images/profiles/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                @endif
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="dropdown-content">
                            @if(Auth::user()->is_admin)
                                <a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Panel</a>
                            @endif
                            <a href="/profile"><i class="fas fa-user"></i> Profil</a>
                            <a href="/orders"><i class="fas fa-history"></i> Satın Alma Geçmişi</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                            </a>
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="btn btn-primary">Giriş Yap</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div>
                <p>&copy; {{ date('Y') }} OyunSepetim. Tüm hakları saklıdır.</p>
            </div>
            <div class="footer-links">
                <a href="/about" class="footer-link">Hakkımızda</a>
                <a href="/contact" class="footer-link">İletişim</a>
                <a href="/privacy" class="footer-link">Gizlilik Politikası</a>
                <a href="/terms" class="footer-link">Kullanım Şartları</a>
            </div>
        </div>
    </footer>

    @yield('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Arama formu boşken gönderilmesini engelle
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('game-search');
            
            searchForm.addEventListener('submit', function(event) {
                if (searchInput.value.trim() === '') {
                    event.preventDefault();
                }
            });

            // Dropdown menü için tıklama işlevi
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownContent = document.querySelector('.dropdown-content');
            
            if (dropdownBtn && dropdownContent) {
                // Dropdown butonuna tıklandığında menüyü aç/kapat
                dropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownContent.classList.toggle('show');
                });
                
                // Sayfa herhangi bir yerine tıklandığında menüyü kapat
                document.addEventListener('click', function(e) {
                    if (!dropdownBtn.contains(e.target) && !dropdownContent.contains(e.target)) {
                        dropdownContent.classList.remove('show');
                    }
                });
                
                // Dropdown içindeki bağlantılara tıklandığında menü kapanmasın
                dropdownContent.addEventListener('click', function(e) {
                    if (e.target.tagName === 'A') {
                        // Menüyü kapat eğer tıklanan eleman "Çıkış Yap" değilse
                        if (!e.target.classList.contains('logout-link')) {
                            dropdownContent.classList.remove('show');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html> 