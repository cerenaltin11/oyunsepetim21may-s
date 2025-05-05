@extends('layouts.app')

@section('title', 'Profilim - Rozetler')

@section('styles')
<style>
    /* Special styling for users with ultimate badge */
    .ultimate-user .profile-banner::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05), rgba(255, 215, 0, 0));
        z-index: 1;
    }
    
    .ultimate-user .profile-header {
        border-bottom: 1px solid rgba(255, 215, 0, 0.3);
    }
    
    .ultimate-user .profile-info h1 {
        color: #FFD700;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
    }
    
    .ultimate-user .profile-photo {
        border: 4px solid #FFD700;
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
    }
    
    /* Badge styling */
    .badges-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .badge-card {
        background: linear-gradient(145deg, rgba(30, 30, 30, 0.8), rgba(20, 20, 20, 0.9));
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .badge-card.new-badge {
        background: linear-gradient(145deg, rgba(10, 40, 70, 0.8), rgba(20, 20, 20, 0.9));
        box-shadow: 0 10px 25px rgba(26, 159, 255, 0.2);
        animation: highlight-pulse 2s infinite;
    }
    
    .badge-card.locked-badge {
        background: linear-gradient(145deg, rgba(40, 40, 40, 0.4), rgba(20, 20, 20, 0.5));
        opacity: 0.7;
        filter: grayscale(0.8);
    }
    
    /* Ultimate badge styling */
    .badge-card.ultimate-badge {
        background: linear-gradient(145deg, rgba(80, 60, 0, 0.8), rgba(20, 20, 20, 0.9));
        box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3);
        animation: gold-pulse 3s infinite;
    }
    
    .badge-card.ultimate-badge::before {
        background: linear-gradient(to right, #FFD700, #FFA500);
    }
    
    .badge-card.ultimate-badge .badge-icon {
        background: rgba(255, 215, 0, 0.1);
        color: #FFD700;
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
    }
    
    /* Admin badge styling */
    .badge-card.admin-badge {
        background: linear-gradient(145deg, rgba(80, 0, 0, 0.8), rgba(20, 20, 20, 0.9));
        box-shadow: 0 10px 25px rgba(255, 0, 0, 0.2);
    }
    
    .badge-card.admin-badge::before {
        background: linear-gradient(to right, #FF0000, #AA0000);
    }
    
    .badge-card.admin-badge .badge-icon {
        background: rgba(255, 0, 0, 0.1);
        color: #FF0000;
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
    }
    
    @keyframes highlight-pulse {
        0% { box-shadow: 0 10px 25px rgba(26, 159, 255, 0.2); }
        50% { box-shadow: 0 10px 25px rgba(26, 159, 255, 0.5); }
        100% { box-shadow: 0 10px 25px rgba(26, 159, 255, 0.2); }
    }
    
    @keyframes gold-pulse {
        0% { box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3); }
        50% { box-shadow: 0 10px 25px rgba(255, 215, 0, 0.6); }
        100% { box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3); }
    }
    
    @keyframes red-pulse {
        0% { box-shadow: 0 10px 25px rgba(255, 0, 0, 0.2); }
        50% { box-shadow: 0 10px 25px rgba(255, 0, 0, 0.5); }
        100% { box-shadow: 0 10px 25px rgba(255, 0, 0, 0.2); }
    }
    
    .badge-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #1a9fff, #60efff);
    }
    
    .badge-card.locked-badge::before {
        background: linear-gradient(to right, #666, #999);
    }
    
    .badge-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(26, 159, 255, 0.1);
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #1a9fff;
        box-shadow: 0 0 15px rgba(26, 159, 255, 0.3);
        position: relative;
    }
    
    .badge-card.locked-badge .badge-icon {
        background: rgba(100, 100, 100, 0.1);
        color: #777;
        box-shadow: 0 0 15px rgba(100, 100, 100, 0.2);
    }
    
    .badge-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-light);
    }
    
    .badge-card.locked-badge .badge-name {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .badge-description {
        color: var(--text-gray);
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .badge-card.locked-badge .badge-description {
        color: rgba(200, 200, 200, 0.5);
    }
    
    .badge-date {
        margin-top: 1rem;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.4);
    }
    
    .empty-badges {
        text-align: center;
        padding: 3rem 0;
        color: var(--text-gray);
    }
    
    .empty-badges i {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.1);
        margin-bottom: 1rem;
        display: block;
    }
    
    .profile-badges-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    
    .profile-badges-title {
        margin: 0;
        font-size: 1.8rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .profile-badges-title i {
        color: #1a9fff;
    }
    
    .ultimate-user .profile-badges-title i {
        color: #FFD700;
    }
    
    .badge-count {
        background-color: rgba(26, 159, 255, 0.1);
        color: #1a9fff;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .ultimate-user .badge-count {
        background-color: rgba(255, 215, 0, 0.1);
        color: #FFD700;
    }
    
    .new-badge-label {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #1a9fff;
        color: #fff;
        padding: 0.3rem 0.8rem;
        border-radius: 0 0 0 8px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 5;
    }
    
    .ultimate-badge-label {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #FFD700;
        color: #000;
        padding: 0.3rem 0.8rem;
        border-radius: 0 0 0 8px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 5;
    }
    
    .admin-badge-label {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #FF0000;
        color: #fff;
        padding: 0.3rem 0.8rem;
        border-radius: 0 0 0 8px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 5;
    }
    
    .locked-badge-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.8);
        z-index: 10;
    }
    
    .locked-badge-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
    }
    
    .badge-requirement {
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
        font-style: italic;
    }
    
    .badge-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }
    
    .badge-card.ultimate-badge:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 215, 0, 0.4);
    }
    
    .badge-card.admin-badge:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 0, 0, 0.3);
    }
    
    /* Admin animation for profile page */
    @keyframes admin-glow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .admin-profile-container {
        position: relative;
    }
    
    .admin-profile-container::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(45deg, #600, #900, #a00, #900, #600);
        background-size: 400% 400%;
        z-index: -1;
        border-radius: 20px;
        filter: blur(15px);
        opacity: 0.3;
        animation: admin-glow 10s ease infinite;
    }
    
    .admin-entrance-animation {
        animation: admin-entrance 1s ease-out forwards;
    }
    
    @keyframes admin-entrance {
        0% {
            transform: scale(0.9);
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
    
    .admin-badge-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(150, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 70%);
        pointer-events: none;
        z-index: -1;
        opacity: 0;
        animation: admin-badge-fade 2s ease-in forwards;
    }
    
    @keyframes admin-badge-fade {
        0% {
            opacity: 0;
        }
        50% {
            opacity: 0.8;
        }
        100% {
            opacity: 0.3;
        }
    }
</style>
@endsection

@section('content')
@if(Auth::user()->is_admin)
<div class="admin-badge-animation"></div>
@endif

<div class="profile-container {{ Auth::user()->hasUltimateBadge() ? 'ultimate-user' : '' }} {{ Auth::user()->is_admin ? 'admin-profile-container admin-entrance-animation' : '' }}">
    <div class="profile-banner" 
        @if(Auth::user()->banner)
        style="background: url('{{ asset('images/banners/' . Auth::user()->banner) }}'); background-size: cover; background-position: center;"
        @endif
    >
        @if(Auth::user()->hasUltimateBadge())
        <div class="ultimate-badge-indicator" style="position: absolute; top: 10px; right: 10px; background: rgba(255, 215, 0, 0.2); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-crown" style="color: #FFD700; font-size: 20px;"></i>
        </div>
        @endif
        
        @if(Auth::user()->is_admin)
        <div class="admin-badge-indicator" style="position: absolute; top: 10px; right: {{ Auth::user()->hasUltimateBadge() ? '60px' : '10px' }}; background: rgba(150, 0, 0, 0.3); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; animation: admin-pulse 2s infinite;">
            <i class="fas fa-shield-alt" style="color: #ff3333; font-size: 20px;"></i>
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
            <h1>{{ Auth::user()->name }}</h1>
            <p>{{ Auth::user()->email }}</p>
            @if(Auth::user()->hasUltimateBadge())
            <div style="margin-top: 5px; color: #FFD700;">
                <i class="fas fa-crown"></i> Nihai Kullanıcı
            </div>
            @endif
            @if(Auth::user()->is_admin)
            <div style="margin-top: 5px; color: #ff3333;">
                <i class="fas fa-shield-alt"></i> Yönetici
            </div>
            @endif
        </div>
    </div>
    
    <div class="dashboard-content">
        <div class="profile-badges-header">
            <h2 class="profile-badges-title"><i class="fas fa-award"></i> Rozetlerim</h2>
            <span class="badge-count">{{ $badges->count() }}/{{ $allBadges->count() }} Rozet</span>
        </div>
        
        <div class="badges-container">
            @foreach($allBadges as $badge)
                @php
                    $earned = $badges->contains('id', $badge->id);
                    $earnedBadge = $earned ? $badges->where('id', $badge->id)->first() : null;
                    $isNew = $earned && \Carbon\Carbon::parse($earnedBadge->pivot->awarded_at)->isToday();
                    $isUltimate = $badge->name == 'ultimate_login';
                    $isAdmin = $badge->name == 'admin_badge';
                @endphp
                
                <div class="badge-card 
                    {{ $isNew ? 'new-badge' : '' }} 
                    {{ !$earned ? 'locked-badge' : '' }}
                    {{ $earned && $isUltimate ? 'ultimate-badge' : '' }}
                    {{ $earned && $isAdmin ? 'admin-badge' : '' }}">
                    
                    @if($isNew)
                        <div class="new-badge-label">Yeni</div>
                    @elseif($earned && $isUltimate)
                        <div class="ultimate-badge-label">Nihai</div>
                    @elseif($earned && $isAdmin)
                        <div class="admin-badge-label">Yönetici</div>
                    @endif
                    
                    <div class="badge-icon">
                        <i class="fas {{ $badge->icon }}"></i>
                        @if(!$earned)
                            <div class="locked-badge-overlay">
                                <i class="fas fa-lock locked-badge-icon"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="badge-name">{{ $badge->description }}</h3>
                    
                    @if($earned)
                        <p class="badge-description">
                            @if($badge->type == 'login')
                                Giriş yaparak kazandınız
                            @elseif($badge->type == 'purchase')
                                Satın alarak kazandınız
                            @elseif($isAdmin)
                                Site yöneticisi olarak kazandınız
                            @else
                                Başarı kazandınız
                            @endif
                        </p>
                        <div class="badge-date">
                            {{ \Carbon\Carbon::parse($earnedBadge->pivot->awarded_at)->format('d.m.Y') }} tarihinde kazanıldı
                        </div>
                    @else
                        <p class="badge-description">
                            @if($badge->type == 'login')
                                Giriş yaparak kazanabilirsiniz
                            @elseif($badge->type == 'purchase')
                                Satın alarak kazanabilirsiniz
                            @elseif($isAdmin)
                                Yönetici olunca kazanabilirsiniz
                            @else
                                Başarı kazanabilirsiniz
                            @endif
                        </p>
                        <div class="badge-requirement">
                            @if($badge->type == 'login')
                                @if($badge->required_count == 1)
                                    İlk kez giriş yaparak kazanabilirsiniz
                                @elseif($badge->name == 'three_day_streak')
                                    3 gün üst üste giriş yapın
                                @elseif($badge->name == 'week_streak')
                                    7 gün üst üste giriş yapın
                                @elseif($badge->name == 'month_streak')
                                    30 gün üst üste giriş yapın
                                @elseif($badge->name == 'ultimate_login')
                                    365 kez giriş yapın
                                @elseif(strpos($badge->name, '_logins') !== false)
                                    {{ $badge->required_count }} kez giriş yapın
                                @endif
                            @elseif($badge->type == 'purchase')
                                İlk satın alma ile kazanılır
                            @elseif($isAdmin)
                                Sadece site yöneticilerine verilir
                            @else
                                Site aktiviteleri ile kazanılır
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 