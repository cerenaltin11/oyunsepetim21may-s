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
    }
</style>
@endsection

@section('content')
    <div class="games-container">
        <div class="games-header">
            <h1 class="games-title">Tüm Oyunlar</h1>
            
            <div class="games-layout">
                <button class="layout-btn active" onclick="changeLayout('grid')">
                    <i class="fas fa-th"></i>
                </button>
                <button class="layout-btn" onclick="changeLayout('list')">
                    <i class="fas fa-list"></i>
                </button>
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
        // Grid veya liste görünümünü değiştir fonksiyonu
        window.changeLayout = function(layout) {
            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');
            const layoutButtons = document.querySelectorAll('.layout-btn');
            
            if (layout === 'grid') {
                gridView.style.display = 'grid';
                listView.style.display = 'none';
                layoutButtons[0].classList.add('active');
                layoutButtons[1].classList.remove('active');
            } else {
                gridView.style.display = 'none';
                listView.style.display = 'flex';
                layoutButtons[0].classList.remove('active');
                layoutButtons[1].classList.add('active');
            }
        };
        
        // Filtre butonunu aktif/pasif yap
        window.toggleFilter = function(button, filter) {
            button.classList.toggle('active');
            
            // Burada filtreleme işlemleri yapılacak
            applyFilters();
        };
        
        // Kategori ve sıralama filtrelerini al
        const categoryFilter = document.getElementById('category-filter');
        const sortFilter = document.getElementById('sort-filter');
        
        // Filtreleri uygula
        window.applyFilters = function() {
            // URL oluştur
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);
            
            // Kategori parametresi
            const category = categoryFilter.value;
            if (category && category !== 'all') {
                params.set('category', category);
            } else {
                params.delete('category');
            }
            
            // Sıralama parametreleri
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
        
        // Oyunları sırala
        window.sortGames = function() {
            // Burada seçilen sıralama türüne göre oyunlar sıralanacak
            console.log('Oyunlar sıralanıyor...');
        };
    });
</script>
@endsection 