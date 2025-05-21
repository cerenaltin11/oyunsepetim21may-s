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
    
    /* İnceleme sistemi stilleri */
    .review-recommendation-card {
        background: linear-gradient(to right, rgba(22, 31, 48, 0.95), rgba(32, 42, 68, 0.95));
        margin: 2rem 0;
        padding: 1.5rem;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .review-card-content h3 {
        margin: 0 0 0.6rem 0;
        color: white;
        font-weight: 700;
        font-size: 1.3rem;
    }
    
    .review-card-content p {
        margin: 0;
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
    }
    
    .review-button {
        background: linear-gradient(to right, #3498db, #2980b9);
        color: white;
        border: none;
        padding: 0.9rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }
    
    .review-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(52, 152, 219, 0.4);
        background: linear-gradient(to right, #2980b9, #3498db);
    }
    
    .review-section {
        margin-top: 3rem;
    }
    
    .review-form {
        background: linear-gradient(to bottom, rgba(32, 42, 68, 0.7), rgba(22, 31, 48, 0.7));
        border-radius: 12px;
        padding: 1.8rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .review-form-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.4rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.7rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem;
    }
    
    .modern-radio-group {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.2rem;
    }
    
    .modern-radio {
        display: none;
    }
    
    .modern-radio-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.2rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .modern-radio:checked + .modern-radio-label {
        background-color: rgba(52, 152, 219, 0.2);
        border-color: rgba(52, 152, 219, 0.4);
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.3);
    }
    
    .modern-radio-label.positive {
        color: rgba(46, 204, 113, 0.9);
    }
    
    .modern-radio-label.negative {
        color: rgba(231, 76, 60, 0.9);
    }
    
    .modern-radio:checked + .modern-radio-label.positive {
        background-color: rgba(46, 204, 113, 0.2);
        border-color: rgba(46, 204, 113, 0.4);
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.3);
    }
    
    .modern-radio:checked + .modern-radio-label.negative {
        background-color: rgba(231, 76, 60, 0.2);
        border-color: rgba(231, 76, 60, 0.4);
        box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.3);
    }
    
    .form-control {
        width: 100%;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: white;
        font-size: 1rem;
        transition: all 0.2s;
        resize: vertical;
    }
    
    .form-control:focus {
        outline: none;
        border-color: rgba(52, 152, 219, 0.6);
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }
    
    .file-upload {
        width: 100%;
        position: relative;
    }
    
    .file-upload-btn {
        display: block;
        width: 100%;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: white;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .file-upload-btn:hover {
        background-color: rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.2);
    }
    
    .file-upload input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .file-upload-info {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }
    
    .review-submit {
        background: linear-gradient(to right, #3498db, #2980b9);
        color: white;
        border: none;
        padding: 1rem 1.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }
    
    .review-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(52, 152, 219, 0.4);
        background: linear-gradient(to right, #2980b9, #3498db);
    }
    
    .review-list {
        margin-top: 2.5rem;
    }
    
    .review-item {
        background: linear-gradient(to bottom, rgba(32, 42, 68, 0.7), rgba(22, 31, 48, 0.7));
        border-radius: 12px;
        padding: 1.8rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .review-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .review-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        background-color: rgba(52, 152, 219, 0.2);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }
    
    .review-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .review-user-info {
        display: flex;
        flex-direction: column;
    }
    
    .review-user-name {
        font-weight: 600;
        font-size: 1.05rem;
        color: white;
    }
    
    .review-date {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .review-rating {
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .review-rating.positive {
        color: rgba(46, 204, 113, 1);
        background-color: rgba(46, 204, 113, 0.1);
        border: 1px solid rgba(46, 204, 113, 0.3);
    }
    
    .review-rating.negative {
        color: rgba(231, 76, 60, 1);
        background-color: rgba(231, 76, 60, 0.1);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }
    
    .review-content {
        margin-bottom: 1.2rem;
        line-height: 1.6;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .review-images {
        display: flex;
        gap: 1rem;
        margin: 1.2rem 0;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        scrollbar-width: thin;
        scrollbar-color: rgba(52, 152, 219, 0.5) rgba(0, 0, 0, 0.2);
    }
    
    .review-images::-webkit-scrollbar {
        height: 6px;
    }
    
    .review-images::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }
    
    .review-images::-webkit-scrollbar-thumb {
        background-color: rgba(52, 152, 219, 0.5);
        border-radius: 10px;
    }
    
    .review-image {
        width: 180px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.05);
    }
    
    .review-image:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
    }
    
    .review-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .review-helpful {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .review-helpful-button {
        background-color: rgba(52, 152, 219, 0.1);
        border: 1px solid rgba(52, 152, 219, 0.3);
        color: rgba(255, 255, 255, 0.9);
        padding: 0.6rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        font-weight: 500;
    }
    
    .review-helpful-button:hover {
        background-color: rgba(52, 152, 219, 0.2);
        transform: translateY(-1px);
    }
    
    .review-helpful-button.active {
        background-color: rgba(52, 152, 219, 0.3);
        border-color: rgba(52, 152, 219, 0.5);
    }
    
    .review-delete-button {
        background-color: rgba(231, 76, 60, 0.1);
        border: 1px solid rgba(231, 76, 60, 0.3);
        color: rgba(231, 76, 60, 0.9);
        padding: 0.6rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        font-weight: 500;
    }
    
    .review-delete-button:hover {
        background-color: rgba(231, 76, 60, 0.2);
        transform: translateY(-1px);
    }
    
    .review-helpful-count {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    
    .review-helpful-count i {
        color: rgba(52, 152, 219, 0.8);
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
            
            <!-- Öneri kartı -->
            <div class="review-recommendation-card">
                <div class="review-card-content">
                    <h3>Bu oyunu öneriyor musunuz?</h3>
                    <p>Deneyiminizi paylaşarak diğer oyunculara yardımcı olun</p>
                </div>
                <button onclick="scrollToReviews()" class="review-button">
                    <i class="fas fa-pencil-alt"></i> İnceleme Yaz
                </button>
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
            
            <!-- İnceleme bölümü -->
            <div class="review-section" id="reviewSection">
                <h3 class="section-title">Kullanıcı İncelemeleri</h3>
                
                <!-- İnceleme yazma daveti kartı -->
                <div style="background: linear-gradient(to right, rgba(22, 31, 48, 0.95), rgba(32, 42, 68, 0.95)); border-radius: 12px; padding: 2rem; margin-bottom: 2.5rem; text-align: center; border: 1px solid rgba(52, 152, 219, 0.2); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);">
                    <h3 style="margin-top: 0; margin-bottom: 1rem; color: white; font-size: 1.5rem;">Bu oyunu oynadınız mı?</h3>
                    <p style="margin-bottom: 1.5rem; color: rgba(255, 255, 255, 0.8); font-size: 1.1rem;">
                        Deneyiminizi diğer oyuncularla paylaşın ve oyun hakkındaki düşüncelerinizi belirtin
                    </p>
                    
                    <div style="display: flex; justify-content: center; margin: 0 auto;">
                        @auth
                            @if(isset($hasGame) && $hasGame)
                                <a href="{{ route('reviews.create', ['game_id' => $game->id]) }}" class="action-btn" style="background: linear-gradient(to right, #3498db, #2980b9); color: white; padding: 1rem 2rem; display: inline-block; border-radius: 8px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); transition: all 0.3s; width: auto; max-width: 200px; text-align: center;">
                                    <i class="fas fa-pencil-alt" style="margin-right: 0.5rem;"></i> İnceleme Yaz
                                </a>
                            @else
                                <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                                    <div style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1rem;">İnceleme yazabilmek için oyuna sahip olmalısınız</div>
                                    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                                        @if(($game->price == 0) || ($game->discount_price !== null && $game->discount_price == 0))
                                            <form action="{{ route('library.add_direct') }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                                <button type="submit" class="action-btn btn-library">
                                                    <i class="fas fa-plus-circle"></i> Ücretsiz Oyunu Kütüphaneye Ekle
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('cart.add') }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                                <button type="submit" class="action-btn btn-buy">
                                                    <i class="fas fa-shopping-cart"></i> Satın Al
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @else
                            <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                                <div style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1rem;">İnceleme yazabilmek için giriş yapmalısınız</div>
                                <a href="{{ route('login') }}" class="action-btn btn-buy" style="width: auto; min-width: 150px; max-width: 200px;">
                                    <i class="fas fa-sign-in-alt"></i> Giriş Yap
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
                
                <!-- İnceleme listesi -->
                <div class="review-list">
                    @if(isset($reviews) && count($reviews) > 0)
                        @foreach($reviews as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="review-info">
                                        <div class="review-avatar">
                                            @if($review->user->photo)
                                                <img src="{{ asset('storage/profiles/' . $review->user->photo) }}" alt="{{ $review->user->name }}">
                                            @else
                                                <i class="fas fa-user" style="font-size: 20px; display: flex; justify-content: center; align-items: center; height: 100%; color: var(--text-gray);"></i>
                                            @endif
                                        </div>
                                        <div class="review-user-info">
                                            <div class="review-user-name">{{ $review->user->name }}</div>
                                            <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="review-rating {{ $review->is_recommended ? 'positive' : 'negative' }}">
                                        <i class="fas fa-{{ $review->is_recommended ? 'thumbs-up' : 'thumbs-down' }}"></i>
                                        {{ $review->is_recommended ? 'Öneriyor' : 'Önermiyör' }}
                                    </div>
                                </div>
                                <div class="review-content">
                                    {{ $review->content }}
                                </div>
                                
                                @if($review->images && count($review->images) > 0)
                                    <div class="review-images">
                                        @foreach($review->images as $image)
                                            <img src="{{ asset('storage/reviews/' . $image) }}" alt="İnceleme Görseli" class="review-image" onclick="openImageModal(this.src)">
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div class="review-footer">
                                    @auth
                                        @if($review->user_id !== Auth::id())
                                            <form action="{{ route('reviews.helpful', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="review-helpful-button">
                                                    <i class="fas fa-thumbs-up"></i> Yararlı
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bu incelemeyi silmek istediğinize emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="review-helpful-button" style="background-color: #f44336;">
                                                    <i class="fas fa-trash-alt"></i> İncelemeyi Sil
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                    <div class="review-helpful-count">
                                        {{ $review->helpful_count }} kişi bu incelemeyi yararlı buldu
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="background-color: var(--secondary-dark); padding: 1.5rem; border-radius: 8px; text-align: center;">
                            <p>Bu oyun için henüz inceleme yapılmamış. İlk incelemeyi siz yazın!</p>
                        </div>
                    @endif
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
                            <a href="{{ route('library.game', ['gameId' => $game->id]) }}" class="action-btn btn-library">
                                <i class="fas fa-gamepad"></i> Kütüphanenizde Görüntüle
                            </a>
                        </div>
                    @else
                        @if(($game->price == 0) || ($game->discount_price !== null && $game->discount_price == 0))
                            <!-- For free games, add directly to library -->
                            <form action="{{ route('library.add_direct') }}" method="POST">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <button type="submit" class="action-btn btn-library">
                                    <i class="fas fa-plus-circle"></i> Kütüphaneye Ekle
                                </button>
                            </form>
                        @else
                            <!-- For paid games, add to cart -->
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <button type="submit" class="action-btn btn-buy">
                                    <i class="fas fa-shopping-cart"></i> Sepete Ekle
                                </button>
                            </form>
                        @endif
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
    
    // İnceleme bölümüne kaydırma
    function scrollToReviews() {
        const reviewSection = document.getElementById('reviewSection');
        if (reviewSection) {
            reviewSection.scrollIntoView({ behavior: 'smooth' });
            
            // İnceleme formu varsa, textarea'ya odaklan
            setTimeout(() => {
                const reviewContentTextarea = document.getElementById('review-content');
                if (reviewContentTextarea) {
                    reviewContentTextarea.focus();
                }
            }, 800);
        }
    }
    
    // Görsel modalı
    function openImageModal(imageSrc) {
        const modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '9999';
        modal.style.cursor = 'pointer';
        
        const img = document.createElement('img');
        img.src = imageSrc;
        img.style.maxWidth = '90%';
        img.style.maxHeight = '90%';
        img.style.objectFit = 'contain';
        img.style.boxShadow = '0 0 20px rgba(0, 0, 0, 0.5)';
        
        modal.appendChild(img);
        document.body.appendChild(modal);
        
        // Dokümana ESC ve tıklama olay dinleyicileri ekle
        const closeModal = () => {
            document.body.removeChild(modal);
            document.removeEventListener('keydown', escKeyHandler);
        };
        
        const escKeyHandler = (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        };
        
        modal.addEventListener('click', closeModal);
        document.addEventListener('keydown', escKeyHandler);
    }
</script>
@endsection 