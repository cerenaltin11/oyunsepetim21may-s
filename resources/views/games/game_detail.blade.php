@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', $game->title)

@section('styles')
<style>
    .container {
        max-width: 100%;
        padding: 0;
        margin: 0;
    }
    
    .game-page {
        min-height: calc(100vh - 100px);
        background-color: var(--primary-dark);
    }
    
    /* Oyun başlık alanı */
    .game-header {
        position: relative;
        padding: 2.5rem 0;
        background: linear-gradient(rgba(20, 30, 40, 0.8), rgba(20, 30, 40, 0.95)), url('{{ $game->image }}');
        background-size: cover;
        background-position: center top;
        box-shadow: inset 0 -100px 100px -100px rgba(10, 15, 20, 0.9);
    }
    
    .game-header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }
    
    .game-cover {
        width: 280px;
        height: 140px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        border: 3px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .game-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .game-title-area h1 {
        font-size: 2.8rem;
        margin-bottom: 0.5rem;
        color: white;
        font-weight: 800;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    .game-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
        max-width: 650px;
        line-height: 1.5;
    }
    
    /* Ana içerik düzeni */
    .game-content {
        display: flex;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        gap: 2rem;
    }
    
    .game-main {
        flex: 1;
        min-width: 0;
    }
    
    .game-sidebar {
        width: 300px;
        flex-shrink: 0;
    }
    
    /* Sekme gezinme */
    .tabs-wrapper {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .game-tabs {
        display: flex;
        gap: 0.5rem;
    }
    
    .game-tab {
        padding: 0.8rem 1.2rem;
        cursor: pointer;
        color: rgba(255, 255, 255, 0.6);
        font-weight: 600;
        transition: all 0.2s;
        border-radius: 6px 6px 0 0;
        position: relative;
        bottom: -1px;
    }
    
    .game-tab:hover {
        color: rgba(255, 255, 255, 0.9);
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    .game-tab.active {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-bottom: 2px solid #3cc6ff;
    }
    
    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* İşlem butonları */
    .action-card {
        background-color: rgba(20, 20, 20, 0.6);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .action-button, .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 1rem;
        border-radius: 6px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: white;
    }
    
    .play-button, .btn-play {
        background-color: #4CAF50;
    }
    
    .play-button:hover, .btn-play:hover {
        background-color: #3e8e41;
    }
    
    .install-button, .btn-download {
        background-color: #1a9fff;
    }
    
    .install-button:hover, .btn-download:hover {
        background-color: #0d8bf0;
    }
    
    .btn-library {
        background-color: #1a9fff;
        margin-right: 0.5rem;
    }
    
    .btn-library:hover {
        background-color: #0d8bf0;
    }
    
    .btn-cart {
        background-color: #4CAF50;
    }
    
    .btn-cart:hover {
        background-color: #3e8e41;
    }
    
    .btn-wishlist {
        background-color: #e57373;
        margin-left: 0.5rem;
    }
    
    .btn-wishlist:hover {
        background-color: #d32f2f;
    }

    .btn-share {
        background-color: #7e57c2;
        margin-left: 0.5rem;
    }
    
    .btn-share:hover {
        background-color: #673ab7;
    }
    
    .section-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    /* Oyun bilgileri */
    .info-card {
        background: linear-gradient(to bottom right, #202c3c, #19232e);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.2rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .storage-card {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }
    
    .storage-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(to bottom right, #3cc6ff, #6d8ef5);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.2rem;
    }
    
    .storage-info {
        flex: 1;
    }
    
    .storage-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: white;
        margin-bottom: 0.2rem;
    }
    
    .storage-subtitle {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }
    
    .storage-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
    }
    
    .info-list {
        margin: 0;
        padding: 0;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
    }
    
    .info-value {
        color: white;
        font-weight: 600;
        text-align: right;
    }
    
    /* Başarı bölümü */
    .achievements-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .achievement {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.2s;
    }
    
    .achievement:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .achievement-icon {
        width: 100%;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.3);
        filter: grayscale(1);
        opacity: 0.5;
    }
    
    .achievement-info {
        padding: 0.5rem;
        text-align: center;
    }
    
    .achievement-title {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* DLC bölümü */
    .dlc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .dlc-card {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.2s;
    }
    
    .dlc-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .dlc-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    
    .dlc-info {
        padding: 1rem;
    }
    
    .dlc-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.5rem;
    }
    
    .dlc-price {
        color: #3cc6ff;
        font-weight: 700;
    }
    
    /* Sosyal bölüm */
    .friends-list {
        margin-top: 1rem;
    }
    
    .friend-item {
        display: flex;
        align-items: center;
        padding: 0.7rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .friend-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-right: 1rem;
        background-color: rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }
    
    .friend-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .friend-info {
        flex: 1;
    }
    
    .friend-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.2rem;
    }
    
    .friend-status {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }
    
    /* Aktivite bölümü */
    .activity-card {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 1.2rem;
        margin-bottom: 1rem;
    }
    
    /* İnceleme sistemi */
    .reviews-container {
        margin-top: 1.5rem;
    }
    
    .review-stats {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .review-score {
        text-align: center;
        padding-right: 1.5rem;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .score-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #3cc6ff;
    }
    
    .score-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }
    
    .score-summary {
        flex: 1;
    }
    
    .summary-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.5rem;
    }
    
    .summary-text {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .review-form-container {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
    }
    
    .review-form-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .review-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-label {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .form-control {
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding: 0.8rem;
        color: white;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3cc6ff;
        box-shadow: 0 0 0 2px rgba(60, 198, 255, 0.2);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .rating-container {
        display: flex;
        gap: 0.5rem;
    }
    
    .rating-option {
        display: none;
    }
    
    .rating-label {
        padding: 0.5rem 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .rating-option:checked + .rating-label {
        background-color: #3cc6ff;
        color: white;
    }
    
    .submit-btn {
        background: linear-gradient(to right, #3cc6ff, #6d8ef5);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        align-self: flex-start;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(60, 198, 255, 0.3);
    }
    
    .review-list {
        margin-top: 2rem;
    }
    
    .review-item {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 1.2rem;
        margin-bottom: 1rem;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .reviewer-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .reviewer-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .reviewer-name {
        font-weight: 600;
        color: white;
    }
    
    .review-date {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
    }
    
    .review-rating {
        background-color: rgba(60, 198, 255, 0.1);
        color: #3cc6ff;
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .review-rating.positive {
        background-color: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
    }
    
    .review-rating.negative {
        background-color: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }
    
    .review-content {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }
    
    .review-images {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }
    
    .review-image {
        width: 160px;
        height: 90px;
        border-radius: 6px;
        object-fit: cover;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .review-image:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }
    
    .review-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        padding-top: 0.7rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .review-actions {
        display: flex;
        gap: 1rem;
    }
    
    .action-btn {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    
    .action-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .action-btn.active {
        background-color: rgba(60, 198, 255, 0.1);
        color: #3cc6ff;
        border-color: rgba(60, 198, 255, 0.3);
    }
    
    .review-helpful {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }
    
    .dropzone {
        border: 2px dashed rgba(60, 198, 255, 0.3);
        border-radius: 6px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background-color: rgba(0, 0, 0, 0.2);
    }
    
    .dropzone:hover {
        border-color: #3cc6ff;
        background-color: rgba(60, 198, 255, 0.05);
    }
    
    .dropzone-icon {
        font-size: 2rem;
        color: rgba(60, 198, 255, 0.5);
        margin-bottom: 0.5rem;
    }
    
    .dropzone-text {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .preview-item {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 6px;
        overflow: hidden;
    }
    
    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .preview-remove {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .preview-remove:hover {
        background-color: rgba(231, 76, 60, 1);
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    /* Responsive düzenlemeler */
    @media (max-width: 992px) {
        .game-content {
            flex-direction: column;
        }
        
        .game-sidebar {
            width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        .game-header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .game-title-area h1 {
            font-size: 2.2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="game-page">
    <!-- Oyun başlık bölümü -->
    <header class="game-header">
        <div class="game-header-content">
            <div class="game-cover">
                <img src="{{ $game->image }}" alt="{{ $game->title }}">
            </div>
            <div class="game-title-area">
                <h1>{{ $game->title }}</h1>
                <p class="game-subtitle">{{ Str::limit($game->description, 150) }}</p>
            </div>
        </div>
    </header>
    
    <!-- Öneri kartı -->
    <div style="background: linear-gradient(to right, rgba(32, 44, 60, 0.8), rgba(41, 128, 185, 0.4)); padding: 1rem; margin: 0 2rem; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div>
            <h3 style="margin: 0 0 0.5rem 0; color: white; font-weight: 600;">Bu oyunu öneriyor musunuz?</h3>
            <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">Deneyiminizi paylaşın ve topluluğun bir parçası olun</p>
        </div>
        <button onclick="scrollToReviewTab()" style="background: linear-gradient(to right, #3cc6ff, #6d8ef5); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
            <i class="fas fa-pencil-alt"></i>&nbsp; İnceleme Yaz
        </button>
    </div>
    
    <!-- Ana içerik bölümü -->
    <div class="game-content">
        <div class="game-main">
            <!-- Sekmeler -->
            <div class="tabs-wrapper">
                <div class="game-tabs">
                    <div class="game-tab active" data-tab="activity">Aktivite</div>
                    <div class="game-tab" data-tab="achievements">Başarılar</div>
                    <div class="game-tab" data-tab="dlc">İçerik Paketleri</div>
                    <div class="game-tab" data-tab="reviews">İncelemeler</div>
                    <div class="game-tab" data-tab="news">Haberler</div>
                </div>
            </div>
            
            <!-- Sekme içerikleri -->
            <div class="tab-content active" id="activity-content">
                <div class="activity-card">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-label">Son oynama</div>
                            <div class="stat-value">Hiç oynamadınız</div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="stat-details">
                            <div class="stat-label">Toplam oynama süresi</div>
                            <div class="stat-value">0 saat</div>
                        </div>
                    </div>
                </div>
                
                <p>İlk kez oynamak için oyunu indirin ve başlatın. Oyun aktiviteniz burada gösterilecektir.</p>
            </div>
            
            <div class="tab-content" id="achievements-content">
                <div class="card-title">Başarılar (0/{{ random_int(10, 30) }})</div>
                <p>Bu oyunda ilerlemenizi takip etmek için başarılar kazanın.</p>
                
                <div class="achievements-grid">
                    @for ($i = 0; $i < 12; $i++)
                        <div class="achievement">
                            <div class="achievement-icon">
                                <i class="fas fa-question" style="font-size: 24px; color: rgba(255,255,255,0.3);"></i>
                            </div>
                            <div class="achievement-info">
                                <div class="achievement-title">Gizli Başarı</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            
            <div class="tab-content" id="dlc-content">
                <div class="card-title">Mevcut İçerik Paketleri</div>
                <p>{{ $game->title }} için ek içerikler ve genişletme paketleri.</p>
                
                <div class="dlc-grid">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="dlc-card">
                            <img src="https://via.placeholder.com/300x150/333/666" alt="DLC" class="dlc-image">
                            <div class="dlc-info">
                                <div class="dlc-title">{{ $game->title }} - Genişletme Paketi {{ $i + 1 }}</div>
                                <div class="dlc-price">₺{{ rand(30, 120) }}</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            
            <div class="tab-content" id="news-content">
                <div class="card-title">Son Güncellemeler ve Haberler</div>
                <p>Bu oyun için henüz haber bulunmuyor. Güncellemeler ve duyurular burada görüntülenecektir.</p>
            </div>

            <div class="tab-content" id="reviews-content">
                <div class="reviews-container">
                    <!-- İnceleme özeti -->
                    <div class="review-stats">
                        <div class="review-score">
                            <div class="score-value">{{ isset($reviews) && count($reviews) > 0 ? round(($reviews->where('is_recommended', 1)->count() / $reviews->count()) * 100) : 0 }}%</div>
                            <div class="score-label">Olumlu</div>
                        </div>
                        <div class="score-summary">
                            <div class="summary-title">{{ isset($reviews) ? count($reviews) : 0 }} kullanıcı incelemesi</div>
                            <div class="summary-text">
                                @if(isset($reviews) && count($reviews) > 0)
                                    @if(($reviews->where('is_recommended', 1)->count() / $reviews->count()) > 0.7)
                                        Çok Olumlu
                                    @elseif(($reviews->where('is_recommended', 1)->count() / $reviews->count()) > 0.4)
                                        Çoğunlukla Olumlu
                                    @elseif(($reviews->where('is_recommended', 1)->count() / $reviews->count()) > 0.2)
                                        Karma
                                    @else
                                        Çoğunlukla Olumsuz
                                    @endif
                                @else
                                    Henüz inceleme yok
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- İnceleme yazma formu -->
                    @auth
                    <div class="review-form-container">
                        <div class="review-form-title">İnceleme Yaz</div>
                        <form action="{{ route('reviews.store') }}" method="POST" class="review-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="game_id" value="{{ $game->id }}">

                            <div class="form-group">
                                <label class="form-label">Değerlendirme</label>
                                <div class="rating-container">
                                    <input type="radio" name="is_recommended" id="rating-yes" value="1" class="rating-option">
                                    <label for="rating-yes" class="rating-label">
                                        <i class="fas fa-thumbs-up"></i> Öneriyorum
                                    </label>
                                    
                                    <input type="radio" name="is_recommended" id="rating-no" value="0" class="rating-option">
                                    <label for="rating-no" class="rating-label">
                                        <i class="fas fa-thumbs-down"></i> Önermiyorum
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="review-content" class="form-label">İncelemeniz</label>
                                <textarea name="content" id="review-content" class="form-control" placeholder="Bu oyun hakkında ne düşünüyorsunuz?"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Görsel Ekleyin (İsteğe Bağlı)</label>
                                <div class="dropzone" id="review-images-dropzone">
                                    <div class="dropzone-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="dropzone-text">
                                        Görsel eklemek için tıklayın veya sürükleyin (maksimum 3 görsel)
                                    </div>
                                </div>
                                <div class="preview-container" id="preview-container"></div>
                                <input type="file" name="images[]" id="review-images" style="display:none" multiple accept="image/*">
                            </div>

                            <button type="submit" class="submit-btn">İnceleme Gönder</button>
                        </form>
                    </div>
                    @else
                    <div class="review-form-container">
                        <div class="review-form-title">İnceleme Yaz</div>
                        <p>İnceleme yazabilmek için <a href="{{ route('login') }}" style="color:#3cc6ff; text-decoration:none;">giriş yapmalısınız</a>.</p>
                    </div>
                    @endauth

                    <!-- İnceleme listesi -->
                    <div class="review-list">
                        @if(isset($reviews) && count($reviews) > 0)
                            @foreach($reviews as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">
                                                @if($review->user->photo)
                                                    <img src="{{ asset('storage/profiles/' . $review->user->photo) }}" alt="{{ $review->user->name }}">
                                                @else
                                                    <i class="fas fa-user" style="color:rgba(255,255,255,0.7); font-size:18px;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="reviewer-name">{{ $review->user->name }}</div>
                                                <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                        <div class="review-rating {{ $review->is_recommended ? 'positive' : 'negative' }}">
                                            <i class="fas fa-{{ $review->is_recommended ? 'thumbs-up' : 'thumbs-down' }}"></i>
                                            {{ $review->is_recommended ? 'Öneriliyor' : 'Önerilmiyor' }}
                                        </div>
                                    </div>
                                    <div class="review-content">
                                        {{ $review->content }}
                                    </div>
                                    @if($review->images && count($review->images) > 0)
                                        <div class="review-images">
                                            @foreach($review->images as $image)
                                                <img src="{{ asset('storage/reviews/' . $image) }}" class="review-image" alt="İnceleme Görseli" data-lightbox="review-{{ $review->id }}">
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="review-footer">
                                        <div class="review-actions">
                                            <form action="{{ route('reviews.helpful', $review->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="action-btn {{ $review->helpful_count > 0 ? 'active' : '' }}">
                                                    <i class="fas fa-thumbs-up"></i> Yararlı
                                                </button>
                                            </form>
                                            @auth
                                                @if(Auth::id() == $review->user_id)
                                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bu incelemeyi silmek istediğinize emin misiniz?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="action-btn">
                                                            <i class="fas fa-trash-alt"></i> Sil
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="review-helpful">
                                            {{ $review->helpful_count }} kişi bu incelemeyi yararlı buldu
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="review-item">
                                <p>Bu oyun için henüz inceleme yapılmamış. İlk inceleyen siz olun!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="game-sidebar">
            <!-- Oyun aksiyon butonları -->
            <div class="action-card">
                <div class="section-buttons">
                    <a href="{{ route('library.download', ['gameId' => $game->id]) }}" class="action-btn btn-download">
                        <i class="fas fa-download"></i> Yükle
                    </a>
                    <a href="#" class="action-btn btn-share">
                        <i class="fas fa-share-alt"></i> Paylaş
                    </a>
                </div>
            </div>
            
            <!-- Depolama bilgileri -->
            <div class="info-card">
                <div class="storage-card">
                    <div class="storage-icon">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="storage-info">
                        <div class="storage-title">DEPOLAMA</div>
                        <div class="storage-subtitle">Boş alan: {{ rand(100, 500) }} GB</div>
                    </div>
                    <div class="storage-value">{{ rand(30, 150) }} GB</div>
                </div>
            </div>
            
            <!-- Oyun bilgileri -->
            <div class="info-card">
                <div class="card-title">Oyun Bilgileri</div>
                
                <ul class="info-list">
                    <li class="info-item">
                        <div class="info-label">Geliştirici</div>
                        <div class="info-value">{{ $game->developer }}</div>
                    </li>
                    <li class="info-item">
                        <div class="info-label">Yayıncı</div>
                        <div class="info-value">{{ $game->publisher }}</div>
                    </li>
                    <li class="info-item">
                        <div class="info-label">Çıkış Tarihi</div>
                        <div class="info-value">{{ $game->release_date ? date('d.m.Y', strtotime($game->release_date)) : 'Belirtilmemiş' }}</div>
                    </li>
                    <li class="info-item">
                        <div class="info-label">Son Oynama</div>
                        <div class="info-value">-</div>
                    </li>
                    <li class="info-item">
                        <div class="info-label">Platform</div>
                        <div class="info-value">PC</div>
                    </li>
                </ul>
            </div>
            
            <!-- Arkadaşlar bölümü -->
            <div class="info-card">
                <div class="card-title">Arkadaşlar</div>
                <p>Bu oyunu oynayan arkadaşınız henüz yok.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sekme değiştirme fonksiyonu
        const tabs = document.querySelectorAll('.game-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Tüm tabları ve içerikleri pasif yap
                document.querySelectorAll('.game-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Tıklanan tabı ve ilgili içeriği aktif yap
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId + '-content').classList.add('active');
            });
        });
        
        // İnceleme sekmesine kaydırma fonksiyonu
        window.scrollToReviewTab = function() {
            // İnceleme sekmesini aktif et
            document.querySelectorAll('.game-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            const reviewTab = document.querySelector('.game-tab[data-tab="reviews"]');
            reviewTab.classList.add('active');
            document.getElementById('reviews-content').classList.add('active');
            
            // İnceleme sekmesine kaydır
            reviewTab.scrollIntoView({ behavior: 'smooth' });
            
            // İnceleme formuna odaklan
            setTimeout(() => {
                const reviewForm = document.querySelector('#review-content');
                if (reviewForm) {
                    reviewForm.focus();
                }
            }, 800);
        };
        
        // Görsel yükleme işlevselliği
        const dropzone = document.getElementById('review-images-dropzone');
        const fileInput = document.getElementById('review-images');
        const previewContainer = document.getElementById('preview-container');
        
        if (dropzone && fileInput) {
            // Dosya seçici açma
            dropzone.addEventListener('click', () => {
                fileInput.click();
            });
            
            // Sürükle bırak olayları
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.style.borderColor = '#3cc6ff';
                dropzone.style.backgroundColor = 'rgba(60, 198, 255, 0.05)';
            });
            
            dropzone.addEventListener('dragleave', () => {
                dropzone.style.borderColor = 'rgba(60, 198, 255, 0.3)';
                dropzone.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
            });
            
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.style.borderColor = 'rgba(60, 198, 255, 0.3)';
                dropzone.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
                
                if (e.dataTransfer.files.length > 0) {
                    handleFiles(e.dataTransfer.files);
                }
            });
            
            // Dosya eklendiğinde önizlemeleri oluştur
            fileInput.addEventListener('change', () => {
                handleFiles(fileInput.files);
            });
            
            function handleFiles(files) {
                // Maksimum 3 dosya kontrolü
                if (document.querySelectorAll('.preview-item').length + files.length > 3) {
                    alert('En fazla 3 görsel yükleyebilirsiniz.');
                    return;
                }
                
                // Her dosya için önizleme oluştur
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    
                    // Sadece görselleri kabul et
                    if (!file.type.startsWith('image/')) {
                        continue;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'preview-image';
                        
                        const removeBtn = document.createElement('div');
                        removeBtn.className = 'preview-remove';
                        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                        removeBtn.addEventListener('click', function() {
                            previewItem.remove();
                        });
                        
                        previewItem.appendChild(img);
                        previewItem.appendChild(removeBtn);
                        previewContainer.appendChild(previewItem);
                    };
                    
                    reader.readAsDataURL(file);
                }
            }
        }
        
        // İnceleme görselleri için lightbox
        const reviewImages = document.querySelectorAll('.review-image');
        if (reviewImages.length > 0) {
            reviewImages.forEach(img => {
                img.addEventListener('click', function() {
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
                    
                    const modalImg = document.createElement('img');
                    modalImg.src = this.src;
                    modalImg.style.maxWidth = '90%';
                    modalImg.style.maxHeight = '90%';
                    modalImg.style.objectFit = 'contain';
                    modalImg.style.boxShadow = '0 0 20px rgba(0, 0, 0, 0.5)';
                    
                    modal.appendChild(modalImg);
                    document.body.appendChild(modal);
                    
                    modal.addEventListener('click', function() {
                        modal.remove();
                    });
                });
            });
        }
    });
</script>
@endsection
