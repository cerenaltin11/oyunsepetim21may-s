@extends('layouts.app')

@section('title', 'Arkadaşlarım')

@section('styles')
<style>
    :root {
        --primary-dark: #121212;
        --secondary-dark: #1e1e1e;
        --accent-dark: #2a2a2a;
        --text-light: #f1f1f1;
        --text-gray: #a0a0a0;
        --accent-color: #1a9fff;
        --accent-hover: #0d8bf0;
        --bg-card: rgba(30, 30, 30, 0.8);
        --bg-hover: rgba(42, 42, 42, 0.5);
        --border-color: rgba(255, 255, 255, 0.05);
        --shadow-soft: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-strong: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Tab links styling */
    .tab-links {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 8px;
        cursor: pointer;
    }
    
    .tab-links a {
        padding: 8px 16px;
        color: var(--text-gray);
        font-size: 0.95rem;
        text-decoration: none;
        position: relative;
        transition: color 0.3s;
    }
    
    .tab-links a::after {
        content: '';
        position: absolute;
        bottom: -9px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--accent-color);
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    
    .tab-links a.active {
        color: var(--text-light);
    }
    
    .tab-links a.active::after {
        transform: scaleX(1);
    }
    
    .tab-links a:hover {
        color: var(--text-light);
    }

    .friends-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .friends-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .friends-title {
        color: var(--text-light);
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .search-container {
        position: relative;
        width: 300px;
    }

    /* Search form styling */
    .search-form {
        display: flex;
        width: 100%;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px;
        padding-right: 50px;
        background: var(--accent-dark);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-light);
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2);
    }

    /* Style for the search button */
    .search-button {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        background: transparent;
        border: none;
        color: var(--text-gray);
        padding: 0 15px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .search-button:hover {
        color: var(--accent-color);
    }
    
    .search-button:focus {
        outline: none;
    }
    
    .search-button i {
        font-size: 16px;
    }

    .friends-tabs {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 8px;
    }

    .tab-button {
        padding: 8px 16px;
        background: none;
        border: none;
        color: var(--text-gray);
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .tab-button::after {
        content: '';
        position: absolute;
        bottom: -9px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--accent-color);
        transform: scaleX(0);
        transition: transform 0.3s;
    }

    .tab-button.active {
        color: var(--text-light);
    }

    .tab-button.active::after {
        transform: scaleX(1);
    }

    .tab-button:hover {
        color: var(--text-light);
    }

    .friends-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .friend-card {
        background: var(--bg-card);
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .friend-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-strong);
    }

    .friend-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }

    .friend-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
    }

    .friend-avatar-placeholder {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: var(--accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        font-size: 24px;
        font-weight: 600;
    }

    .friend-info h3 {
        color: var(--text-light);
        font-size: 1.2rem;
        margin: 0 0 4px;
    }

    .friend-status {
        color: var(--text-gray);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .status-online {
        background: #2ecc71;
    }

    .status-offline {
        background: #95a5a6;
    }

    .friend-stats {
        display: flex;
        gap: 16px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border-color);
    }

    .friend-stat {
        flex: 1;
        text-align: center;
    }

    .stat-value {
        color: var(--accent-color);
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 0.85rem;
    }

    .friend-actions {
        display: flex;
        gap: 8px;
        margin-top: 16px;
    }

    .friend-action-btn {
        flex: 1;
        padding: 8px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        background: var(--accent-dark);
        color: var(--text-gray);
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .friend-action-btn:hover {
        background: var(--accent-color);
        color: var(--text-light);
    }

    .friend-action-btn.danger:hover {
        background: #e74c3c;
        border-color: #c0392b;
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-top: 8px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
    }

    .search-results.active {
        display: block;
    }

    .search-result-item {
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .search-result-item:hover {
        background: var(--bg-hover);
    }

    .search-result-item:not(:last-child) {
        border-bottom: 1px solid var(--border-color);
    }

    .search-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .search-info h4 {
        color: var(--text-light);
        margin: 0 0 4px;
        font-size: 0.95rem;
    }

    .search-info p {
        color: var(--text-gray);
        margin: 0;
        font-size: 0.85rem;
    }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
        background: var(--bg-card);
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 16px;
    }

    .empty-state h3 {
        color: var(--text-light);
        font-size: 1.5rem;
        margin: 0 0 8px;
    }

    .empty-state p {
        color: var(--text-gray);
        margin: 0;
        max-width: 400px;
        margin: 0 auto;
    }
    
    /* Notification animations */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    /* Notification styling */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        font-size: 14px;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 300px;
        animation: slideIn 0.3s ease-out;
    }
    
    .notification.success {
        background-color: rgba(46, 204, 113, 0.9);
    }
    
    .notification.error {
        background-color: rgba(231, 76, 60, 0.9);
    }
    
    .notification.info {
        background-color: rgba(52, 152, 219, 0.9);
    }
    
    @keyframes slideIn {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    
    /* Loading indicator */
    .search-loading {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    
    .search-loading .spinner {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 3px solid rgba(26, 159, 255, 0.3);
        border-top-color: var(--accent-color);
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .friends-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }

        .search-container {
            width: 100%;
        }

        .friends-grid {
            grid-template-columns: 1fr;
        }

        .friends-tabs {
            overflow-x: auto;
            padding-bottom: 16px;
            margin-bottom: 16px;
        }

        .tab-button {
            white-space: nowrap;
        }
    }
</style>
@endsection

@section('content')
<script type="text/javascript">
// Define activateTab in the global scope
window.activateTab = function(tabId) {
    // Hide all tab contents
    var tabContents = document.getElementsByClassName('tab-content');
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = 'none';
    }
    
    // Show the selected tab content
    var selectedTab = document.getElementById(tabId + 'Tab');
    if (selectedTab) {
        selectedTab.style.display = 'block';
    }
    
    // Remove active class from all tab links
    var tabLinks = document.getElementsByClassName('tab-link');
    for (var i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove('active');
    }
    
    // Add active class to the selected tab link
    var activeLink = document.getElementById(tabId + 'Link');
    if (activeLink) {
        activeLink.classList.add('active');
    }
}
</script>

<div class="friends-container">
    <div class="friends-header">
        <h1 class="friends-title">Arkadaşlarım</h1>
        <div class="search-container">
            <!-- Enhanced search form -->
            <div class="search-form">
                <input type="text" class="search-input" placeholder="Arkadaş ara..." id="friendSearchInput" autocomplete="off">
                <button type="button" class="search-button" id="friendSearchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="search-results" id="friendSearchResults" style="max-height: 400px; overflow-y: auto;"></div>
        </div>
    </div>

    <!-- The tab links visible in the screenshot -->
    <div class="tab-links">
        <a id="friendsLink" class="tab-link active" href="javascript:void(0);" onclick="activateTab('friends')">Arkadaşlarım ({{ count($friends) }})</a>
        <a id="requestsLink" class="tab-link" href="javascript:void(0);" onclick="activateTab('requests')">Gelen İstekler ({{ count($pendingRequests) }})</a>
        <a id="sentLink" class="tab-link" href="javascript:void(0);" onclick="activateTab('sent')">Gönderilen İstekler ({{ count($sentRequests) }})</a>
    </div>
    
    <!-- Arkadaşlar Tab -->
    <div class="tab-content" id="friendsTab" style="display: block;">
        @if(count($friends) > 0)
        <div class="friends-grid">
            @foreach($friends as $friend)
            <div class="friend-card">
                <div class="friend-header" onclick="window.location.href='/profile/{{ $friend->id }}'" style="cursor: pointer;">
                    @if($friend->photo)
                    <img src="{{ asset('storage/' . $friend->photo) }}" alt="{{ $friend->name }}" class="friend-avatar">
                    @else
                    <div class="friend-avatar-placeholder">
                        {{ strtoupper(substr($friend->name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="friend-info">
                        <h3>{{ $friend->name }}</h3>
                        <div class="friend-status">
                            <span class="status-indicator {{ $friend->is_online ? 'status-online' : 'status-offline' }}"></span>
                            {{ $friend->is_online ? 'Çevrimiçi' : 'Çevrimdışı' }}
                        </div>
                    </div>
                </div>

                <div class="friend-stats">
                    <div class="friend-stat">
                        <div class="stat-value">{{ $friend->level }}</div>
                        <div class="stat-label">Seviye</div>
                    </div>
                    <div class="friend-stat">
                        <div class="stat-value">{{ $friend->library()->count() }}</div>
                        <div class="stat-label">Oyun</div>
                    </div>
                    <div class="friend-stat">
                        <div class="stat-value">{{ $friend->badges()->count() }}</div>
                        <div class="stat-label">Rozet</div>
                    </div>
                </div>

                <div class="friend-actions">
                    <a href="/messages/{{ $friend->id }}" class="friend-action-btn">
                        <i class="fas fa-comment"></i>
                        Mesaj
                    </a>
                    <button class="friend-action-btn" onclick="window.location.href='/games/invite/{{ $friend->id }}'">
                        <i class="fas fa-gamepad"></i>
                        Oyuna Davet Et
                    </button>
                    <form action="{{ route('friends.remove', $friend->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="friend-action-btn danger" style="width: 100%;">
                            <i class="fas fa-user-minus"></i>
                            Çıkar
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-user-friends"></i>
            <h3>Henüz Arkadaşınız Yok</h3>
            <p>Yeni arkadaşlar ekleyerek oyun deneyiminizi paylaşın!</p>
        </div>
        @endif
    </div>

    <!-- Gelen İstekler Tab -->
    <div class="tab-content" id="requestsTab" style="display: none;">
        @if(count($pendingRequests) > 0)
        <div class="friends-grid">
            @foreach($pendingRequests as $request)
            <div class="friend-card">
                <div class="friend-header">
                    @if($request->photo)
                    <img src="{{ asset('storage/' . $request->photo) }}" alt="{{ $request->name }}" class="friend-avatar">
                    @else
                    <div class="friend-avatar-placeholder">
                        {{ strtoupper(substr($request->name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="friend-info">
                        <h3>{{ $request->name }}</h3>
                        <div class="friend-status">
                            <span class="status-indicator {{ $request->is_online ? 'status-online' : 'status-offline' }}"></span>
                            {{ $request->is_online ? 'Çevrimiçi' : 'Çevrimdışı' }}
                        </div>
                    </div>
                </div>

                <div class="friend-actions">
                    <form action="{{ route('friends.accept', $request->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        <button type="submit" class="friend-action-btn" style="width: 100%;">
                            <i class="fas fa-check"></i>
                            Kabul Et
                        </button>
                    </form>
                    <form action="{{ route('friends.reject', $request->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        <button type="submit" class="friend-action-btn danger" style="width: 100%;">
                            <i class="fas fa-times"></i>
                            Reddet
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Bekleyen İstek Yok</h3>
            <p>Şu anda bekleyen arkadaşlık isteğiniz bulunmuyor.</p>
        </div>
        @endif
    </div>

    <!-- Gönderilen İstekler Tab -->
    <div class="tab-content" id="sentTab" style="display: none;">
        @if(count($sentRequests) > 0)
        <div class="friends-grid">
            @foreach($sentRequests as $request)
            <div class="friend-card">
                <div class="friend-header">
                    @if($request->photo)
                    <img src="{{ asset('storage/' . $request->photo) }}" alt="{{ $request->name }}" class="friend-avatar">
                    @else
                    <div class="friend-avatar-placeholder">
                        {{ strtoupper(substr($request->name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="friend-info">
                        <h3>{{ $request->name }}</h3>
                        <div class="friend-status">
                            <span class="status-indicator {{ $request->is_online ? 'status-online' : 'status-offline' }}"></span>
                            {{ $request->is_online ? 'Çevrimiçi' : 'Çevrimdışı' }}
                        </div>
                    </div>
                </div>

                <div class="friend-actions">
                    <form action="{{ route('friends.reject', $request->id) }}" method="POST" style="width: 100%;">
                        @csrf
                        <button type="submit" class="friend-action-btn danger" style="width: 100%;">
                            <i class="fas fa-times"></i>
                            İsteği İptal Et
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-paper-plane"></i>
            <h3>Gönderilen İstek Yok</h3>
            <p>Şu anda gönderdiğiniz bekleyen arkadaşlık isteği bulunmuyor.</p>
        </div>
        @endif
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Arkadaş arama sistemi başlatılıyor...');
    
    // Get our elements
    const searchInput = document.getElementById('friendSearchInput');
    const searchButton = document.getElementById('friendSearchButton');
    const searchResults = document.getElementById('friendSearchResults');
    
    if (!searchInput || !searchButton || !searchResults) {
        console.error('❌ Arama elementleri bulunamadı!');
        return;
    }
    
    console.log('✅ Arama elementleri bulundu');
    
    // Enhanced search function
    function doSearch() {
        const query = searchInput.value.trim();
        console.log('🔍 Arama başlatıldı:', query);
        
        if (query.length < 2) {
            searchResults.innerHTML = '<div style="padding: 15px; text-align: center; color: #e67e22;">Lütfen en az 2 karakter girin</div>';
            searchResults.style.display = 'block';
            return;
        }
        
        // Show loading
        searchResults.innerHTML = '<div style="padding: 20px; text-align: center;"><i class="fas fa-spinner fa-spin"></i> Aranıyor...</div>';
        searchResults.style.display = 'block';
        
        fetch('/friends/search?query=' + encodeURIComponent(query))
            .then(response => {
                console.log('📡 Response alındı:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status} - ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('📊 Arama sonuçları:', data);
                renderSearchResults(data);
            })
            .catch(error => {
                console.error('❌ Arama hatası:', error);
                searchResults.innerHTML = `<div style="padding: 20px; text-align: center; color: #e74c3c;">Arama hatası: ${error.message}</div>`;
            });
    }
    
    // Render search results
    function renderSearchResults(data) {
        let html = '';
        
        if (data.users && data.users.length > 0) {
            data.users.forEach(user => {
                const avatar = user.photo 
                    ? `<img src="/storage/${user.photo}" alt="${user.name}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">` 
                    : `<div style="width: 48px; height: 48px; border-radius: 50%; background: #1a9fff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">${user.name.charAt(0).toUpperCase()}</div>`;
                    
                html += `
                    <div style="padding: 15px; border-bottom: 1px solid #333; display: flex; align-items: center; background: #2a2a2a; margin: 5px 0;">
                        <div onclick="window.location.href='/profile/${user.id}'" style="cursor: pointer; display: flex; align-items: center; flex-grow: 1;">
                            <div style="margin-right: 15px;">${avatar}</div>
                            <div>
                                <div style="font-weight: bold; color: #fff; font-size: 16px;">${user.name}</div>
                                <div style="color: #aaa; font-size: 13px;">Kullanıcı ID: ${user.id}</div>
                            </div>
                        </div>
                        <button onclick="sendFriendRequest(${user.id}, this)" style="padding: 8px 12px; background: #1a9fff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            <i class="fas fa-user-plus"></i> Ekle
                        </button>
                    </div>
                `;
            });
        } else {
            html = '<div style="padding: 20px; text-align: center; color: #aaa;">Kullanıcı bulunamadı</div>';
        }
        
        // Add excluded users if any
        if (data.excluded_info && data.excluded_info.length > 0) {
            html += `
                <div style="margin-top: 15px; padding: 15px; background: rgba(30, 30, 30, 0.7); border-radius: 8px;">
                    <h4 style="margin: 0 0 10px; color: #aaa;">Bulunan diğer kullanıcılar:</h4>
            `;
            
            data.excluded_info.forEach(info => {
                const avatar = info.user.photo 
                    ? `<img src="/storage/${info.user.photo}" alt="${info.user.name}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">` 
                    : `<div style="width: 36px; height: 36px; border-radius: 50%; background: #1a9fff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">${info.user.name.charAt(0).toUpperCase()}</div>`;
                
                let actionButton = '';
                if (info.reason === 'sent_request') {
                    actionButton = '<span style="color: #2980b9; font-size: 12px;">✉️ Gönderildi</span>';
                } else if (info.reason === 'received_request') {
                    actionButton = '<span style="color: #27ae60; font-size: 12px;">📥 Size istek gönderdi</span>';
                } else if (info.reason === 'friend') {
                    actionButton = '<span style="color: #2ecc71; font-size: 12px;">✅ Arkadaş</span>';
                }
                
                html += `
                    <div style="margin-bottom: 10px; padding: 10px; display: flex; align-items: center; border-radius: 6px; background: rgba(40, 40, 40, 0.4);">
                        <div onclick="window.location.href='/profile/${info.user.id}'" style="cursor: pointer; display: flex; align-items: center; flex-grow: 1;">
                            <div style="margin-right: 10px;">${avatar}</div>
                            <div>
                                <span style="font-weight: bold; color: #ddd;">${info.user.name}</span>
                                <span style="display: block; font-size: 12px; color: #e67e22;">${info.message}</span>
                            </div>
                        </div>
                        ${actionButton}
                    </div>
                `;
            });
            
            html += '</div>';
        }
        
        searchResults.innerHTML = html;
        console.log('✅ Sonuçlar görüntülendi');
    }
    
    // Friend request function
    window.sendFriendRequest = function(userId, button) {
        console.log('📤 Arkadaşlık isteği gönderiliyor:', userId);
        
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
        
        // Get CSRF token
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const token = csrfMeta ? csrfMeta.getAttribute('content') : document.querySelector('input[name="_token"]').value;
        
        const formData = new FormData();
        formData.append('_token', token);
        
        fetch('/friends/request/' + userId, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('📡 Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status} - ${response.statusText}`);
            }
            
            return response.text();
        })
        .then(text => {
            console.log('📋 Raw response:', text);
            
            try {
                const data = JSON.parse(text);
                console.log('✅ JSON parse başarılı:', data);
                
                if (data.status === 'success') {
                    button.innerHTML = '<i class="fas fa-check"></i> Gönderildi';
                    button.style.background = '#2ecc71';
                    
                    // Show success notification
                    showNotification('✅ Arkadaşlık isteği gönderildi!', 'success');
                    
                    // Refresh search after 2 seconds
                    setTimeout(() => doSearch(), 2000);
                } else {
                    throw new Error(data.message || 'Bilinmeyen hata');
                }
            } catch (parseError) {
                console.error('❌ JSON parse hatası:', parseError);
                console.log('📄 Response HTML olarak alındı:', text.substring(0, 200));
                
                button.innerHTML = '<i class="fas fa-times"></i> Hata';
                button.style.background = '#e74c3c';
                
                showNotification('❌ Sunucu hatası (JSON beklendi, HTML alındı)', 'error');
            }
        })
        .catch(error => {
            console.error('❌ Network hatası:', error);
            button.innerHTML = '<i class="fas fa-times"></i> Hata';
            button.style.background = '#e74c3c';
            
            showNotification('❌ Ağ hatası: ' + error.message, 'error');
            
            // Re-enable button after 3 seconds
            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-user-plus"></i> Ekle';
                button.style.background = '#1a9fff';
            }, 3000);
        });
    };
    
    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#2ecc71' : type === 'error' ? '#e74c3c' : '#3498db'};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            z-index: 10000;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease;
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }
    
    // Event listeners
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('🔍 Search button clicked');
        doSearch();
    });
    
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            console.log('⌨️ Enter key pressed');
            doSearch();
        }
    });
    
    // Auto search as user types (with delay)
    let typingTimer;
    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        
        const query = this.value.trim();
        if (query.length >= 2) {
            typingTimer = setTimeout(() => doSearch(), 500);
        } else if (query.length === 0) {
            searchResults.style.display = 'none';
        }
    });
    
    // Close results when clicking outside
    document.addEventListener('click', function(e) {
        if (!document.querySelector('.search-container').contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
    
    // Tab switching functionality
    window.activateTab = function(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.style.display = 'none';
        });
        
        // Show selected tab
        const selectedTab = document.getElementById(tabId + 'Tab');
        if (selectedTab) {
            selectedTab.style.display = 'block';
        }
        
        // Update active tab link
        document.querySelectorAll('.tab-link').forEach(link => {
            link.classList.remove('active');
        });
        
        const activeLink = document.getElementById(tabId + 'Link');
        if (activeLink) {
            activeLink.classList.add('active');
        }
    };
    
    // Initialize friends tab
    window.activateTab('friends');
    
    console.log('🎉 Arkadaş arama sistemi başarıyla yüklendi!');
});
</script>
@endsection 