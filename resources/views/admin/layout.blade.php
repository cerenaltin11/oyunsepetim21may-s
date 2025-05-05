<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel | {{ config('app.name', 'OyunSepetim') }}</title>
    
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
            --admin-primary: var(--primary-dark);
            --admin-secondary: var(--secondary-dark);
            --admin-text: var(--text-light);
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--primary-dark);
            color: var(--text-light);
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        .admin-sidebar {
            width: 250px;
            background-color: var(--secondary-dark);
            color: var(--text-light);
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .admin-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }
        
        .admin-logo {
            padding: 15px 20px;
            margin-bottom: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            background-color: var(--secondary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu-header {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-gray);
            padding: 15px 20px 5px;
            font-weight: bold;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-gray);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
            gap: 10px;
        }
        
        .sidebar-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
        }
        
        .sidebar-menu li a.active {
            background-color: rgba(26, 159, 255, 0.1);
            color: var(--accent-color);
            border-left: 3px solid var(--accent-color);
        }
        
        .admin-header {
            background-color: var(--secondary-dark);
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .page-title {
            font-size: 1.5rem;
            margin: 0;
            color: var(--text-light);
        }
        
        .admin-card {
            background-color: var(--secondary-dark);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background-color: var(--secondary-dark);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-users { background-color: #3498db; }
        .stat-games { background-color: #2ecc71; }
        .stat-reviews { background-color: #e74c3c; }
        
        .stat-info h3 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--text-light);
        }
        
        .stat-info p {
            margin: 5px 0 0;
            color: var(--text-gray);
            font-size: 0.9rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0d8bf0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 159, 255, 0.3);
        }
        
        .btn-success {
            background-color: #2ecc71;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background-color: #f39c12;
            color: white;
        }
        
        .btn-warning:hover {
            background-color: #d35400;
            transform: translateY(-2px);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text-light);
        }
        
        .table thead th {
            background-color: var(--accent-dark);
            color: var(--text-gray);
            font-weight: 600;
        }
        
        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            border-left: 4px solid transparent;
            background-color: var(--accent-dark);
            color: var(--text-light);
        }
        
        .alert-success {
            border-color: #2ecc71;
        }
        
        .alert-danger {
            border-color: #e74c3c;
        }
        
        .alert-warning {
            border-color: #f39c12;
        }
        
        .alert-info {
            border-color: var(--accent-color);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background-color: var(--accent-dark);
            color: var(--text-light);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(26, 159, 255, 0.25);
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-light);
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23a0a0a0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 20px 0;
            border-radius: 6px;
            overflow: hidden;
        }
        
        .pagination li {
            margin: 0;
        }
        
        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 14px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background-color: var(--secondary-dark);
            color: var(--text-gray);
            transition: all 0.3s;
        }
        
        .pagination li.active span {
            background-color: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }
        
        .pagination li a:hover {
            background-color: var(--accent-dark);
            color: var(--text-light);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="admin-logo">
                <i class="fas fa-gamepad"></i>
                OyunSepetim
            </div>
            
            <ul class="sidebar-menu">
                <li class="sidebar-menu-header">YÖNETİM</li>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a></li>
                <li><a href="{{ route('admin.panel') }}" class="{{ request()->routeIs('admin.panel') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i> Panel
                </a></li>
                
                <li class="sidebar-menu-header">KULLANICILAR</li>
                <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Kullanıcılar
                </a></li>
                
                <li class="sidebar-menu-header">OYUNLAR</li>
                <li><a href="{{ route('admin.games') }}" class="{{ request()->routeIs('admin.games*') ? 'active' : '' }}">
                    <i class="fas fa-gamepad"></i> Oyunlar
                </a></li>
                
                <li class="sidebar-menu-header">SİTE</li>
                <li><a href="/dashboard">
                    <i class="fas fa-user"></i> Kullanıcı Dashboardına Dön
                </a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <a href="javascript:void(0)" onclick="this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1 class="page-title">@yield('title')</h1>
                <div class="user-info">
                    <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
</body>
</html> 