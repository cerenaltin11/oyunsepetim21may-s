@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', $game->title)

@section('styles')
<style>
    .game-detail {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .game-gallery {
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .game-main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    
    .game-thumbnails {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .game-thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s;
    }
    
    .game-thumbnail:hover, .game-thumbnail.active {
        opacity: 1;
    }
    
    .game-info-main h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    
    .game-categories {
        margin-bottom: 1rem;
    }
    
    .game-description {
        color: var(--text-gray);
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .game-features {
        margin-bottom: 2rem;
    }
    
    .game-features h3 {
        margin-bottom: 1rem;
        border-left: 4px solid var(--accent-color);
        padding-left: 1rem;
    }
    
    .features-list {
        list-style: none;
        padding: 0;
    }
    
    .features-list li {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .features-list li::before {
        content: "✓";
        margin-right: 0.5rem;
        color: var(--accent-color);
    }
    
    .game-sidebar {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
        height: fit-content;
    }
    
    .game-price-container {
        margin-bottom: 1.5rem;
    }
    
    .game-price {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .current-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-right: 1rem;
    }
    
    .original-price {
        font-size: 1.2rem;
        color: var(--text-gray);
        text-decoration: line-through;
    }
    
    .discount-badge {
        background-color: #4caf50;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        margin-left: 0.5rem;
    }
    
    .game-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .action-btn {
        padding: 0.8rem;
        border-radius: 4px;
        text-align: center;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        width: 100%;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-buy {
        background-color: var(--accent-color);
        color: white;
    }
    
    .btn-buy:hover {
        background-color: #0b86e3;
    }
    
    .btn-wishlist {
        background-color: var(--accent-dark);
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-wishlist i {
        color: #e91e63;
    }
    
    .btn-wishlist:hover {
        background-color: #444;
    }
    
    .game-details-list {
        margin-top: 1.5rem;
    }
    
    .game-details-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .detail-label {
        color: var(--text-gray);
    }
    
    .requirements-tabs {
        display: flex;
        margin-bottom: 1rem;
    }
    
    .req-tab {
        padding: 0.5rem 1rem;
        background-color: var(--accent-dark);
        cursor: pointer;
    }
    
    .req-tab:first-child {
        border-radius: 4px 0 0 4px;
    }
    
    .req-tab:last-child {
        border-radius: 0 4px 4px 0;
    }
    
    .req-tab.active {
        background-color: var(--accent-color);
        color: white;
    }
    
    .req-list {
        list-style: none;
        padding: 0;
    }
    
    .req-list li {
        margin-bottom: 0.5rem;
    }
    
    .section-title {
        border-left: 4px solid var(--accent-color);
        padding-left: 1rem;
        margin: 2rem 0 1rem;
    }
    
    .alert-owned {
        background-color: rgba(76, 175, 80, 0.15);
        color: #4caf50;
        border: 1px solid #4caf50;
        border-radius: 4px;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 600;
    }
    
    .alert-owned i {
        font-size: 1.2rem;
    }
    
    .btn-library {
        background-color: #4caf50;
        color: white;
    }
    
    .btn-library:hover {
        background-color: #3d9a40;
    }
    
    .already-owned {
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
    <div class="game-detail">
        <div class="game-info-main">
            <div class="game-gallery">
                <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-main-image" id="mainImage">
                
                <div class="game-thumbnails">
                    <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-thumbnail active" onclick="changeImage(this, '{{ $game->image }}')">
                    <!-- Şimdilik bir görsel kullanıyoruz, gerçek projede daha fazla olabilir -->
                </div>
            </div>
            
            <h1>{{ $game->title }}</h1>
            
            <div class="game-categories">
                @foreach(explode(',', $game->category) as $cat)
                    <div class="category-tag">{{ trim($cat) }}</div>
                @endforeach
            </div>
            
            <div class="game-description">
                <p>{{ $game->description }}</p>
            </div>
            
            <div class="game-features">
                <h3>Özellikler</h3>
                <ul class="features-list">
                    <li>Geniş ve detaylı açık dünya</li>
                    <li>Zengin karakter özelleştirme</li>
                    <li>Sürükleyici hikâye ve yan görevler</li>
                    <li>Çeşitli silahlar ve savaş becerileri</li>
                    <li>Araç kullanma ve yarış yapma imkanı</li>
                    <li>Gelişmiş grafik ve gerçekçi şehir ortamı</li>
                </ul>
            </div>
            
            <div class="system-requirements">
                <h3>Sistem Gereksinimleri</h3>
                
                <div class="requirements-tabs">
                    <div class="req-tab active" onclick="showRequirements('minimum')">Minimum</div>
                    <div class="req-tab" onclick="showRequirements('recommended')">Önerilen</div>
                </div>
                
                <div class="req-content" id="minimum">
                    <ul class="req-list">
                        <li><strong>İşletim Sistemi:</strong> Windows 10 64-bit</li>
                        <li><strong>İşlemci:</strong> Intel Core i5-3570K / AMD FX-8310</li>
                        <li><strong>Bellek:</strong> 8 GB RAM</li>
                        <li><strong>Ekran Kartı:</strong> NVIDIA GeForce GTX 780 / AMD Radeon RX 470</li>
                        <li><strong>DirectX:</strong> Sürüm 12</li>
                        <li><strong>Depolama:</strong> 70 GB kullanılabilir alan</li>
                    </ul>
                </div>
                
                <div class="req-content" id="recommended" style="display: none;">
                    <ul class="req-list">
                        <li><strong>İşletim Sistemi:</strong> Windows 10 64-bit</li>
                        <li><strong>İşlemci:</strong> Intel Core i7-4790 / AMD Ryzen 3 3200G</li>
                        <li><strong>Bellek:</strong> 12 GB RAM</li>
                        <li><strong>Ekran Kartı:</strong> NVIDIA GeForce GTX 1060 / AMD Radeon R9 Fury</li>
                        <li><strong>DirectX:</strong> Sürüm 12</li>
                        <li><strong>Depolama:</strong> 70 GB SSD</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="game-sidebar">
            <div class="game-price-container">
                <div class="game-price">
                    @if($game->discount_price)
                        <span class="current-price">₺{{ $game->discount_price }}</span>
                        <span class="original-price">₺{{ $game->price }}</span>
                        <span class="discount-badge">-{{ round((($game->price - $game->discount_price) / $game->price) * 100) }}%</span>
                    @else
                        <span class="current-price">₺{{ $game->price }}</span>
                    @endif
                </div>
                @if($game->discount_price)
                    <p>İndirim süresi: 3 gün kaldı</p>
                @endif
            </div>
            
            <div class="game-actions">
                @if(Auth::check())
                    @if(isset($hasGame) && $hasGame)
                        <div class="already-owned">
                            <div class="alert-owned">
                                <i class="fas fa-check-circle"></i> Bu oyuna zaten sahipsiniz
                            </div>
                            <a href="{{ route('library') }}" class="action-btn btn-library">
                                <i class="fas fa-gamepad"></i> Kütüphanenizde Görüntüle
                            </a>
                        </div>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                            <button type="submit" class="action-btn btn-buy">
                                <i class="fas fa-shopping-cart"></i> Sepete Ekle
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('wishlist.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <button type="submit" class="action-btn btn-wishlist">
                            <i class="fas fa-heart"></i> İstek Listesine Ekle
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="action-btn btn-buy">
                        <i class="fas fa-user"></i> Satın Almak İçin Giriş Yap
                    </a>
                    
                    <a href="{{ route('login') }}" class="action-btn btn-wishlist">
                        <i class="fas fa-heart"></i> İstek Listesi İçin Giriş Yap
                    </a>
                @endif
            </div>
            
            <div class="game-details-list">
                <div class="game-details-item">
                    <span class="detail-label">Geliştirici:</span>
                    <span>{{ $game->developer }}</span>
                </div>
                <div class="game-details-item">
                    <span class="detail-label">Yayıncı:</span>
                    <span>{{ $game->publisher }}</span>
                </div>
                <div class="game-details-item">
                    <span class="detail-label">Çıkış Tarihi:</span>
                    <span>{{ $game->release_date ? date('d F Y', strtotime($game->release_date)) : 'Belirtilmemiş' }}</span>
                </div>
                <div class="game-details-item">
                    <span class="detail-label">Platform:</span>
                    <span>PC</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function changeImage(thumbnail, newSrc) {
        // Ana görseli değiştir
        document.getElementById('mainImage').src = newSrc;
        
        // Tüm küçük resimleri pasif yap
        const thumbnails = document.querySelectorAll('.game-thumbnail');
        thumbnails.forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        // Tıklanan küçük resmi aktif yap
        thumbnail.classList.add('active');
    }
    
    function showRequirements(type) {
        // Tüm sistem gereksinimleri içerik panellerini gizle
        document.getElementById('minimum').style.display = 'none';
        document.getElementById('recommended').style.display = 'none';
        
        // Seçilen içerik panelini göster
        document.getElementById(type).style.display = 'block';
        
        // Tüm sekmeleri pasif yap
        const tabs = document.querySelectorAll('.req-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        
        // İlgili sekmeyi aktif yap
        const activeTab = Array.from(tabs).find(tab => tab.textContent.toLowerCase().includes(type));
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }
    
    function addToWishlist() {
        alert('{{ $game->title }} istek listenize eklendi!');
    }
</script>
@endsection 