<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
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
        /* Theme Variables */
        :root {
            /* Dark theme (default) */
            --primary-dark: #121212;
            --secondary-dark: #1e1e1e;
            --accent-dark: #2a2a2a;
            --text-light: #f1f1f1;
            --text-gray: #a0a0a0;
            --accent-color: #1a9fff;
            --shadow-color: rgba(0, 0, 0, 0.2);
            --border-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Light theme */
        [data-theme="light"] {
            --primary-dark: #f5f5f5;
            --secondary-dark: #ffffff;
            --accent-dark: #e8e8e8;
            --text-light: #333333;
            --text-gray: #666666;
            --accent-color: #1a9fff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --border-color: rgba(0, 0, 0, 0.1);
        }
        
        /* Color Inversion Container */
        .invert-container {
            min-height: 100vh;
            transition: filter 0.3s ease;
        }
        
        .invert-container.inverted {
            filter: invert(100%) hue-rotate(180deg);
        }
        
        .invert-container.inverted img,
        .invert-container.inverted .user-avatar img {
            filter: invert(100%) hue-rotate(180deg);
        }
        
        /* Invert Toggle Button */
        .invert-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--accent-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border: none;
            transition: all 0.3s ease;
        }
        
        .invert-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
        }
        
        .invert-toggle i {
            font-size: 24px;
        }
        
        /* Global styling for users with ultimate badge */
        @if(auth()->check() && auth()->user()->hasUltimateBadge())
        body {
            background-color: var(--primary-dark);
            background-image: linear-gradient(to bottom, rgba(255, 215, 0, 0.03), rgba(0, 0, 0, 0));
        }
        
        .navbar {
            border-bottom: 1px solid rgba(255, 215, 0, 0.2) !important;
        }
        
        .profile-photo {
            border: 4px solid #FFD700 !important;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.5) !important;
        }
        
        .profile-info h1 {
            color: #FFD700 !important;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.4) !important;
        }
        @endif
        
        /* Global styling for admin users */
        @if(auth()->check() && auth()->user()->is_admin)
        /* Override accent color for admin users */
        :root {
            --accent-color: #ff3333;
        }
        
        body {
            background-color: var(--primary-dark);
            background-image: linear-gradient(to bottom, rgba(150, 0, 0, 0.05), rgba(0, 0, 0, 0));
        }
        
        .navbar {
            border-bottom: 1px solid rgba(255, 0, 0, 0.2) !important;
            background: linear-gradient(to right, rgba(30, 30, 30, 0.98), rgba(60, 10, 10, 0.95)) !important;
        }
        
        .profile-photo {
            border: 4px solid #990000 !important;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.3) !important;
        }
        
        .profile-info h1 {
            color: #ff3333 !important;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.4) !important;
        }
        
        @keyframes admin-pulse {
            0% { box-shadow: 0 0 15px rgba(255, 0, 0, 0.3); }
            50% { box-shadow: 0 0 25px rgba(255, 0, 0, 0.6); }
            100% { box-shadow: 0 0 15px rgba(255, 0, 0, 0.3); }
        }
        
        .admin-badge {
            animation: admin-pulse 2s infinite;
        }
        
        /* Override blue accent colors with red for admins */
        .stat-number {
            background: linear-gradient(135deg, #ff3333, #990000) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        
        .feature-icon {
            background: linear-gradient(135deg, #ff3333, #990000) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        
        .admin-stat-number {
            color: #ff3333 !important;
            background: linear-gradient(135deg, #ff5555, #cc0000) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        
        .admin-control-btn {
            color: #ff3333 !important;
        }
        
        /* Change blue numbers in the dashboard to red */
        .dashboard-stat-number,
        .stat-number {
            background: linear-gradient(135deg, #ff3333, #990000) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        
        /* Target the blue numbers on the user profile page */
        .container .dashboard-stats,
        .container .feature-icon,
        .container [class*="stat-"],
        .container [class*="number"] {
            color: #ff3333 !important;
            background: linear-gradient(135deg, #ff5555, #cc0000) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        
        /* Admin Navigation and Logo */
        .logo span {
            color: #ff3333 !important;
        }
        
        .logo span strong {
            color: #ffffff !important;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.4) !important;
        }
        
        .logo-icon {
            background: linear-gradient(135deg, #ff3333, #990000) !important;
            box-shadow: 0 2px 8px rgba(255, 0, 0, 0.3) !important;
        }
        
        .logo:hover .logo-icon {
            box-shadow: 0 4px 12px rgba(255, 0, 0, 0.5) !important;
        }
        
        .nav-link.active {
            color: #ff5555 !important;
            background-color: rgba(255, 0, 0, 0.1) !important;
        }
        @endif
        
        /* Basic styling for all users */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--primary-dark);
            color: var(--text-light);
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .navbar {
            background-color: var(--secondary-dark);
            padding: 0.7rem 2rem;
            box-shadow: 0 2px 12px var(--shadow-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease, border-bottom 0.3s ease;
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
            gap: 1.8rem;
            margin-right: auto;
            margin-left: 2.5rem;
        }
        
        .nav-link {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-link i {
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .nav-link.active {
            color: var(--accent-color);
            background-color: rgba(26, 159, 255, 0.1);
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
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
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            color: white !important;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #0d8bf0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 159, 255, 0.3);
        }
        
        .login-btn {
            padding: 0.6rem 1.2rem;
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
            border-top: 1px solid rgba(255, 255, 255, 0.05);
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
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
        }
        
        .footer-link:hover {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            color: var(--text-light);
            font-weight: 600;
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-btn:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--secondary-dark);
            min-width: 220px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.3);
            z-index: 100;
            border-radius: 8px;
            margin-top: 0.7rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }
        
        .dropdown-content a {
            color: var(--text-gray);
            padding: 14px 18px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .dropdown-content a:last-child {
            border-bottom: none;
        }
        
        .dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
        }
        
        .dropdown-content.show {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .username-display {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .cart-icon {
            position: relative;
            padding: 0.5rem;
            font-size: 1.2rem;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.08);
            transition: all 0.3s;
            color: var(--text-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .cart-icon:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
            color: var(--accent-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .cart-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: var(--accent-color);
            color: white;
            font-size: 0.75rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="invert-container">
        <header class="navbar">
            <div class="navbar-content">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-gamepad primary"></i>
                    </div>
                    <span>Oyun<strong>Sepetim</strong></span>
                </a>
                
                <nav class="nav-links">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Ana Sayfa</a>
                    <a href="/games" class="nav-link {{ request()->is('games*') ? 'active' : '' }}">Oyunlar</a>
                    <a href="/deals" class="nav-link {{ request()->is('deals*') ? 'active' : '' }}">Fırsatlar</a>
                    <a href="/wishlist" class="nav-link {{ request()->is('wishlist*') ? 'active' : '' }}"><i class="fas fa-heart"></i> İstek Listesi</a>
                    <a href="/library" class="nav-link {{ request()->is('library*') ? 'active' : '' }}"><i class="fas fa-gamepad"></i> Kütüphanem</a>
                </nav>
                
                <div class="user-actions">
                    @php
                        $cartCount = session('cart') ? count(session('cart')) : 0;
                    @endphp
                    
                    <a href="/cart" class="cart-icon" title="Sepet">
                        <i class="fas fa-shopping-cart"></i>
                        @if($cartCount > 0)
                            <span class="cart-count">{{ $cartCount }}</span>
                        @endif
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
                                <span class="username-display">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="dropdown-content">
                                @if(Auth::user()->is_admin)
                                    <a href="/admin/panel"><i class="fas fa-cogs mr-2"></i> Panel</a>
                                @endif
                                <a href="/dashboard"><i class="fas fa-user"></i> Kullanıcı Paneli</a>
                                <a href="/orders"><i class="fas fa-history"></i> Satın Alma Geçmişi</a>
                                <a href="#" id="dropdown-theme-toggle"><i class="fas fa-adjust"></i> <span id="theme-text">Açık Tema</span></a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="btn btn-primary login-btn"><i class="fas fa-sign-in-alt"></i> Giriş Yap</a>
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
        
        <!-- Invert Toggle Button -->
        <button class="invert-toggle" id="invert-toggle" title="Renkleri Tersine Çevir">
            <i class="fas fa-exchange-alt"></i>
        </button>
    </div>

    @yield('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kullanıcı dropdown menüsü işlevselliği
            function setupDropdownMenu() {
                const dropdownBtn = document.querySelector('.dropdown-btn');
                const dropdownContent = document.querySelector('.dropdown-content');
                
                if (!dropdownBtn || !dropdownContent) return;
                
                // Dropdown açma/kapama işlevi
                dropdownBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdownContent.classList.toggle('show');
                });
                
                // Sayfa dışına tıklandığında menüyü kapat
                document.addEventListener('click', function(e) {
                    if (dropdownContent.classList.contains('show') && 
                        !dropdownBtn.contains(e.target) && 
                        !dropdownContent.contains(e.target)) {
                        dropdownContent.classList.remove('show');
                    }
                });
                
                // ESC tuşu ile menüyü kapat
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && dropdownContent.classList.contains('show')) {
                        dropdownContent.classList.remove('show');
                    }
                });
            }
            
            // Dropdown menü işlevini başlat
            setupDropdownMenu();
            
            // Theme switching functionality
            function setupThemeToggle() {
                const themeToggle = document.getElementById('theme-toggle');
                const dropdownThemeToggle = document.getElementById('dropdown-theme-toggle');
                const themeText = document.getElementById('theme-text');
                const htmlElement = document.documentElement;
                
                // Check for saved theme preference or use default
                const savedTheme = localStorage.getItem('theme') || 'dark';
                htmlElement.setAttribute('data-theme', savedTheme);
                
                // Update theme text based on current theme
                updateThemeText(savedTheme);
                
                // Handle main theme toggle click
                if (themeToggle) {
                    themeToggle.addEventListener('click', function() {
                        toggleTheme();
                    });
                }
                
                // Handle dropdown theme toggle click
                if (dropdownThemeToggle) {
                    dropdownThemeToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleTheme();
                    });
                }
                
                // Function to toggle theme
                function toggleTheme() {
                    const currentTheme = htmlElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    htmlElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateThemeText(newTheme);
                }
                
                // Function to update theme text
                function updateThemeText(theme) {
                    if (themeText) {
                        themeText.textContent = theme === 'dark' ? 'Açık Tema' : 'Koyu Tema';
                    }
                }
            }
            
            // Start theme toggle functionality
            setupThemeToggle();
            
            // Color inversion functionality
            function setupInvertToggle() {
                const invertToggle = document.getElementById('invert-toggle');
                const invertContainer = document.querySelector('.invert-container');
                
                if (!invertToggle || !invertContainer) return;
                
                // Check for saved inversion preference
                const isInverted = localStorage.getItem('inverted') === 'true';
                if (isInverted) {
                    invertContainer.classList.add('inverted');
                }
                
                // Handle invert toggle click
                invertToggle.addEventListener('click', function() {
                    invertContainer.classList.toggle('inverted');
                    const newInverted = invertContainer.classList.contains('inverted');
                    localStorage.setItem('inverted', newInverted);
                });
            }
            
            // Start invert toggle functionality
            setupInvertToggle();
        });
    </script>
</body>
</html> 