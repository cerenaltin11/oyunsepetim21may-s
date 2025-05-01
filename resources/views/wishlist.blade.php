@extends('layouts.app')

@section('title', 'İstek Listem')

@section('styles')
<style>
    .wishlist-container {
        padding: 2rem 0;
    }
    
    .wishlist-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-dark);
        padding-bottom: 1rem;
    }
    
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .wishlist-item {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s;
    }
    
    .wishlist-item:hover {
        transform: translateY(-5px);
    }
    
    .wishlist-item-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .wishlist-item-info {
        padding: 1rem;
    }
    
    .wishlist-item-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }
    
    .wishlist-item-category {
        display: inline-block;
        font-size: 0.8rem;
        color: var(--text-gray);
        margin-bottom: 0.5rem;
    }
    
    .wishlist-item-price {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .wishlist-item-actions {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }
    
    .move-to-cart {
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }
    
    .move-to-cart:hover {
        background-color: var(--accent-dark);
    }
    
    .remove-wishlist {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .remove-wishlist:hover {
        background-color: #d32f2f;
    }
    
    .empty-wishlist {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
    }
    
    .empty-wishlist-icon {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .empty-wishlist-text {
        margin-bottom: 1.5rem;
        color: var(--text-gray);
    }
    
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
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
    
    .wishlist-actions {
        margin-top: 1rem;
        text-align: right;
    }
    
    .clear-wishlist-btn {
        color: #f44336;
        background: none;
        border: none;
        text-decoration: underline;
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .clear-wishlist-btn:hover {
        color: #d32f2f;
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
</style>
@endsection

@section('content')
    <div class="wishlist-container">
        <h1 class="wishlist-title">İstek Listem</h1>
        
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
        
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        
        @if(count($wishlistItems) > 0)
            <div class="wishlist-actions">
                <a href="{{ route('wishlist.clear') }}" class="clear-wishlist-btn">İstek Listesini Temizle</a>
            </div>
            
            <div class="wishlist-grid">
                @foreach($wishlistItems as $game)
                    <div class="wishlist-item">
                        @if($game->discount_price)
                            <span class="discount-badge">%{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}</span>
                        @endif
                        
                        <a href="/games/{{ $game->slug }}">
                            <img src="{{ $game->image }}" alt="{{ $game->title }}" class="wishlist-item-image">
                        </a>
                        
                        <div class="wishlist-item-info">
                            <h3 class="wishlist-item-title">{{ $game->title }}</h3>
                            <div class="category-tags">
                                @foreach(explode(',', $game->category) as $cat)
                                    <span class="category-tag">{{ trim($cat) }}</span>
                                @endforeach
                            </div>
                            
                            <div class="wishlist-item-price">
                                @if($game->discount_price)
                                    <span class="original-price">₺{{ $game->price }}</span>
                                    <span class="price">₺{{ $game->discount_price }}</span>
                                    <span class="discount">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                                @else
                                    <span class="price">₺{{ $game->price }}</span>
                                @endif
                            </div>
                            
                            <div class="wishlist-item-actions">
                                <a href="{{ route('wishlist.moveToCart', ['gameId' => $game->id]) }}" class="move-to-cart">
                                    <i class="fas fa-shopping-cart"></i> Sepete Ekle
                                </a>
                                <a href="{{ route('wishlist.remove', ['gameId' => $game->id]) }}" class="remove-wishlist">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <div class="empty-wishlist-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>İstek Listeniz Boş</h2>
                <p class="empty-wishlist-text">İstek listenize henüz bir oyun eklemediniz. Beğendiğiniz oyunları burada saklayabilirsiniz.</p>
                <a href="/games" class="btn btn-primary">Oyunları Keşfet</a>
            </div>
        @endif
    </div>
@endsection 