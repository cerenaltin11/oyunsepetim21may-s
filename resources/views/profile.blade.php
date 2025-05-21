@extends('layouts.app')

@section('title', 'Kullanıcı Paneli')

@section('styles')
<style>
    :root {
        --card-gradient: linear-gradient(145deg, rgba(35, 35, 35, 0.8), rgba(20, 20, 20, 0.9));
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.2);
        --shadow-strong: 0 15px 35px rgba(0, 0, 0, 0.3);
        --glow-effect: 0 0 15px rgba(26, 159, 255, 0.3);
    }
    
    /* Admin styling */
    @keyframes admin-pulse-bg {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .admin-profile {
        position: relative;
        animation: admin-entrance 0.6s ease-out forwards;
    }
    
    .admin-profile::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #600, #900, #a00, #900, #600);
        background-size: 400% 400%;
        z-index: -1;
        border-radius: 15px;
        filter: blur(10px);
        opacity: 0.3;
        animation: admin-pulse-bg 10s ease infinite;
    }
    
    @keyframes admin-entrance {
        0% {
            transform: scale(0.95);
            opacity: 0;
        }
        50% {
            transform: scale(1.02);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .admin-entrance-effect {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(150, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0) 70%);
        z-index: 9999;
        pointer-events: none;
        opacity: 0;
        animation: admin-entrance-bg 1.5s ease-out forwards;
    }
    
    @keyframes admin-entrance-bg {
        0% {
            opacity: 0;
        }
        30% {
            opacity: 0.8;
        }
        100% {
            opacity: 0;
        }
    }
    
    .admin-badge-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(150, 0, 0, 0.3);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }
    
    .admin-badge-indicator i {
        color: #ff3333;
        font-size: 20px;
    }
    
    @keyframes admin-pulse {
        0% { box-shadow: 0 0 15px rgba(255, 0, 0, 0.3); }
        50% { box-shadow: 0 0 25px rgba(255, 0, 0, 0.6); }
        100% { box-shadow: 0 0 15px rgba(255, 0, 0, 0.3); }
    }
    
    .admin-badge-pulse {
        animation: admin-pulse 2s infinite;
    }
    
    /* Normal profile styling */
    .profile-container {
        background-color: var(--secondary-dark);
        border-radius: 12px;
        padding: 0;
        margin-bottom: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }
    
    .profile-banner {
        height: 180px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='400' viewBox='0 0 800 400'%3E%3Crect width='800' height='400' fill='%23061630'/%3E%3Cpath d='M0 80 L800 80' stroke='%230a2e64' stroke-width='1' stroke-dasharray='10,15'/%3E%3Cpath d='M0 160 L800 160' stroke='%230a2e64' stroke-width='1' stroke-dasharray='10,15'/%3E%3Cpath d='M0 240 L800 240' stroke='%230a2e64' stroke-width='1' stroke-dasharray='10,15'/%3E%3Cpath d='M0 320 L800 320' stroke='%230a2e64' stroke-width='1' stroke-dasharray='10,15'/%3E%3Ccircle cx='200' cy='200' r='120' fill='none' stroke='%231a9fff' stroke-width='2' stroke-dasharray='3,8'/%3E%3Ccircle cx='600' cy='200' r='80' fill='none' stroke='%231a9fff' stroke-width='2' stroke-dasharray='3,8'/%3E%3Cpolygon points='400,50 450,150 350,150' fill='none' stroke='%231a9fff' stroke-width='2'/%3E%3Cpolygon points='400,350 450,250 350,250' fill='none' stroke='%231a9fff' stroke-width='2'/%3E%3Crect x='300' y='150' width='200' height='100' fill='none' stroke='%231a9fff' stroke-width='2' rx='10' ry='10'/%3E%3C/svg%3E");
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }
    
    .profile-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.3);
        opacity: 0.3;
    }
    
    .profile-header {
        padding: 0 2rem 2rem;
        position: relative;
        z-index: 10;
        display: flex;
        align-items: flex-end;
        gap: 2rem;
        margin-top: -60px;
    }
    
    .profile-info {
        padding-top: 30px;
    }
    
    .profile-info h1 {
        margin: 0 0 0.3rem;
        font-size: 2rem;
        color: var(--text-light);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .profile-info p {
        margin: 0;
        color: var(--text-gray);
        font-size: 1.1rem;
    }
    
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        background-color: var(--accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 4px solid var(--secondary-dark);
        box-shadow: var(--shadow-soft);
    }
    
    .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-photo-placeholder {
        color: var(--text-gray);
        font-size: 3rem;
    }
    
    /* Profile badges display in header */
    .user-badges-display {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .profile-badge-icon {
        background-color: rgba(26, 159, 255, 0.1);
        color: #1a9fff;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        box-shadow: 0 0 10px rgba(26, 159, 255, 0.2);
        transition: all 0.2s ease;
    }
    
    .profile-badge-icon:hover {
        transform: scale(1.2);
        box-shadow: 0 0 15px rgba(26, 159, 255, 0.4);
    }
    
    .more-badges {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--text-gray);
        padding: 0.2rem 0.5rem;
        border-radius: 12px;
        font-size: 0.7rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .more-badges:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: var(--text-light);
    }
    
    .dashboard-content {
        padding: 0 2rem 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .form-input {
        width: 100%;
        padding: 0.9rem 1rem;
        background-color: var(--accent-dark);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: var(--text-light);
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2), inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .btn-group {
        display: flex;
        gap: 1rem;
    }
    
    .section-divider {
        margin: 2rem 0;
        border-top: 1px solid var(--accent-dark);
        padding-top: 2rem;
    }
    
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .alert i {
        font-size: 1.2rem;
    }
    
    .alert-success {
        background-color: rgba(76, 175, 80, 0.15);
        color: #4caf50;
        border-left: 4px solid #4caf50;
    }
    
    .alert-danger {
        background-color: rgba(244, 67, 54, 0.15);
        color: #f44336;
        border-left: 4px solid #f44336;
    }
    
    .profile-photo-section {
        margin-bottom: 2rem;
    }
    
    .profile-photo-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }
    
    .file-upload input[type=file] {
        position: absolute;
        font-size: 100px;
        top: 0;
        right: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 10px 18px;
        background-color: var(--accent-dark);
        color: var(--text-gray);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .upload-btn:hover {
        background-color: var(--accent-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }
    
    .selected-file {
        margin-top: 0.5rem;
        font-size: 0.9rem;
        color: var(--text-gray);
    }
    
    .photo-preview {
        display: none;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 1rem;
        border: 3px solid var(--accent-color);
        box-shadow: var(--shadow-soft);
    }
    
    .banner-preview-container {
        display: none;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }
    
    .banner-preview {
        width: 100%;
        height: auto;
        max-height: 150px;
        object-fit: cover;
    }
    
    .form-hint {
        font-size: 0.9rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .secondary-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    /* Dashboard kartları için stiller */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .dashboard-cards a {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }
    
    .dashboard-cards a:hover {
        transform: translateY(-5px);
    }
    
    .dashboard-card {
        background: var(--card-gradient);
        border-radius: 12px;
        padding: 1.8rem;
        height: 100%;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.05));
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }
    
    .dashboard-cards a:hover .dashboard-card {
        box-shadow: var(--shadow-strong);
        border-color: rgba(26, 159, 255, 0.2);
    }
    
    .dashboard-cards a:hover .dashboard-card::after {
        transform: translateX(0);
    }
    
    .dashboard-cards a:hover .dashboard-card-icon {
        transform: scale(1.1);
        color: #fff;
        text-shadow: var(--glow-effect);
    }
    
    .dashboard-card-icon {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1.2rem;
        transition: all 0.3s;
    }
    
    .dashboard-card h3 {
        margin: 0 0 0.7rem;
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    .dashboard-card p {
        margin: 0;
        color: var(--text-gray);
        font-size: 0.95rem;
    }
    
    .tab-navigation {
        margin: 0 0 2rem;
        position: relative;
        display: flex;
        background: var(--accent-dark);
        border-radius: 10px;
        padding: 0.5rem;
        overflow: hidden;
    }
    
    .tab-btn {
        flex: 1;
        padding: 1rem 1.5rem;
        background: none;
        border: none;
        color: var(--text-gray);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border-radius: 6px;
        position: relative;
        z-index: 1;
    }
    
    .tab-btn.active {
        color: #fff;
    }
    
    .tab-navigation::after {
        content: "";
        position: absolute;
        width: calc(100% / 3); /* Sekme sayısına göre ayarlayın */
        height: calc(100% - 1rem);
        background-color: var(--accent-color);
        border-radius: 6px;
        top: 0.5rem;
        left: 0.5rem;
        transition: transform 0.3s ease;
        z-index: 0;
    }
    
    .tab-navigation.tab-2-active::after {
        transform: translateX(100%);
    }
    
    .tab-navigation.tab-3-active::after {
        transform: translateX(200%);
    }
    
    .tab-btn:hover:not(.active) {
        color: var(--text-light);
    }
    
    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .tab-content.active {
        display: block;
    }
    
    .tab-content h2 {
        font-size: 1.5rem;
        margin: 0 0 1.5rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .recent-activity {
        background: var(--card-gradient);
        border-radius: 12px;
        padding: 1.8rem;
        margin-top: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: var(--shadow-soft);
    }
    
    .recent-activity h2 {
        margin-top: 0;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .activity-item {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-date {
        display: block;
        color: var(--text-gray);
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }
    
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: var(--accent-dark);
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--shadow-soft);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: var(--text-gray);
        font-size: 0.9rem;
    }
    
    /* Responsive tasarım için düzenlemeler */
    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            text-align: center;
            margin-top: -40px;
        }
        
        .profile-info {
            padding-top: 15px;
        }
        
        .profile-info h1 {
            font-size: 1.5rem;
        }
        
        .tab-navigation {
            flex-direction: column;
            padding: 0.5rem;
        }
        
        .tab-btn {
            padding: 0.8rem;
        }
        
        .tab-navigation::after {
            display: none;
        }
        
        .tab-btn.active {
            background-color: var(--accent-color);
        }
    }
    
    /* Rozet stilleri */
    .profile-badges-section {
        margin-top: 2rem;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .badges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
    }
    
    .badge-item {
        background: rgba(30, 30, 30, 0.5);
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: all 0.2s ease;
    }
    
    .badge-item:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-soft);
        background: rgba(35, 35, 35, 0.7);
    }
    
    .badge-icon {
        background-color: rgba(26, 159, 255, 0.1);
        color: #1a9fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        box-shadow: var(--glow-effect);
    }
    
    .badge-info h4 {
        font-size: 0.9rem;
        color: var(--text-light);
        margin: 0;
    }
    
    .empty-badges-message {
        background: rgba(30, 30, 30, 0.5);
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        color: var(--text-gray);
    }
    
    .empty-badges-message i {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.1);
        margin-bottom: 1rem;
    }
    
    /* Düğme stilleri */
    .btn-secondary {
        padding: 0.7rem 1.2rem;
        background-color: rgba(26, 159, 255, 0.1);
        color: #1a9fff;
        border: 1px solid rgba(26, 159, 255, 0.2);
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .btn-secondary:hover {
        background-color: rgba(26, 159, 255, 0.2);
        border-color: rgba(26, 159, 255, 0.3);
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
    @if(Auth::user()->is_admin)
    <div class="admin-entrance-effect"></div>
    @endif
    
    <div class="profile-container {{ Auth::user()->is_admin ? 'admin-profile' : '' }}">
        <div class="profile-banner" 
            @if(Auth::user()->banner)
            style="background: url('{{ asset('images/banners/' . Auth::user()->banner) }}'); background-size: cover; background-position: center;"
            @endif
        >
            @if(Auth::user()->is_admin)
            <div class="admin-badge-indicator admin-badge-pulse">
                <i class="fas fa-shield-alt"></i>
            </div>
            @endif
        </div>
        
        <div class="profile-header">
            <div class="profile-photo">
                @if(Auth::user()->photo)
                    <img src="{{ asset('images/profiles/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}">
                @else
                    <i class="fas fa-user profile-photo-placeholder"></i>
                @endif
            </div>
            <div class="profile-info">
                <h1>Hoş Geldiniz, {{ Auth::user()->name }}
                    <span class="badge badge-primary" style="margin-left: 10px; font-size: 1rem; vertical-align: middle;">Level {{ Auth::user()->level }}</span>
                    <span title="Level Rozeti" style="vertical-align: middle; margin-left: 5px;">
                        <i class="fas fa-medal" style="color: gold;"></i>
                    </span>
                    <span style="margin-left: 10px; font-size: 0.9rem; color: #aaa;">({{ Auth::user()->xp }} XP)</span>
                </h1>
                <p>{{ Auth::user()->email }}</p>
                @if(Auth::user()->is_admin)
                <div style="margin-top: 5px; color: #ff3333;">
                    <i class="fas fa-shield-alt"></i> Yönetici
                </div>
                @endif
                @if(Auth::user()->badges->count() > 0)
                    <div class="user-badges-display">
                        @foreach(Auth::user()->badges->take(3) as $badge)
                            <span class="profile-badge-icon {{ $badge->name == 'admin_badge' ? 'admin-badge-pulse' : '' }}" 
                                  style="{{ $badge->name == 'admin_badge' ? 'background-color: rgba(150, 0, 0, 0.1); color: #ff3333;' : '' }}{{ $badge->name == 'ultimate_login' ? 'background-color: rgba(255, 215, 0, 0.1); color: #FFD700;' : '' }}"
                                  title="{{ $badge->description }}">
                                <i class="fas {{ $badge->icon }}"></i>
                            </span>
                        @endforeach
                        @if(Auth::user()->badges->count() > 3)
                            <a href="{{ route('profile.badges') }}" class="more-badges">+{{ Auth::user()->badges->count() - 3 }}</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        
        <div class="dashboard-content">
        @if(session('success'))
            <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
            <!-- İstatistikler -->
            <div class="stat-cards">
                <div class="stat-card">
                    <div class="stat-number">{{ Auth::user()->created_at->diffInDays() }}</div>
                    <div class="stat-label">Gündür Üyesiniz</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ Auth::user()->userGames()->count() }}</div>
                    <div class="stat-label">Oyun Satın Aldınız</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ count(Session::get('wishlist', [])) }}</div>
                    <div class="stat-label">İstek Listenizde</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ Auth::user()->friends()->count() }}</div>
                    <div class="stat-label">Arkadaşınız Var</div>
                </div>
            </div>
            
            <!-- Hızlı erişim kartları -->
            <div class="dashboard-cards">
                <a href="/library">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3>Kütüphanem</h3>
                        <p>Satın aldığınız oyunları buradan görüntüleyebilirsiniz.</p>
                    </div>
                </a>
                
                <a href="/orders">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <h3>Siparişlerim</h3>
                        <p>Sipariş geçmişinizi ve durumlarını kontrol edin.</p>
                    </div>
                </a>
                
                <a href="/wishlist">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>İstek Listem</h3>
                        <p>İstek listenize eklediğiniz oyunları görüntüleyin.</p>
                </div>
                </a>
                
                <a href="/cart">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Sepetim</h3>
                        <p>Sepetinizdeki oyunları görüntüleyin.</p>
                </div>
                </a>

                <a href="/friends">
                    <div class="dashboard-card">
                        <div class="dashboard-card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Arkadaşlarım</h3>
                        <p>Arkadaşlarınızı görüntüleyin ve yeni arkadaşlar ekleyin.</p>
                    </div>
                </a>
        </div>
        
            <!-- Sekme gezinme -->
            <div class="tab-navigation">
                <button class="tab-btn active" data-tab="profile-info">Profil Bilgileri</button>
                <button class="tab-btn" data-tab="password-change">Şifre Değiştir</button>
                <button class="tab-btn" data-tab="profile-photo">Profil Fotoğrafı</button>
            </div>
            
            <!-- Profil bilgileri sekmesi -->
            <div id="profile-info" class="tab-content active">
        <h2>Kişisel Bilgiler</h2>
        <form class="profile-form" action="/profile" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ Auth::user()->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ Auth::user()->email }}" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Bilgileri Güncelle</button>
            </div>
        </form>
        
        <!-- Kullanıcı rozetleri bölümü -->
        <div class="section-divider"></div>
        <div class="profile-badges-section">
            <div class="section-header">
                <h2>Rozetlerim</h2>
                <a href="{{ route('profile.badges') }}" class="btn btn-secondary">Tüm Rozetleri Gör</a>
            </div>
            
            <div class="badges-preview">
                @if(Auth::user()->badges->count() > 0)
                    <div class="badges-grid">
                        @foreach(Auth::user()->badges->take(4) as $badge)
                            <div class="badge-item">
                                <div class="badge-icon">
                                    <i class="fas {{ $badge->icon }}"></i>
                                </div>
                                <div class="badge-info">
                                    <h4>{{ $badge->description }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-badges-message">
                        <i class="fas fa-award"></i>
                        <p>Henüz hiç rozet kazanmadınız. Günlük giriş yaparak ve site aktivitelerinizle rozetler kazanabilirsiniz.</p>
                    </div>
                @endif
            </div>
        </div>
            </div>
        
            <!-- Şifre değiştir sekmesi -->
            <div id="password-change" class="tab-content">
        <h2>Şifre Değiştir</h2>
        <form class="profile-form" action="/password" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="current_password" class="form-label">Mevcut Şifre</label>
                <input type="password" id="current_password" name="current_password" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Yeni Şifre</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            
            <div class="form-group">
                        <label for="password_confirmation" class="form-label">Yeni Şifre Tekrar</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>
            
            <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Şifreyi Güncelle</button>
                    </div>
                </form>
            </div>
            
            <!-- Profil fotoğrafı sekmesi -->
            <div id="profile-photo" class="tab-content">
                <h2>Profil Fotoğrafı ve Banner</h2>
                <form class="profile-form" action="/profile/photo" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h3>Profil Fotoğrafı</h3>
                    <div class="profile-photo-container">
                        <div class="file-upload">
                            <button type="button" class="upload-btn">
                                <i class="fas fa-upload"></i> Fotoğraf Seç
                            </button>
                            <input type="file" name="photo" id="photo-upload" accept="image/*">
                        </div>
                        <div class="selected-file" id="selected-file-name">Dosya seçilmedi</div>
                    </div>
                    
                    <img id="photo-preview" class="photo-preview" src="#" alt="Önizleme">
                    
                    <div class="section-divider"></div>
                    
                    <h3>Profil Banner</h3>
                    <p class="form-hint">Özel bir banner resmi yükleyerek profilinizi kişiselleştirebilirsiniz.</p>
                    <div class="profile-photo-container">
                        <div class="file-upload">
                            <button type="button" class="upload-btn">
                                <i class="fas fa-upload"></i> Banner Seç
                            </button>
                            <input type="file" name="banner" id="banner-upload" accept="image/*">
                        </div>
                        <div class="selected-file" id="selected-banner-name">Dosya seçilmedi</div>
                    </div>
                    
                    <div class="banner-preview-container">
                        <img id="banner-preview" class="banner-preview" src="#" alt="Banner Önizleme">
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Fotoğrafları Kaydet</button>
                        <div class="btn-group secondary-actions">
                            @if(Auth::user()->photo)
                                <a href="/profile/photo/delete" class="btn btn-danger">Fotoğrafı Kaldır</a>
                            @endif
                            @if(Auth::user()->banner)
                                <a href="/profile/banner/delete" class="btn btn-danger">Banner Kaldır</a>
                            @endif
                        </div>
            </div>
        </form>
    </div>
            
            <!-- Son etkinlikler -->
            <div class="recent-activity">
                <h2>Son Etkinlikler</h2>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            Hesabınız oluşturuldu.
                            <span class="activity-date">{{ Auth::user()->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </li>
                    <!-- Daha sonra başka etkinlikler burada listelenebilir -->
                </ul>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dosya seçildiğinde önizleme göster
        const photoUpload = document.getElementById('photo-upload');
        const photoPreview = document.getElementById('photo-preview');
        const selectedFileName = document.getElementById('selected-file-name');
        
        // Banner seçildiğinde önizleme göster
        const bannerUpload = document.getElementById('banner-upload');
        const bannerPreview = document.getElementById('banner-preview');
        const selectedBannerName = document.getElementById('selected-banner-name');
        
        if (photoUpload) {
        photoUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                    const reader = new FileReader();
                
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                    selectedFileName.textContent = this.files[0].name;
                }
            });
        }
        
        if (bannerUpload) {
            bannerUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                
                    reader.onload = function(e) {
                        bannerPreview.src = e.target.result;
                        bannerPreview.style.display = 'block';
                        document.querySelector('.banner-preview-container').style.display = 'block';
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                    selectedBannerName.textContent = this.files[0].name;
                }
            });
        }
        
        // Sekme geçişi
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        const tabNavigation = document.querySelector('.tab-navigation');
        
        tabButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                // Tüm sekme butonlarından active sınıfını kaldır
                tabButtons.forEach(btn => btn.classList.remove('active'));
                
                // Tüm sekme içeriklerinden active sınıfını kaldır
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Tıklanan sekme butonuna active sınıfını ekle
                this.classList.add('active');
                
                // Tab navigasyon pozisyonunu ayarla
                tabNavigation.className = 'tab-navigation';
                if (index === 1) {
                    tabNavigation.classList.add('tab-2-active');
                } else if (index === 2) {
                    tabNavigation.classList.add('tab-3-active');
                }
                
                // İlgili sekme içeriğini göster
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });
</script>
@endsection 