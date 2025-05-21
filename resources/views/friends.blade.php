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

    .search-input {
        width: 100%;
        padding: 12px 16px;
        padding-right: 40px;
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

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-gray);
        pointer-events: none;
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
            <input type="text" class="search-input" placeholder="Arkadaş ara..." id="friendSearch">
            <i class="fas fa-search search-icon"></i>
            <div class="search-results" id="searchResults"></div>
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
                <div class="friend-header">
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
                    <button class="friend-action-btn" onclick="window.location.href='/messages/{{ $friend->id }}'">
                        <i class="fas fa-comment"></i>
                        Mesaj
                    </button>
                    <button class="friend-action-btn">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Friend search functionality
    const searchInput = document.getElementById('friendSearch');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;
    
    searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        const query = searchInput.value.trim();
        
        if (query.length < 2) {
            searchResults.classList.remove('active');
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetch(`/friends/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(users => {
                    searchResults.innerHTML = '';
                    
                    if (users.length === 0) {
                        searchResults.innerHTML = `
                            <div class="search-result-item">
                                <div class="search-info">
                                    <p>Kullanıcı bulunamadı</p>
                                </div>
                            </div>
                        `;
                    } else {
                        users.forEach(user => {
                            const item = document.createElement('div');
                            item.className = 'search-result-item';
                            item.innerHTML = `
                                <img src="${user.photo ? '/storage/' + user.photo : '/images/default-avatar.png'}" 
                                     alt="${user.name}" 
                                     class="search-avatar">
                                <div class="search-info">
                                    <h4>${user.name}</h4>
                                    <p>Seviye ${user.level}</p>
                                </div>
                                <form action="/friends/request/${user.id}" method="POST" style="margin-left: auto;">
                                    @csrf
                                    <button type="submit" class="friend-action-btn">
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                </form>
                            `;
                            searchResults.appendChild(item);
                        });
                    }
                    
                    searchResults.classList.add('active');
                });
        }, 300);
    });
    
    // Close search results when clicking outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.remove('active');
        }
    });
});
</script>
@endpush
@endsection 