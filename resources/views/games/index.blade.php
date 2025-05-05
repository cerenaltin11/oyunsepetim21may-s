@extends('layouts.app')

@section('title', 'Tüm Oyunlar')

@section('styles')
<style>
    .games-container {
        padding: 2rem 0;
    }
    
    .games-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .games-title {
        font-size: 1.8rem;
    }
    
    .search-hero {
        background-color: rgba(26, 26, 26, 0.95);
        border-radius: 10px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        background-image: url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%239C92AC" fill-opacity="0.05" fill-rule="evenodd"%3E%3Ccircle cx="3" cy="3" r="3"/%3E%3Ccircle cx="13" cy="13" r="3"/%3E%3C/g%3E%3C/svg%3E');
    }
    
    .search-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(26, 159, 255, 0.2), transparent);
        z-index: 1;
        animation: gradientAnimation 8s ease infinite;
    }
    
    @keyframes gradientAnimation {
        0% {
            opacity: 0.7;
            background-position: 0% 50%;
        }
        50% {
            opacity: 1;
            background-position: 100% 50%;
        }
        100% {
            opacity: 0.7;
            background-position: 0% 50%;
        }
    }
    
    .search-hero-content {
        position: relative;
        z-index: 5;
        max-width: 700px;
        margin: 0 auto;
        text-align: center;
    }
    
    .search-hero-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .search-hero-subtitle {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        font-size: 1rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .search-form {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 10;
    }
    
    .search-input-container {
        position: relative;
        flex-grow: 1;
        z-index: 10;
    }
    
    .search-input {
        width: 100%;
        background-color: rgba(42, 42, 42, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: white;
        padding: 0.9rem 1rem 0.9rem 3rem;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 10;
    }
    
    .search-input:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2), 0 4px 12px rgba(0, 0, 0, 0.3);
        outline: none;
        transform: translateY(-1px);
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-gray);
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }
    
    .search-input:focus + .search-icon {
        color: var(--accent-color);
    }
    
    .search-submit {
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 0 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 10;
    }
    
    .search-submit:hover {
        background-color: #0d8bf0;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .search-submit:active {
        transform: translateY(0);
    }
    
    .search-trending {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
        position: relative;
        z-index: 10;
    }
    
    .trending-tag {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--text-gray);
        font-size: 0.8rem;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.05);
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .trending-tag:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .trending-tag:active {
        transform: scale(0.96);
    }
    
    .trending-tag i {
        font-size: 0.7rem;
        opacity: 0.7;
    }
    
    .games-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .filter-label {
        font-size: 0.9rem;
        color: var(--text-gray);
    }
    
    .filter-select {
        background-color: var(--secondary-dark);
        color: var(--text-light);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .filter-btn {
        background-color: var(--accent-dark);
        color: var(--text-light);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .filter-btn.active {
        background-color: var(--accent-color);
    }
    
    .games-layout {
        display: flex;
        gap: 0.5rem;
    }
    
    .layout-btn {
        background-color: var(--accent-dark);
        color: var(--text-gray);
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    
    .layout-btn.active {
        background-color: var(--accent-color);
        color: white;
    }
    
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }
    
    .games-list {
        display: none;
        flex-direction: column;
        gap: 1rem;
    }
    
    .game-card {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s;
        position: relative;
    }
    
    .game-card:hover {
        transform: translateY(-5px);
    }
    
    .game-thumb {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .game-info {
        padding: 1rem;
    }
    
    .game-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }
    
    .game-price {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .price {
        font-weight: 700;
        color: var(--accent-color);
    }
    
    .discount {
        background-color: #4caf50;
        color: white;
        font-size: 0.8rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
    
    .category-tag {
        background-color: var(--accent-dark);
        color: var(--text-gray);
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    
    .game-item-list {
        display: flex;
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    
    .game-item-image {
        width: 120px;
        height: 80px;
        object-fit: cover;
    }
    
    .game-item-info {
        flex: 1;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
    }
    
    .game-item-left {
        max-width: 70%;
    }
    
    .game-item-right {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
    }
    
    .game-item-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .game-item-description {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .game-item-categories {
        margin-top: 0.5rem;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .pagination-list {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        align-items: center;
        gap: 8px;
    }
    
    .page-item {
        margin: 0 2px;
    }
    
    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 5px;
        background-color: var(--secondary-dark);
        color: var(--text-light);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .page-item.active .page-link {
        background-color: var(--accent-color);
        color: white;
    }
    
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .page-link:hover:not(.page-item.disabled .page-link) {
        background-color: var(--accent-dark);
    }
    
    @media (max-width: 768px) {
        .games-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .games-filters {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .game-item-list {
            flex-direction: column;
        }
        
        .game-item-image {
            width: 100%;
            height: 120px;
        }
        
        .game-item-info {
            flex-direction: column;
        }
        
        .game-item-right {
            margin-top: 1rem;
            align-items: flex-start;
        }
        
        .search-hero {
            padding: 1.5rem 1rem;
        }
        
        .search-hero-title {
            font-size: 1.5rem;
        }
        
        .search-hero-subtitle {
            font-size: 0.9rem;
        }
        
        .search-form {
            flex-direction: column;
        }
        
        .search-submit {
            width: 100%;
            padding: 0.9rem;
        }
        
        .trending-tag {
            font-size: 0.75rem;
        }
    }
    
    .highlight {
        background-color: rgba(26, 159, 255, 0.2);
        font-weight: bold;
        border-radius: 2px;
        padding: 0 2px;
    }
    
    .search-results-info {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.9rem;
        position: relative;
        z-index: 10;
    }
    
    .search-results-info p {
        margin: 0;
    }
    
    .search-results-info i {
        margin-right: 0.5rem;
        color: var(--accent-color);
    }
    
    .clear-search {
        color: var(--text-gray);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    
    .clear-search:hover {
        color: white;
    }
    
    .clear-search i {
        font-size: 0.8rem;
    }
    
    .owned-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(76, 175, 80, 0.9);
        color: white;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        z-index: 5;
    }
    
    .owned-badge i {
        font-size: 0.9rem;
    }
    
    .owned-badge-list {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(76, 175, 80, 0.9);
        color: white;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        z-index: 5;
    }
</style>
@endsection

@section('content')
    <div class="games-container">
        <div class="games-header">
            <h1 class="games-title">Tüm Oyunlar</h1>
            
            <div class="games-layout">
                <button id="grid-view" class="layout-btn active" type="button">
                    <i class="fas fa-th"></i>
                </button>
                <button id="list-view" class="layout-btn" type="button">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
        
        <div class="search-hero">
            <div class="search-hero-content">
                <h2 class="search-hero-title">Arama</h2>
                <p class="search-hero-subtitle">Aradığınız oyunu bulun.</p>
                <form class="search-form" action="{{ url('/games') }}" method="GET">
                    <div class="search-input-container">
                        <input type="text" name="search" class="search-input" placeholder="Oyun adı, kategori veya açıklama..." value="{{ request('search') }}">
                        <i class="search-icon fas fa-search"></i>
                    </div>
                    <button type="submit" class="search-submit">Ara</button>
                </form>
                <div class="search-trending">
                    <span class="trending-tag" data-search="RPG"><i class="fas fa-dice-d20"></i> RPG</span>
                    <span class="trending-tag" data-search="FPS"><i class="fas fa-crosshairs"></i> FPS</span>
                    <span class="trending-tag" data-search="Macera"><i class="fas fa-compass"></i> Macera</span>
                    <span class="trending-tag" data-search="Strateji"><i class="fas fa-chess"></i> Strateji</span>
                    <span class="trending-tag" data-search="Spor"><i class="fas fa-futbol"></i> Spor</span>
                </div>
                
                @if(request('search'))
                <div class="search-results-info">
                    <p><i class="fas fa-info-circle"></i> "{{ request('search') }}" için {{ $games->total() }} sonuç bulundu.</p>
                    <a href="{{ url('/games') }}" class="clear-search">Aramayı Temizle <i class="fas fa-times"></i></a>
                </div>
                @endif
            </div>
        </div>
        
        <div class="games-filters">
            <div class="filter-group">
                <span class="filter-label">Kategori:</span>
                <select class="filter-select" id="category-filter" onchange="applyFilters()">
                    <option value="all" {{ $category == 'all' ? 'selected' : '' }}>Tümü</option>
                    @foreach($uniqueCategories as $cat)
                        <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Sırala:</span>
                <select class="filter-select" id="sort-filter" onchange="applyFilters()">
                    <option value="title-asc" {{ $sort == 'title' && $direction == 'asc' ? 'selected' : '' }}>İsim (A-Z)</option>
                    <option value="title-desc" {{ $sort == 'title' && $direction == 'desc' ? 'selected' : '' }}>İsim (Z-A)</option>
                    <option value="price-asc" {{ $sort == 'price' && $direction == 'asc' ? 'selected' : '' }}>Fiyat (Düşük-Yüksek)</option>
                    <option value="price-desc" {{ $sort == 'price' && $direction == 'desc' ? 'selected' : '' }}>Fiyat (Yüksek-Düşük)</option>
                    <option value="release_date-desc" {{ $sort == 'release_date' && $direction == 'desc' ? 'selected' : '' }}>En Yeni</option>
                    <option value="release_date-asc" {{ $sort == 'release_date' && $direction == 'asc' ? 'selected' : '' }}>En Eski</option>
                </select>
            </div>
            
            <div class="filter-group">
                <button class="filter-btn" onclick="toggleFilter(this, 'discount')">İndirimli</button>
                <button class="filter-btn" onclick="toggleFilter(this, 'new')">Yeni Çıkan</button>
                <button class="filter-btn" onclick="toggleFilter(this, 'preorder')">Ön Sipariş</button>
            </div>
        </div>
        
        <!-- Grid View (Default) -->
        <div class="games-grid" id="gridView">
            @if($games->count() > 0)
                @foreach($games as $game)
                <div class="game-card">
                    <a href="/games/{{ $game->slug }}">
                        <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-thumb">
                        @if(Auth::check() && isset($libraryGames) && in_array($game->id, $libraryGames))
                            <div class="owned-badge">
                                <i class="fas fa-check-circle"></i> Sahip
                            </div>
                        @endif
                        <div class="game-info">
                            @foreach(explode(',', $game->category) as $cat)
                                <div class="category-tag">{{ trim($cat) }}</div>
                            @endforeach
                            <h3 class="game-title">{{ $game->title }}</h3>
                            <div class="game-price">
                                @if($game->discount_price)
                                    <span class="price">₺{{ $game->discount_price }}</span>
                                    <span class="discount">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                                @else
                                    <span class="price">₺{{ $game->price }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <div class="no-results">
                    <p>Arama kriterlerinize uygun oyun bulunamadı.</p>
                </div>
            @endif
        </div>
        
        <!-- List View (Hidden by default) -->
        <div class="games-list" id="listView">
            @if($games->count() > 0)
                @foreach($games as $game)
                <div class="game-item-list">
                    <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-item-image">
                    @if(Auth::check() && isset($libraryGames) && in_array($game->id, $libraryGames))
                        <div class="owned-badge-list">
                            <i class="fas fa-check-circle"></i> Sahip
                        </div>
                    @endif
                    <div class="game-item-info">
                        <div class="game-item-left">
                            <h3 class="game-item-title">{{ $game->title }}</h3>
                            <p class="game-item-description">{{ $game->description }}</p>
                            <div class="game-item-categories">
                                @foreach(explode(',', $game->category) as $cat)
                                    <div class="category-tag">{{ trim($cat) }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="game-item-right">
                            <div class="game-price">
                                @if($game->discount_price)
                                    <span class="price">₺{{ $game->discount_price }}</span>
                                    <span class="discount">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                                @else
                                    <span class="price">₺{{ $game->price }}</span>
                                @endif
                            </div>
                            <a href="/games/{{ $game->slug }}" class="btn btn-primary mt-2">Detaylar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-results">
                    <p>Arama kriterlerinize uygun oyun bulunamadı.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            @if ($games->hasPages())
                <nav>
                    <ul class="pagination-list">
                        {{-- Previous Page Link --}}
                        @if ($games->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $games->appends(request()->except('page'))->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($games->appends(request()->except('page'))->getUrlRange(1, $games->lastPage()) as $page => $url)
                            @if ($page == $games->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($games->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $games->appends(request()->except('page'))->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grid/List view toggle
        const gridViewBtn = document.getElementById('grid-view');
        const listViewBtn = document.getElementById('list-view');
        const gamesGrid = document.querySelector('.games-grid');
        const gamesList = document.querySelector('.games-list');
        
        if (gridViewBtn && listViewBtn) {
            gridViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                gamesGrid.style.display = 'grid';
                gamesList.style.display = 'none';
                
                // Save preference to local storage
                localStorage.setItem('gamesViewPreference', 'grid');
            });
            
            listViewBtn.addEventListener('click', function() {
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                gamesList.style.display = 'flex';
                gamesGrid.style.display = 'none';
                
                // Save preference to local storage
                localStorage.setItem('gamesViewPreference', 'list');
            });
            
            // Load preference from local storage
            const viewPreference = localStorage.getItem('gamesViewPreference');
            if (viewPreference === 'list') {
                listViewBtn.click();
            } else {
                gridViewBtn.click();
            }
        }
        
        // Filter functionality
        window.applyFilters = function() {
            // URL oluştur
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);
            
            // Kategori parametresi
            const categoryFilter = document.getElementById('category-filter');
            const category = categoryFilter.value;
            if (category && category !== 'all') {
                params.set('category', category);
            } else {
                params.delete('category');
            }
            
            // Sıralama parametreleri
            const sortFilter = document.getElementById('sort-filter');
            const sortValue = sortFilter.value.split('-');
            if (sortValue.length === 2) {
                params.set('sort', sortValue[0]);
                params.set('direction', sortValue[1]);
            }
            
            // Arama parametresini koru
            const searchParam = params.get('search');
            if (!searchParam) {
                params.delete('search');
            }
            
            // Yeni URL oluştur ve yönlendir
            url.search = params.toString();
            window.location.href = url.toString();
        };
        
        window.toggleFilter = function(button, filter) {
            button.classList.toggle('active');
            
            // Burada filtreleme işlemleri yapılacak
            applyFilters();
        };
        
        // Trending tags functionality
        const trendingTags = document.querySelectorAll('.trending-tag');
        const searchInput = document.querySelector('input[name="search"]');
        const searchForm = document.querySelector('.search-form');
        
        trendingTags.forEach(tag => {
            tag.addEventListener('click', function() {
                const searchTerm = this.getAttribute('data-search');
                searchInput.value = searchTerm;
                // Submit the form
                searchForm.submit();
            });
        });
        
        // Search input animations
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
            
            // Clear search with Esc key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    this.focus();
                }
            });
        }
        
        // If there's a search query, highlight it in the game cards
        const searchQuery = "{{ request('search') }}";
        if (searchQuery) {
            highlightSearchTerms(searchQuery);
        }
        
        function highlightSearchTerms(query) {
            if (!query) return;
            
            // Highlight in titles
            const gameTitles = document.querySelectorAll('.game-title, .game-item-title');
            gameTitles.forEach(title => {
                const originalText = title.textContent;
                if (originalText.toLowerCase().includes(query.toLowerCase())) {
                    const regex = new RegExp(query, 'gi');
                    title.innerHTML = originalText.replace(regex, match => `<span class="highlight">${match}</span>`);
                }
            });
        }
    });
</script>
@endsection 