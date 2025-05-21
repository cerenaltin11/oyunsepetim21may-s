@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', 'Kütüphanem')

@section('styles')
<style>
    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        max-width: 100%;
    }
    
    /* Scrollbar gizleme */
    ::-webkit-scrollbar {
        width: 0;
        background: transparent;
        display: none;
    }
    
    * {
        -ms-overflow-style: none;  /* IE ve Edge */
        scrollbar-width: none;  /* Firefox */
        box-sizing: border-box;
    }
    
    .library-container {
        padding: 0;
        max-width: 100%;
        width: 100%;
        margin: 0;
        overflow: hidden;
        position: relative;
    }
    
    .library-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.2rem;
        padding: 0 1.5rem;
    }
    
    .library-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    
    .library-subtitle {
        color: var(--text-gray);
        margin-bottom: 0.4rem;
        font-size: 1.1rem;
    }
    
    /* Yeni iki kolonlu layout */
    .library-layout {
        display: flex;
        gap: 0;
        height: calc(100vh - 180px);
        overflow: hidden;
        border-right: none;
        width: 100%;
        max-width: 100%;
    }
    
    /* Sol taraftaki oyun listesi */
    .game-list-sidebar {
        width: 280px;
        flex-shrink: 0;
        background-color: var(--primary-dark);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        border-right: 1px solid var(--accent-dark);
    }
    
    /* Liste filtre başlığı */
    .list-header {
        padding: 12px 14px;
        border-bottom: 1px solid var(--accent-dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .list-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .list-title .count {
        color: var(--text-gray);
        font-weight: normal;
        font-size: 0.9rem;
    }
    
    .list-search {
        padding: 10px 12px;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .list-search input {
        width: 100%;
        background-color: var(--secondary-dark);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 6px 10px;
        border-radius: 4px;
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    .list-search input:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    
    /* Oyun listesi */
    .games-list-container {
        overflow-y: auto;
        flex-grow: 1;
    }
    
    .games-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .game-list-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        cursor: pointer;
        transition: background 0.2s;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
    }
    
    .game-list-item a {
        color: inherit;
    }
    
    .game-list-item:hover, .game-list-item.active {
        background-color: var(--accent-dark);
    }
    
    .game-list-item.active {
        border-left: 3px solid var(--accent-color);
    }
    
    .game-list-icon {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        overflow: hidden;
        margin-right: 10px;
        flex-shrink: 0;
    }
    
    .game-list-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .game-list-name {
        font-size: 0.95rem;
        color: var(--text-light);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .game-list-item:hover .game-list-name {
        color: white;
    }
    
    /* Sağ taraftaki oyun grid görünümü */
    .game-grid-container {
        flex-grow: 1;
        padding: 15px;
        overflow-y: auto;
        height: 100%;
        border-right: none;
        width: calc(100% - 280px);
        max-width: calc(100% - 280px);
    }
    
    .library-filters {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        background-color: var(--secondary-dark);
        color: var(--text-light);
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .filter-btn:hover, .filter-btn.active {
        background-color: var(--accent-color);
    }
    
    .filter-btn i {
        font-size: 0.9rem;
    }
    
    .sort-dropdown {
        background-color: var(--secondary-dark);
        color: var(--text-light);
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.95rem;
    }
    
    .library-search {
        position: relative;
        width: 100%;
        max-width: 300px;
        margin-left: auto;
    }
    
    .search-input {
        width: 100%;
        background-color: var(--secondary-dark);
        border: 1px solid var(--accent-dark);
        color: var(--text-light);
        padding: 8px 12px 8px 36px;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2);
    }
    
    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-gray);
        font-size: 0.95rem;
    }
    
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
        width: 100%;
    }
    
    .game-item {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
    }
    
    .game-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    
    .game-cover {
        position: relative;
        width: 100%;
        padding-top: 133%; /* 3:4 aspect ratio */
        overflow: hidden;
    }
    
    .game-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .game-item:hover .game-image {
        transform: scale(1.05);
    }
    
    .game-info {
        padding: 12px;
    }
    
    .game-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-light);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .game-categories {
        margin-bottom: 10px;
    }
    
    .category-tag {
        background-color: var(--accent-dark);
        color: var(--text-gray);
        font-size: 0.75rem;
        padding: 3px 7px;
        border-radius: 4px;
        margin-right: 4px;
        margin-bottom: 4px;
        display: inline-block;
    }
    
    .game-buttons {
        display: flex;
        gap: 8px;
    }
    
    .game-btn {
        flex: 1;
        text-align: center;
        padding: 8px 0;
        font-size: 0.9rem;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    
    .play-btn {
        background-color: #4CAF50;
    }
    
    .play-btn:hover {
        background-color: #45a049;
    }
    
    .download-btn {
        background-color: var(--accent-color);
    }
    
    .download-btn:hover {
        background-color: #0d8bf0;
    }
    
    .stats-btn {
        background-color: #7e57c2;
    }
    
    .stats-btn:hover {
        background-color: #6a48b8;
    }
    
    .alert {
        padding: 0.9rem;
        border-radius: 6px;
        margin-bottom: 1.2rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 1.5rem 1.2rem 1.5rem;
    }
    
    .alert-success {
        background-color: rgba(76, 175, 80, 0.1);
        color: #4caf50;
        border: 1px solid #4caf50;
    }
    
    .alert-danger {
        background-color: rgba(244, 67, 54, 0.1);
        color: #f44336;
        border: 1px solid #f44336;
    }
    
    .alert-info {
        background-color: rgba(33, 150, 243, 0.1);
        color: #2196f3;
        border: 1px solid #2196f3;
    }
    
    .alert i {
        font-size: 1.2rem;
    }
    
    .empty-library {
        text-align: center;
        padding: 3rem 1.5rem;
        background-color: var(--secondary-dark);
        border-radius: 8px;
        margin: 1.5rem;
        border: 1px solid var(--accent-dark);
    }
    
    .empty-library-icon {
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 1.2rem;
        opacity: 0.7;
    }
    
    .empty-library h3 {
        font-size: 1.5rem;
        margin-bottom: 0.8rem;
        color: var(--text-light);
    }
    
    .empty-library p {
        color: var(--text-gray);
        margin-bottom: 1.2rem;
        font-size: 1.05rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .browse-btn {
        background-color: var(--accent-color);
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .browse-btn:hover {
        background-color: #0d8bf0;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .game-status {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        font-size: 0.75rem;
        padding: 3px 8px;
        border-radius: 4px;
        z-index: 5;
    }
    
    .status-installed {
        background-color: rgba(76, 175, 80, 0.8);
    }
    
    .status-update {
        background-color: rgba(255, 152, 0, 0.8);
    }
    
    .library-stats {
        background-color: var(--secondary-dark);
        padding: 14px;
        border-radius: 8px;
        margin-bottom: 15px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        width: 100%;
    }
    
    .stat-item {
        flex: 1;
        text-align: center;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 4px;
    }
    
    .stat-label {
        color: var(--text-gray);
        font-size: 0.9rem;
    }
    
    /* Steam tarzi ekstra özellikler */
    .collapse-button {
        background: none;
        border: none;
        color: var(--text-gray);
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .collapse-button:hover {
        color: white;
    }
    
    .view-toggle {
        display: flex;
        border: 1px solid var(--accent-dark);
        border-radius: 4px;
        overflow: hidden;
    }
    
    .view-toggle-btn {
        background: var(--secondary-dark);
        color: var(--text-gray);
        border: none;
        padding: 6px 10px;
        cursor: pointer;
    }
    
    .view-toggle-btn.active {
        background: var(--accent-color);
        color: white;
    }
    
    /* Container düzenlemesi */
    .container-fluid {
        padding: 0;
        width: 100%;
        margin: 0;
        overflow: hidden;
        max-width: 100%;
        border: none;
    }
    
    @media (max-width: 992px) {
        .library-layout {
            flex-direction: column;
            height: auto;
        }
        
        .game-list-sidebar {
            width: 100%;
            max-height: 300px;
        }
        
        .game-grid-container {
            height: auto;
            width: 100%;
            max-width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        .library-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .library-search {
            max-width: 100%;
            margin-top: 15px;
            margin-left: 0;
        }
        
        .games-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        }
        
        .library-filters {
            justify-content: space-between;
        }
        
        .filter-btn {
            font-size: 0.85rem;
            padding: 6px 12px;
        }
    }
    
    /* Debug info stili */
    .debug-info {
        background-color: rgba(0,0,0,0.8);
        color: #00ff00;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-family: monospace;
        font-size: 14px;
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')
<div class="container-fluid library-container">
    <div class="library-header">
        <div>
            <h1 class="library-title">Kütüphanem</h1>
            <p class="library-subtitle">Sahip olduğunuz oyunlar ve uygulamalar burada görünür</p>
        </div>
        
        <div class="library-search">
            <input type="text" id="gameSearch" class="search-input" placeholder="Kütüphanede ara...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif
    
    @if(session('info'))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <div>{{ session('info') }}</div>
        </div>
    @endif
    
    @if(Auth::check())
        @if(count($libraryItems) > 0)
            <!-- İki kolonlu düzen başlangıcı -->
            <div class="library-layout">
                <!-- Sol taraftaki oyun listesi -->
                <div class="game-list-sidebar">
                    <div class="list-header">
                        <div class="list-title">
                            <i class="fas fa-gamepad"></i> TÜMÜ <span class="count">({{ count($libraryItems) }})</span>
                        </div>
                        <button class="collapse-button"><i class="fas fa-chevron-down"></i></button>
                    </div>
                    
                    <div class="list-search">
                        <input type="text" placeholder="Filtrele..." id="sidebarSearch">
                    </div>
                    
                    <div class="games-list-container">
                        <ul class="games-list">
                            @foreach($libraryItems as $index => $game)
                                <li class="game-list-item {{ $index === 0 ? 'active' : '' }}" data-game-id="{{ $game->id }}">
                                    <a href="{{ route('library.game', ['gameId' => $game->id]) }}" style="display: flex; align-items: center; text-decoration: none; width: 100%;">
                                        <div class="game-list-icon">
                                            <img src="{{ $game->image }}" alt="{{ $game->title }}">
                                        </div>
                                        <div class="game-list-name">{{ $game->title }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- Sağ taraftaki ana içerik -->
                <div class="game-grid-container">
                    <div class="library-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ count($libraryItems) }}</div>
                            <div class="stat-label">Toplam Oyun</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Kurulu</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Güncelleme Bekleyen</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Toplam Oynama Saati</div>
                        </div>
                    </div>
                    
                    <div class="library-filters">
                        <button class="filter-btn active">
                            <i class="fas fa-gamepad"></i> Tüm Oyunlar
                        </button>
                        <button class="filter-btn">
                            <i class="fas fa-download"></i> Kurulu
                        </button>
                        <button class="filter-btn">
                            <i class="fas fa-clock"></i> Son Oynanılanlar
                        </button>
                        <button class="filter-btn">
                            <i class="fas fa-heart"></i> Favoriler
                        </button>
                        
                        <select class="sort-dropdown">
                            <option>Sırala: A-Z</option>
                            <option>Sırala: Z-A</option>
                            <option>Sırala: Eklenme Tarihi</option>
                            <option>Sırala: Oynama Saati</option>
                        </select>
                    </div>
                    
                    <div class="games-grid" id="gamesContainer">
                        @foreach($libraryItems as $game)
                            <div class="game-item" data-title="{{ $game->title }}" data-category="{{ $game->category }}" data-game-id="{{ $game->id }}">
                                <div class="game-status status-installed">Kurulu</div>
                                <div class="game-cover">
                                    <img src="{{ $game->image }}" class="game-image" alt="{{ $game->title }}">
                                </div>
                                <div class="game-info">
                                    <div class="game-title" title="{{ $game->title }}">{{ $game->title }}</div>
                                    <div class="game-categories">
                                        @foreach(explode(',', $game->category) as $category)
                                            <div class="category-tag">{{ trim($category) }}</div>
                                        @endforeach
                                    </div>
                                    <div class="game-buttons">
                                        <a href="{{ route('library.game', ['gameId' => $game->id]) }}" class="game-btn play-btn">
                                            <i class="fas fa-play"></i> Oyna
                                        </a>
                                        <a href="{{ route('library.download', ['gameId' => $game->id]) }}" class="game-btn download-btn">
                                            <i class="fas fa-download"></i> İndir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="empty-library">
                <div class="empty-library-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3>Kütüphanenizde henüz oyun bulunmuyor</h3>
                <p>Oyun mağazamızdan oyun satın alabilir veya ücretsiz oyunlarımıza göz atabilirsiniz.</p>
                <a href="/games" class="browse-btn">
                    <i class="fas fa-shopping-cart"></i> Oyun Mağazasına Git
                </a>
                
                @if(isset($freeGames) && count($freeGames) > 0)
                    <div class="free-games-section" style="margin-top: 30px;">
                        <h4 style="text-align: center; margin-bottom: 20px;">Bedava Oyunlar</h4>
                        <div class="games-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
                            @foreach($freeGames as $game)
                                <div class="game-item" style="background: var(--primary-dark); border-radius: 8px; overflow: hidden;">
                                    <div class="game-cover" style="height: 120px; overflow: hidden;">
                                        <img src="{{ $game->image }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $game->title }}">
                                    </div>
                                    <div class="game-info" style="padding: 10px;">
                                        <div class="game-title" style="font-weight: 600; margin-bottom: 5px;">{{ $game->title }}</div>
                                        <div class="price-tag" style="color: #00cc44; font-weight: bold; margin-bottom: 10px;">Ücretsiz</div>
                                        <form action="{{ route('library.add.direct') }}" method="POST" style="text-align: center;">
                                            @csrf
                                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                                            <button type="submit" style="background: var(--accent-color); color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; width: 100%;">
                                                <i class="fas fa-plus"></i> Kütüphaneye Ekle
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @else
        <div class="empty-library">
            <div class="empty-library-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h3>Giriş Yapmanız Gerekiyor</h3>
            <p>Kütüphanenize erişmek için lütfen giriş yapın veya kayıt olun.</p>
            <a href="{{ route('login') }}" class="browse-btn">
                <i class="fas fa-sign-in-alt"></i> Giriş Yap
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ana arama işlevselliği
    const searchInput = document.getElementById('gameSearch');
    const gamesContainer = document.getElementById('gamesContainer');
    const gameItems = document.querySelectorAll('.game-item');
    
    if (searchInput && gamesContainer) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            gameItems.forEach(item => {
                const title = item.getAttribute('data-title').toLowerCase();
                const category = item.getAttribute('data-category').toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Sol menü arama işlevselliği
    const sidebarSearch = document.getElementById('sidebarSearch');
    const gameListItems = document.querySelectorAll('.game-list-item');
    
    if (sidebarSearch) {
        sidebarSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            gameListItems.forEach(item => {
                const name = item.querySelector('.game-list-name').textContent.toLowerCase();
                
                if (name.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Sol menü öğelerini tıklanabilir yap
    gameListItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Eğer tıklanan bir a etiketiyse, normal davranışı sürdür (yani sayfaya gitsin)
            // Aksi takdirde özel işlemleri yap
            if (!e.target.closest('a')) {
                e.preventDefault();
                
                // Aktif öğeyi değiştir
                gameListItems.forEach(li => li.classList.remove('active'));
                this.classList.add('active');
                
                // Seçilen oyunun ID'sini al
                const gameId = this.getAttribute('data-game-id');
                
                // Grid'deki aynı oyunu bul ve scroll yap
                const targetGame = document.querySelector(`.game-item[data-game-id="${gameId}"]`);
                if (targetGame) {
                    targetGame.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Vurgu efekti
                    targetGame.style.outline = '2px solid var(--accent-color)';
                    setTimeout(() => {
                        targetGame.style.outline = 'none';
                    }, 2000);
                }
            }
        });
    });
    
    // Filtre butonları için
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Tüm butonlardan active class'ını kaldır
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Tıklanan butona active class'ı ekle
            this.classList.add('active');
            
            // Burada filtre işlevselliği eklenebilir
        });
    });
});
</script>
@endpush
@endsection 