@extends('layouts.app')

@section('title', $user->name . ' - Profil')

@section('styles')
<style>
    .profile-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }
    
    .profile-header {
        display: flex;
        gap: 30px;
        margin-bottom: 30px;
        position: relative;
        padding: 20px;
        border-radius: 12px;
        background-color: var(--secondary-dark);
        box-shadow: var(--shadow-soft);
    }
    
    .profile-banner {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
        border-radius: 12px 12px 0 0;
        background-color: var(--accent-dark);
        background-image: linear-gradient(45deg, #1a9fff22, #2c3e5022);
        overflow: hidden;
    }
    
    .profile-content {
        margin-top: 90px;
        position: relative;
        z-index: 1;
        display: flex;
        gap: 30px;
        width: 100%;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: var(--accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid var(--secondary-dark);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-avatar i {
        font-size: 40px;
        color: var(--text-gray);
    }
    
    .profile-info {
        flex: 1;
    }
    
    .profile-info h1 {
        font-size: 24px;
        margin: 0 0 5px 0;
        color: var(--text-light);
    }
    
    .profile-status {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        color: var(--text-gray);
        font-size: 14px;
    }
    
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    .status-online {
        background-color: #2ecc71;
    }
    
    .status-offline {
        background-color: #95a5a6;
    }
    
    .profile-stats {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }
    
    .profile-stat {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background-color: var(--accent-dark);
        color: var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-info {
        display: flex;
        flex-direction: column;
    }
    
    .stat-value {
        font-weight: 600;
        color: var(--text-light);
    }
    
    .stat-label {
        font-size: 12px;
        color: var(--text-gray);
    }
    
    .profile-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
    
    .action-button {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .primary-action {
        background-color: var(--accent-color);
        color: white;
    }
    
    .primary-action:hover {
        background-color: var(--accent-hover);
    }
    
    .secondary-action {
        background-color: var(--accent-dark);
        color: var(--text-gray);
    }
    
    .secondary-action:hover {
        background-color: #3a3a3a;
        color: var(--text-light);
    }
    
    .disabled-action {
        background-color: var(--accent-dark);
        color: var(--text-gray);
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    .profile-tabs {
        display: flex;
        gap: 2px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .profile-tab {
        padding: 12px 20px;
        cursor: pointer;
        color: var(--text-gray);
        position: relative;
        transition: all 0.2s;
    }
    
    .profile-tab.active {
        color: var(--text-light);
    }
    
    .profile-tab.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: var(--accent-color);
    }
    
    .profile-tab:hover {
        color: var(--text-light);
    }
    
    .tab-content {
        display: none;
        background-color: var(--secondary-dark);
        border-radius: 12px;
        padding: 20px;
    }
    
    .tab-content.active {
        display: block;
    }
    
    /* Games section */
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .game-card {
        border-radius: 8px;
        overflow: hidden;
        background-color: var(--accent-dark);
        transition: all 0.2s;
    }
    
    .game-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-soft);
    }
    
    .game-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    
    .game-details {
        padding: 10px;
    }
    
    .game-title {
        font-weight: 600;
        margin: 0 0 5px 0;
        color: var(--text-light);
        font-size: 14px;
    }
    
    .game-meta {
        display: flex;
        justify-content: space-between;
        color: var(--text-gray);
        font-size: 12px;
    }
    
    /* Badges section */
    .badges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
    }
    
    .badge-card {
        background-color: var(--accent-dark);
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        transition: all 0.2s;
    }
    
    .badge-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-soft);
    }
    
    .badge-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 10px;
        border-radius: 50%;
        background-color: var(--secondary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        font-size: 24px;
    }
    
    .badge-name {
        font-weight: 600;
        margin: 0 0 5px 0;
        color: var(--text-light);
        font-size: 14px;
    }
    
    .badge-description {
        color: var(--text-gray);
        font-size: 12px;
    }
    
    .section-title {
        margin-top: 0;
        font-size: 18px;
        color: var(--text-light);
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .view-all {
        font-size: 14px;
        color: var(--accent-color);
        text-decoration: none;
    }
    
    .view-all:hover {
        text-decoration: underline;
    }
    
    .empty-message {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-gray);
    }
    
    .empty-message i {
        font-size: 40px;
        margin-bottom: 15px;
        color: var(--accent-dark);
    }
    
    .empty-message p {
        margin: 5px 0 0 0;
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-banner" 
            @if($user->banner)
            style="background: url('{{ asset('images/banners/' . $user->banner) }}'); background-size: cover; background-position: center;"
            @endif
        ></div>
        
        <div class="profile-content">
            <div class="profile-avatar">
                @if($user->photo)
                    <img src="{{ asset('images/profiles/' . $user->photo) }}" alt="{{ $user->name }}">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            
            <div class="profile-info">
                <h1>{{ $user->name }}</h1>
                
                <div class="profile-status">
                    <span class="status-dot {{ $user->is_online ? 'status-online' : 'status-offline' }}"></span>
                    {{ $user->is_online ? 'Çevrimiçi' : 'Çevrimdışı' }}
                </div>
                
                <div class="profile-stats">
                    <div class="profile-stat">
                        <div class="stat-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $user->games()->count() }}</span>
                            <span class="stat-label">Oyun</span>
                        </div>
                    </div>
                    
                    <div class="profile-stat">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $user->friends()->count() }}</span>
                            <span class="stat-label">Arkadaş</span>
                        </div>
                    </div>
                    
                    <div class="profile-stat">
                        <div class="stat-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $user->badges()->count() }}</span>
                            <span class="stat-label">Rozet</span>
                        </div>
                    </div>
                    
                    <div class="profile-stat">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $user->level }}</span>
                            <span class="stat-label">Seviye</span>
                        </div>
                    </div>
                </div>
                
                @if(!$isCurrentUser)
                <div class="profile-actions">
                    @if($isFriend)
                        <a href="/messages/{{ $user->id }}" class="action-button primary-action">
                            <i class="fas fa-comment"></i> Mesaj Gönder
                        </a>
                        <button class="action-button secondary-action" onclick="window.location.href='/games/invite/{{ $user->id }}'">
                            <i class="fas fa-gamepad"></i> Oyuna Davet Et
                        </button>
                        <form action="{{ route('friends.remove', $user->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button secondary-action">
                                <i class="fas fa-user-minus"></i> Arkadaşlıktan Çıkar
                            </button>
                        </form>
                    @elseif($isPendingRequest)
                        <button class="action-button disabled-action" disabled>
                            <i class="fas fa-clock"></i> İstek Gönderildi
                        </button>
                    @elseif($isReceivedRequest)
                        <form action="{{ route('friends.accept', $user->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="action-button primary-action">
                                <i class="fas fa-check"></i> İsteği Kabul Et
                            </button>
                        </form>
                        <form action="{{ route('friends.reject', $user->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="action-button secondary-action">
                                <i class="fas fa-times"></i> İsteği Reddet
                            </button>
                        </form>
                    @else
                        <form action="{{ route('friends.request', $user->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="action-button primary-action">
                                <i class="fas fa-user-plus"></i> Arkadaş Ekle
                            </button>
                        </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="profile-tabs">
        <div class="profile-tab active" data-tab="games">Oyunlar</div>
        <div class="profile-tab" data-tab="badges">Rozetler</div>
        <div class="profile-tab" data-tab="activity">Aktiviteler</div>
    </div>
    
    <div class="tab-content active" id="games-tab">
        <h2 class="section-title">
            Oyun Kütüphanesi
            <a href="/library/{{ $user->id }}" class="view-all">Tümünü Gör</a>
        </h2>
        
        @if($userGames->count() > 0)
        <div class="games-grid">
            @foreach($userGames as $game)
            <div class="game-card">
                <a href="/game/{{ $game->id }}">
                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}" class="game-image">
                </a>
                <div class="game-details">
                    <h3 class="game-title">{{ $game->name }}</h3>
                    <div class="game-meta">
                        <span>{{ $game->genre }}</span>
                        <span>{{ $game->pivot->play_time ?? 0 }} saat</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-message">
            <i class="fas fa-gamepad"></i>
            <h3>Henüz Oyun Yok</h3>
            <p>Bu kullanıcının kütüphanesinde oyun bulunmuyor.</p>
        </div>
        @endif
    </div>
    
    <div class="tab-content" id="badges-tab">
        <h2 class="section-title">
            Rozetler
            <a href="/badges/{{ $user->id }}" class="view-all">Tümünü Gör</a>
        </h2>
        
        @if($userBadges->count() > 0)
        <div class="badges-grid">
            @foreach($userBadges as $badge)
            <div class="badge-card">
                <div class="badge-icon">
                    <i class="fas fa-{{ $badge->icon }}"></i>
                </div>
                <h3 class="badge-name">{{ $badge->name }}</h3>
                <p class="badge-description">{{ $badge->description }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-message">
            <i class="fas fa-award"></i>
            <h3>Henüz Rozet Yok</h3>
            <p>Bu kullanıcı henüz rozet kazanmamış.</p>
        </div>
        @endif
    </div>
    
    <div class="tab-content" id="activity-tab">
        <h2 class="section-title">Son Aktiviteler</h2>
        
        <div class="empty-message">
            <i class="fas fa-history"></i>
            <h3>Aktivite Bulunamadı</h3>
            <p>Bu kullanıcının son aktiviteleri görüntülenemiyor.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabs = document.querySelectorAll('.profile-tab');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show the corresponding tab content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').classList.add('active');
        });
    });
});
</script>
@endpush
@endsection 