@extends('layouts.app')

@section('title', 'Fırsatlar')

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
    
    .original-price {
        text-decoration: line-through;
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-right: 0.5rem;
    }
    
    .discount {
        background-color: #4caf50;
        color: white;
        font-size: 0.8rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
    
    .discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #e53935;
        color: white;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        z-index: 1;
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
    
    .deals-banner {
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .deals-banner-text {
        max-width: 60%;
    }
    
    .deals-banner-text h2 {
        font-size: 2rem;
        margin-top: 0;
        margin-bottom: 1rem;
        color: var(--accent-color);
    }
    
    .deals-banner-text p {
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .countdown {
        color: var(--text-light) !important;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .countdown span {
        color: #ff6b6b;
        background-color: rgba(255, 107, 107, 0.1);
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        border: 1px solid rgba(255, 107, 107, 0.3);
    }
    
    .deals-banner-image {
        width: 35%;
        display: flex;
        justify-content: flex-end;
    }
    
    .deals-banner-image img {
        max-width: 100%;
        border-radius: 8px;
        height: auto;
    }
    
    .personalized-deals-section {
        margin-bottom: 2rem;
        background-color: rgba(26, 159, 255, 0.1);
        border-radius: 8px;
        padding: 1.5rem;
        border: 1px solid var(--accent-color);
    }
    
    .personalized-note {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        font-style: italic;
    }
    
    .personalized-grid {
        margin-bottom: 0;
    }
    
    .personalized-card {
        border: 1px solid var(--accent-color);
        box-shadow: 0 4px 10px rgba(26, 159, 255, 0.2);
        position: relative;
        overflow: visible;
    }
    
    .personalized-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--accent-color);
        color: white;
        font-size: 0.8rem;
        font-weight: bold;
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        z-index: 2;
    }
    
    .section-divider {
        height: 1px;
        background-color: var(--accent-dark);
        margin: 2rem 0;
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
        
        .deals-banner {
            flex-direction: column;
            padding: 1.5rem;
        }
        
        .deals-banner-text {
            max-width: 100%;
            margin-bottom: 1rem;
        }
        
        .deals-banner-image {
            width: 100%;
            justify-content: center;
        }
        
        .personalized-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="games-container">
        <div class="deals-banner">
            <div class="deals-banner-text">
                <h2>Büyük Sezon İndirimleri!</h2>
                <p>En popüler oyunlarda %70'e varan indirimler sizleri bekliyor. İster macera, ister strateji, ister spor - keşfedecek çok şey var!</p>
                <p class="countdown">İndirim bitmeden: <span>2 gün 14 saat 35 dakika</span></p>
                <a href="#" class="btn btn-primary"><i class="fas fa-tag"></i> Hemen İncele</a>
            </div>
            <div class="deals-banner-image">
                <img src="https://images.unsplash.com/photo-1534423861386-85a16f5d13fd?q=80&w=600&auto=format&fit=crop" alt="İndirimli Oyunlar">
            </div>
        </div>
        
        @auth
            @if($personalizedDeals->count() > 0)
                <div class="personalized-deals-section">
                    <h2 class="games-title">{{ Auth::user()->name }} İçin Özel İndirimler</h2>
                    <p class="personalized-note">Bu indirimler sadece size özel! Sınırlı süre geçerlidir.</p>
                    
                    <div class="games-grid personalized-grid">
                        @foreach($personalizedDeals as $game)
                            <div class="game-card personalized-card">
                                <span class="discount-badge">%{{ $game->discount_percent }}</span>
                                <div class="personalized-badge">
                                    <i class="fas fa-star"></i> Özel İndirim
                                </div>
                                <div class="game-actions-wrapper">
                                    <a href="/games/{{ $game->slug }}">
                                        <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-thumb">
                                        <div class="game-info">
                                            @foreach(explode(',', $game->category) as $cat)
                                                <div class="category-tag">{{ trim($cat) }}</div>
                                            @endforeach
                                            <h3 class="game-title">{{ $game->title }}</h3>
                                            <div class="game-price">
                                                <div>
                                                    <span class="original-price">₺{{ $game->original_price }}</span>
                                                    <span class="price">₺{{ $game->discount_price }}</span>
                                                </div>
                                                <span class="discount">-{{ $game->discount_percent }}%</span>
                                            </div>
                                        </div>
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="personalized-form">
                                        @csrf
                                        <input type="hidden" name="gameId" value="{{ $game->id }}">
                                        <input type="hidden" name="is_personalized" value="true">
                                        <input type="hidden" name="personalizedPrice" value="{{ $game->discount_price }}">
                                        <button type="submit" class="btn-personalized-add">
                                            <i class="fas fa-shopping-cart"></i> Sepete Ekle
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="section-divider"></div>
            @endif
        @endauth
    
        <div class="games-header">
            <h1 class="games-title">İndirimli Oyunlar</h1>
            
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
                    <option value="discount_percentage-desc" {{ $sort == 'discount_percentage' && $direction == 'desc' ? 'selected' : '' }}>En Yüksek İndirim</option>
                    <option value="discount_percentage-asc" {{ $sort == 'discount_percentage' && $direction == 'asc' ? 'selected' : '' }}>En Düşük İndirim</option>
                    <option value="price-asc" {{ $sort == 'price' && $direction == 'asc' ? 'selected' : '' }}>Fiyat (Düşük-Yüksek)</option>
                    <option value="price-desc" {{ $sort == 'price' && $direction == 'desc' ? 'selected' : '' }}>Fiyat (Yüksek-Düşük)</option>
                    <option value="title-asc" {{ $sort == 'title' && $direction == 'asc' ? 'selected' : '' }}>İsim (A-Z)</option>
                    <option value="title-desc" {{ $sort == 'title' && $direction == 'desc' ? 'selected' : '' }}>İsim (Z-A)</option>
                    <option value="release_date-desc" {{ $sort == 'release_date' && $direction == 'desc' ? 'selected' : '' }}>En Yeni</option>
                </select>
            </div>
        </div>
        
        <!-- Grid View (Default) -->
        <div class="games-grid" id="gridView">
            @if($games->count() > 0)
                @foreach($games as $game)
                <div class="game-card">
                    <span class="discount-badge">%{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}</span>
                    <a href="/games/{{ $game->slug }}">
                        <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-thumb">
                        <div class="game-info">
                            @foreach(explode(',', $game->category) as $cat)
                                <div class="category-tag">{{ trim($cat) }}</div>
                            @endforeach
                            <h3 class="game-title">{{ $game->title }}</h3>
                            <div class="game-price">
                                <div>
                                    <span class="original-price">₺{{ $game->price }}</span>
                                    <span class="price">₺{{ $game->discount_price }}</span>
                                </div>
                                <span class="discount">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <div class="no-results">
                    <p>Şu anda indirimli oyun bulunmamaktadır.</p>
                </div>
            @endif
        </div>
        
        <!-- List View (Hidden by default) -->
        <div class="games-list" id="listView">
            @if($games->count() > 0)
                @foreach($games as $game)
                <div class="game-item-list">
                    <span class="discount-badge">%{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}</span>
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
                                <div>
                                    <span class="original-price">₺{{ $game->price }}</span>
                                    <span class="price">₺{{ $game->discount_price }}</span>
                                </div>
                                <span class="discount">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                            </div>
                            <a href="/games/{{ $game->slug }}" class="btn btn-primary mt-2">Detaylar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-results">
                    <p>Şu anda indirimli oyun bulunmamaktadır.</p>
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
        
        // Countdown timer fonksiyonu
        function updateCountdown() {
            // Set the end date - 3 days from now
            const now = new Date();
            const endDate = new Date();
            endDate.setDate(now.getDate() + 3);
            endDate.setHours(23, 59, 59, 0);
            
            // Calculate the time difference
            const timeDiff = endDate - now;
            
            // Calculate days, hours, minutes, seconds
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
            
            // Display the countdown
            const countdownElement = document.querySelector('.countdown span');
            if (countdownElement) {
                countdownElement.textContent = `${days} gün ${hours} saat ${minutes} dakika ${seconds} saniye`;
            }
        }
        
        // Update the countdown every second
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>
@endsection 