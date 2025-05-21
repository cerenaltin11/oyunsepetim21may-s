@extends('layouts.app')

@section('title', 'Topluluk')

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
    }
    
    body {
        background-color: var(--primary-dark);
    }
    
    /* Tab content style rules */
    .tab-pane {
        display: none;
    }
    
    .tab-pane.show {
        display: block;
    }
    
    /* Alt sekmeler için stil tanımları */
    .content-tabs {
        display: flex;
        background: var(--accent-dark);
        border-bottom: 1px solid var(--border-color);
        overflow-x: auto;
        padding: 0 8px;
        margin-bottom: 16px;
    }

    .content-tab {
        padding: 10px 16px;
        color: var(--text-gray);
        background: transparent;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .content-tab:hover {
        color: var(--text-light);
    }

    .content-tab.active {
        color: var(--accent-color);
        box-shadow: inset 0 -2px 0 var(--accent-color);
        background-color: rgba(26, 159, 255, 0.1);
    }
    
    .community-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .community-header {
        margin-bottom: 24px;
    }
    
    .community-title {
        color: var(--text-light);
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .community-desc {
        color: var(--text-gray);
        font-size: 1rem;
    }
    
    .community-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 24px;
    }
    
    /* Sidebar Styles */
    .community-sidebar {
        position: sticky;
        top: 20px;
    }
    
    .sidebar-box {
        background: var(--secondary-dark);
        border-radius: 4px;
        padding: 16px;
        margin-bottom: 16px;
    }
    
    .sidebar-title {
        color: var(--text-light);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .sidebar-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-list li {
        margin-bottom: 12px;
    }
    
    .sidebar-list li:last-child {
        margin-bottom: 0;
    }
    
    .sidebar-list a {
        display: flex;
        color: var(--text-gray);
        text-decoration: none;
        transition: color 0.2s;
        align-items: center;
        gap: 10px;
    }
    
    .sidebar-list a:hover {
        color: var(--accent-color);
    }
    
    .sidebar-list .game-img {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
    }
    
    .sidebar-item-details {
        flex: 1;
    }
    
    .sidebar-list .game-title {
        display: block;
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    .sidebar-list .game-stats {
        display: block;
        color: var(--text-gray);
        font-size: 0.8rem;
        margin-top: 2px;
    }
    
    /* Main Content Styles */
    .community-main {
        background: var(--secondary-dark);
        border-radius: 4px;
        min-height: 500px;
    }
    
    .content-header {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .content-title {
        color: var(--text-light);
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .content-filter {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .filter-label {
        color: var(--text-gray);
        font-size: 0.9rem;
    }
    
    .filter-select {
        background-color: var(--accent-dark);
        color: var(--text-light);
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
    }
    
    .community-tabs {
        display: flex;
        border-bottom: 1px solid var(--border-color);
        background: var(--accent-dark);
        overflow-x: auto;
        padding: 0 8px;
    }
    
    .community-tab {
        padding: 12px 16px;
        color: var(--text-gray);
        background: transparent;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        text-decoration: none;
        display: inline-block;
    }
    
    .community-tab:hover {
        color: var(--text-light);
        text-decoration: none;
    }
    
    .community-tab.active {
        color: var(--accent-color);
        box-shadow: inset 0 -2px 0 var(--accent-color);
    }
    
    .community-content {
        padding: 16px;
        min-height: 300px;
    }
    
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }
    
    .content-item {
        background-color: var(--accent-dark);
        border-radius: 4px;
        overflow: hidden;
        transition: transform 0.2s;
        position: relative;
    }
    
    .content-item:hover {
        transform: translateY(-4px);
    }
    
    .content-item img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    
    .content-item-info {
        padding: 12px;
    }
    
    .content-item-title {
        font-size: 0.95rem;
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .content-item-game {
        font-size: 0.8rem;
        color: var(--accent-color);
    }
    
    .content-item-meta {
        margin-top: 8px;
        display: flex;
        justify-content: space-between;
        color: var(--text-gray);
        font-size: 0.8rem;
    }
    
    .content-item-user {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .content-item-avatar {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: var(--accent-color);
        overflow: hidden;
    }
    
    .content-item-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .content-item-stats {
        display: flex;
        gap: 8px;
    }
    
    .content-item-stat {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .no-content {
        padding: 48px 0;
        text-align: center;
        color: var(--text-gray);
    }
    
    .no-content i {
        font-size: 3rem;
        margin-bottom: 16px;
        color: var(--accent-color);
    }
    
    .no-content p {
        font-size: 1rem;
    }
    
    .btn-post {
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-post:hover {
        background-color: var(--accent-hover);
        color: white;
    }
    
    .discussion-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .discussion-item {
        background-color: var(--accent-dark);
        border-radius: 4px;
        padding: 12px;
        display: flex;
        justify-content: space-between;
    }
    
    .discussion-info {
        flex: 1;
    }
    
    .discussion-title {
        color: var(--text-light);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .discussion-meta {
        color: var(--text-gray);
        font-size: 0.8rem;
        display: flex;
        gap: 12px;
    }
    
    .discussion-stats {
        min-width: 100px;
        text-align: right;
        color: var(--text-gray);
        font-size: 0.9rem;
    }
    
    /* Workshop content */
    .workshop-item {
        background-color: var(--accent-dark);
        border-radius: 4px;
        overflow: hidden;
    }
    
    .workshop-item-banner {
        position: relative;
        width: 100%;
        height: 160px;
    }
    
    .workshop-item-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .workshop-item-info {
        padding: 16px;
    }
    
    .workshop-item-title {
        color: var(--text-light);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .workshop-item-desc {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .workshop-item-meta {
        display: flex;
        justify-content: space-between;
        color: var(--text-gray);
        font-size: 0.8rem;
    }
    
    .workshop-item-author {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .workshop-item-author img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
    }
    
    .workshop-item-stats {
        display: flex;
        gap: 12px;
    }
    
    .workshop-stat {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    @media (max-width: 992px) {
        .community-layout {
            grid-template-columns: 1fr;
        }
        
        .community-sidebar {
            position: static;
        }
        
        .sidebar-box {
            margin-bottom: 16px;
        }
    }
    
    /* Ekran görüntüsünde görünen sekme menüsünü ekliyorum */
    .tab-content {
        display: flex;
        background: #333;
        border-bottom: 1px solid var(--border-color);
        overflow-x: auto;
        padding: 0;
        margin-bottom: 16px;
    }

    .tab-button {
        padding: 10px 16px;
        color: var(--text-gray);
        background: transparent;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .tab-button:hover {
        color: var(--text-light);
    }

    .tab-button.active {
        color: var(--accent-color);
        box-shadow: inset 0 -2px 0 var(--accent-color);
        background-color: rgba(26, 159, 255, 0.1);
    }
</style>
@endsection

@section('content')
<div class="community-container">
    <div class="community-header">
        <h1 class="community-title">Topluluk Merkezi</h1>
        <p class="community-desc">Oyunlar hakkında içerikler, tartışmalar ve daha fazlası.</p>
    </div>

    <div class="community-layout">
        <aside class="community-sidebar">
            <div class="sidebar-box">
                <h3 class="sidebar-title">En Son Oynadıklarınız</h3>
                <ul class="sidebar-list">
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">War Thunder</span>
                                <span class="game-stats">6 yeni rehber bu hafta</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">Half-Life</span>
                                <span class="game-stats">11 yeni çizim bu hafta</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">Counter-Strike 2</span>
                                <span class="game-stats">319 yeni çizim bu hafta</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-box">
                <h3 class="sidebar-title">Popüler Topluluk Merkezleri</h3>
                <ul class="sidebar-list">
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">Cyberpunk 2077</span>
                                <span class="game-stats">2.431 aktif tartışma</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">GTA V</span>
                                <span class="game-stats">1.208 yeni mod bu hafta</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="Game" class="game-img">
                            <div class="sidebar-item-details">
                                <span class="game-title">Baldur's Gate 3</span>
                                <span class="game-stats">547 yeni ekran görüntüsü</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="sidebar-box">
                <h3 class="sidebar-title">Arkadaşlarınızın Etkinlikleri</h3>
                <ul class="sidebar-list">
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="User" class="game-img" style="border-radius: 50%">
                            <div class="sidebar-item-details">
                                <span class="game-title">Ahmet K.</span>
                                <span class="game-stats">Yeni bir rehber paylaştı: "Skyrim Başlangıç Rehberi"</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://via.placeholder.com/40" alt="User" class="game-img" style="border-radius: 50%">
                            <div class="sidebar-item-details">
                                <span class="game-title">Mehmet A.</span>
                                <span class="game-stats">3 yeni ekran görüntüsü ekledi</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="community-main">
            <div class="content-header">
                <h2 class="content-title">Topluluk İçerikleri</h2>
                <div class="content-filter">
                    <span class="filter-label">Sırala:</span>
                    <select class="filter-select">
                        <option>En Yeniler</option>
                        <option>En Popülerler</option>
                        <option>Trend Olanlar</option>
                    </select>
                </div>
            </div>
            
            <div class="community-tabs">
                <a class="community-tab active" data-tab="all" href="#all-content">Tümü</a>
                <a class="community-tab" data-tab="screenshots" href="#screenshots-content">Ekran Görüntüleri</a>
                <a class="community-tab" data-tab="artwork" href="#artwork-content">Çizimler</a>
                <a class="community-tab" data-tab="videos" href="#videos-content">Videolar</a>
                <a class="community-tab" data-tab="workshop" href="#workshop-content">Atölye</a>
                <a class="community-tab" data-tab="guides" href="#guides-content">Rehberler</a>
                <a class="community-tab" data-tab="news" href="#news-content">Haberler</a>
                <a class="community-tab" data-tab="discussions" href="#discussions-content">Tartışmalar</a>
            </div>
            
            <div class="community-content">
                <!-- Tümü tab içeriği -->
                <div class="tab-pane active" id="all-content">
                    <div class="content-grid">
                        <!-- Ekran görüntüsü -->
                        <div class="content-item">
                            <img src="https://via.placeholder.com/300x160" alt="Screenshot">
                            <div class="content-item-info">
                                <div class="content-item-title">Final zafer anı</div>
                                <div class="content-item-game">Counter Strike 2</div>
                                <div class="content-item-meta">
                                    <div class="content-item-user">
                                        <div class="content-item-avatar">
                                            <img src="https://via.placeholder.com/20" alt="User">
                                        </div>
                                        <span>KemalGamer</span>
                                    </div>
                                    <div class="content-item-stats">
                                        <div class="content-item-stat">
                                            <i class="fas fa-heart"></i> 24
                                        </div>
                                        <div class="content-item-stat">
                                            <i class="fas fa-comment"></i> 5
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Çizim -->
                        <div class="content-item">
                            <img src="https://via.placeholder.com/300x160" alt="Artwork">
                            <div class="content-item-info">
                                <div class="content-item-title">Half-Life 3 konsept sanatı</div>
                                <div class="content-item-game">Half-Life</div>
                                <div class="content-item-meta">
                                    <div class="content-item-user">
                                        <div class="content-item-avatar">
                                            <img src="https://via.placeholder.com/20" alt="User">
                                        </div>
                                        <span>GordonF</span>
                                    </div>
                                    <div class="content-item-stats">
                                        <div class="content-item-stat">
                                            <i class="fas fa-heart"></i> 128
                                        </div>
                                        <div class="content-item-stat">
                                            <i class="fas fa-comment"></i> 32
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video -->
                        <div class="content-item">
                            <img src="https://via.placeholder.com/300x160" alt="Video">
                            <div style="position: absolute; top: 70px; left: 130px; font-size: 24px; color: white;">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <div class="content-item-info">
                                <div class="content-item-title">GTA 5 modlarla daha güzel</div>
                                <div class="content-item-game">Grand Theft Auto V</div>
                                <div class="content-item-meta">
                                    <div class="content-item-user">
                                        <div class="content-item-avatar">
                                            <img src="https://via.placeholder.com/20" alt="User">
                                        </div>
                                        <span>TommyV</span>
                                    </div>
                                    <div class="content-item-stats">
                                        <div class="content-item-stat">
                                            <i class="fas fa-heart"></i> 75
                                        </div>
                                        <div class="content-item-stat">
                                            <i class="fas fa-comment"></i> 14
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Atölye -->
                        <div class="content-item">
                            <img src="https://via.placeholder.com/300x160" alt="Workshop">
                            <div class="content-item-info">
                                <div class="content-item-title">Gerçekçi silah modları paketi</div>
                                <div class="content-item-game">Fallout 4</div>
                                <div class="content-item-meta">
                                    <div class="content-item-user">
                                        <div class="content-item-avatar">
                                            <img src="https://via.placeholder.com/20" alt="User">
                                        </div>
                                        <span>Modder42</span>
                                    </div>
                                    <div class="content-item-stats">
                                        <div class="content-item-stat">
                                            <i class="fas fa-download"></i> 2.4k
                                        </div>
                                        <div class="content-item-stat">
                                            <i class="fas fa-star"></i> 4.8
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tartışmalar tab içeriği -->
                <div class="tab-pane" id="discussions-content" style="display: none;">
                    <div class="content-header" style="padding: 0 0 16px 0; margin-bottom: 16px;">
                        <div></div>
                        <a href="#" class="btn-post">
                            <i class="fas fa-plus"></i> Yeni Tartışma
                        </a>
                    </div>
                    
                    <div class="discussion-list">
                        <div class="discussion-item">
                            <div class="discussion-info">
                                <h3 class="discussion-title">Yeni Patch Hakkında Düşünceleriniz</h3>
                                <div class="discussion-meta">
                                    <span><i class="fas fa-gamepad"></i> Cyberpunk 2077</span>
                                    <span><i class="fas fa-user"></i> NightCity42</span>
                                    <span><i class="fas fa-clock"></i> 2 saat önce</span>
                                </div>
                            </div>
                            <div class="discussion-stats">
                                <div><i class="fas fa-comment"></i> 24 yanıt</div>
                                <div><i class="fas fa-eye"></i> 142 görüntülenme</div>
                            </div>
                        </div>
                        
                        <div class="discussion-item">
                            <div class="discussion-info">
                                <h3 class="discussion-title">Online modda karşılaştığım hata</h3>
                                <div class="discussion-meta">
                                    <span><i class="fas fa-gamepad"></i> GTA V</span>
                                    <span><i class="fas fa-user"></i> RockstarFan</span>
                                    <span><i class="fas fa-clock"></i> 5 saat önce</span>
                                </div>
                            </div>
                            <div class="discussion-stats">
                                <div><i class="fas fa-comment"></i> 7 yanıt</div>
                                <div><i class="fas fa-eye"></i> 56 görüntülenme</div>
                            </div>
                        </div>
                        
                        <div class="discussion-item">
                            <div class="discussion-info">
                                <h3 class="discussion-title">Hangi DLC'yi almalıyım?</h3>
                                <div class="discussion-meta">
                                    <span><i class="fas fa-gamepad"></i> The Sims 4</span>
                                    <span><i class="fas fa-user"></i> SimsLover</span>
                                    <span><i class="fas fa-clock"></i> 1 gün önce</span>
                                </div>
                            </div>
                            <div class="discussion-stats">
                                <div><i class="fas fa-comment"></i> 18 yanıt</div>
                                <div><i class="fas fa-eye"></i> 203 görüntülenme</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Workshop tab içeriği -->
                <div class="tab-pane" id="workshop-content" style="display: none;">
                    <div class="content-header" style="padding: 0 0 16px 0; margin-bottom: 16px;">
                        <div></div>
                        <a href="#" class="btn-post">
                            <i class="fas fa-plus"></i> İçerik Oluştur
                        </a>
                    </div>
                    
                    <div class="content-grid">
                        <div class="workshop-item">
                            <div class="workshop-item-banner">
                                <img src="https://via.placeholder.com/300x160" alt="Workshop Item">
                            </div>
                            <div class="workshop-item-info">
                                <h3 class="workshop-item-title">Gerçekçi Hava Durumu Modu</h3>
                                <p class="workshop-item-desc">
                                    Bu mod, oyuna daha gerçekçi hava durumu efektleri ekler. Yağmur, kar, sis ve daha fazlası.
                                </p>
                                <div class="workshop-item-meta">
                                    <div class="workshop-item-author">
                                        <img src="https://via.placeholder.com/24" alt="Author">
                                        <span>WeatherMod</span>
                                    </div>
                                    <div class="workshop-item-stats">
                                        <div class="workshop-stat">
                                            <i class="fas fa-download"></i> 12.4k
                                        </div>
                                        <div class="workshop-stat">
                                            <i class="fas fa-star"></i> 4.7
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="workshop-item">
                            <div class="workshop-item-banner">
                                <img src="https://via.placeholder.com/300x160" alt="Workshop Item">
                            </div>
                            <div class="workshop-item-info">
                                <h3 class="workshop-item-title">HD Texture Pack</h3>
                                <p class="workshop-item-desc">
                                    Bu paket, oyunun tüm dokularını yüksek çözünürlüklü versiyonlarla değiştirir.
                                </p>
                                <div class="workshop-item-meta">
                                    <div class="workshop-item-author">
                                        <img src="https://via.placeholder.com/24" alt="Author">
                                        <span>HDMaster</span>
                                    </div>
                                    <div class="workshop-item-stats">
                                        <div class="workshop-stat">
                                            <i class="fas fa-download"></i> 28.7k
                                        </div>
                                        <div class="workshop-stat">
                                            <i class="fas fa-star"></i> 4.9
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="workshop-item">
                            <div class="workshop-item-banner">
                                <img src="https://via.placeholder.com/300x160" alt="Workshop Item">
                            </div>
                            <div class="workshop-item-info">
                                <h3 class="workshop-item-title">Yeni Silahlar Paketi</h3>
                                <p class="workshop-item-desc">
                                    Oyuna 20'den fazla yeni silah ekleyen paket. Her silah detaylı animasyonlar ve seslere sahip.
                                </p>
                                <div class="workshop-item-meta">
                                    <div class="workshop-item-author">
                                        <img src="https://via.placeholder.com/24" alt="Author">
                                        <span>WeaponCreator</span>
                                    </div>
                                    <div class="workshop-item-stats">
                                        <div class="workshop-stat">
                                            <i class="fas fa-download"></i> 9.2k
                                        </div>
                                        <div class="workshop-stat">
                                            <i class="fas fa-star"></i> 4.5
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="screenshots-content" style="display: none;">
                    <div class="content-grid">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="content-item">
                                <img src="https://via.placeholder.com/300x160?text=Screenshot+{{ $i+1 }}" alt="Screenshot">
                                <div class="content-item-info">
                                    <div class="content-item-title">Oyundaki muhteşem an #{{ $i+1 }}</div>
                                    <div class="content-item-game">{{ ['Cyberpunk 2077', 'The Witcher 3', 'Red Dead Redemption 2', 'Assassin\'s Creed Valhalla'][rand(0,3)] }}</div>
                                    <div class="content-item-meta">
                                        <div class="content-item-user">
                                            <div class="content-item-avatar">
                                                <img src="https://via.placeholder.com/20" alt="User">
                                            </div>
                                            <span>Kullanıcı{{ rand(100, 999) }}</span>
                                        </div>
                                        <div class="content-item-stats">
                                            <div class="content-item-stat">
                                                <i class="fas fa-heart"></i> {{ rand(5, 120) }}
                                            </div>
                                            <div class="content-item-stat">
                                                <i class="fas fa-comment"></i> {{ rand(0, 40) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <div class="tab-pane" id="artwork-content" style="display: none;">
                    <div class="content-grid">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="content-item">
                                <img src="https://via.placeholder.com/300x160?text=Artwork+{{ $i+1 }}" alt="Artwork">
                                <div class="content-item-info">
                                    <div class="content-item-title">{{ ['Karakter Tasarımı', 'Fan Art', 'Konsept Sanatı', 'Dijital Çizim'][rand(0,3)] }} #{{ $i+1 }}</div>
                                    <div class="content-item-game">{{ ['Half-Life', 'Portal', 'Cyberpunk 2077', 'The Witcher 3'][rand(0,3)] }}</div>
                                    <div class="content-item-meta">
                                        <div class="content-item-user">
                                            <div class="content-item-avatar">
                                                <img src="https://via.placeholder.com/20" alt="User">
                                            </div>
                                            <span>Sanatçı{{ rand(100, 999) }}</span>
                                        </div>
                                        <div class="content-item-stats">
                                            <div class="content-item-stat">
                                                <i class="fas fa-heart"></i> {{ rand(5, 250) }}
                                            </div>
                                            <div class="content-item-stat">
                                                <i class="fas fa-comment"></i> {{ rand(0, 40) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <div class="tab-pane" id="videos-content" style="display: none;">
                    <div class="content-grid">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="content-item">
                                <img src="https://via.placeholder.com/300x160?text=Video+{{ $i+1 }}" alt="Video">
                                <div style="position: absolute; top: 70px; left: 130px; font-size: 24px; color: white;">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <div class="content-item-info">
                                    <div class="content-item-title">{{ ['Oynanış Videosu', 'İnceleme', 'Rehber', 'Eğlenceli Anlar'][rand(0,3)] }} #{{ $i+1 }}</div>
                                    <div class="content-item-game">{{ ['GTA V', 'Red Dead Redemption 2', 'Cyberpunk 2077', 'Fortnite'][rand(0,3)] }}</div>
                                    <div class="content-item-meta">
                                        <div class="content-item-user">
                                            <div class="content-item-avatar">
                                                <img src="https://via.placeholder.com/20" alt="User">
                                            </div>
                                            <span>Gamer{{ rand(100, 999) }}</span>
                                        </div>
                                        <div class="content-item-stats">
                                            <div class="content-item-stat">
                                                <i class="fas fa-heart"></i> {{ rand(5, 180) }}
                                            </div>
                                            <div class="content-item-stat">
                                                <i class="fas fa-comment"></i> {{ rand(0, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <div class="tab-pane" id="guides-content" style="display: none;">
                    <div class="content-grid">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="content-item">
                                <img src="https://via.placeholder.com/300x160?text=Guide+{{ $i+1 }}" alt="Guide">
                                <div class="content-item-info">
                                    <div class="content-item-title">{{ ['Başlangıç Rehberi', 'Gizli Bölgeler', 'Boss Taktikleri', 'En İyi Silahlar'][rand(0,3)] }}</div>
                                    <div class="content-item-game">{{ ['Skyrim', 'Elden Ring', 'Dark Souls', 'Fallout 4'][rand(0,3)] }}</div>
                                    <div class="content-item-meta">
                                        <div class="content-item-user">
                                            <div class="content-item-avatar">
                                                <img src="https://via.placeholder.com/20" alt="User">
                                            </div>
                                            <span>Rehber{{ rand(100, 999) }}</span>
                                        </div>
                                        <div class="content-item-stats">
                                            <div class="content-item-stat">
                                                <i class="fas fa-heart"></i> {{ rand(10, 150) }}
                                            </div>
                                            <div class="content-item-stat">
                                                <i class="fas fa-eye"></i> {{ rand(100, 2000) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <div class="tab-pane" id="news-content" style="display: none;">
                    <div class="content-grid">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="content-item">
                                <img src="https://via.placeholder.com/300x160?text=News+{{ $i+1 }}" alt="News">
                                <div class="content-item-info">
                                    <div class="content-item-title">{{ ['Yeni Güncelleme', 'DLC Duyurusu', 'Etkinlik Haberi', 'Geliştirici Röportajı'][rand(0,3)] }}</div>
                                    <div class="content-item-game">{{ ['Counter Strike 2', 'League of Legends', 'Diablo IV', 'Call of Duty'][rand(0,3)] }}</div>
                                    <div class="content-item-meta">
                                        <div class="content-item-user">
                                            <div class="content-item-avatar">
                                                <img src="https://via.placeholder.com/20" alt="User">
                                            </div>
                                            <span>Yönetici</span>
                                        </div>
                                        <div class="content-item-stats">
                                            <div class="content-item-stat">
                                                <i class="fas fa-calendar"></i> {{ rand(1, 30) }} Ağustos
                                            </div>
                                            <div class="content-item-stat">
                                                <i class="fas fa-eye"></i> {{ rand(300, 5000) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Simple tab switching with jQuery
    $('.community-tab').on('click', function() {
        // Get tab id
        var tabId = $(this).attr('data-tab');
        
            // Remove active class from all tabs
        $('.community-tab').removeClass('active');
        
            // Add active class to clicked tab
        $(this).addClass('active');
        
        // Hide all tab panes
        $('.tab-pane').hide();
        
        // Show the selected tab pane
        $('#' + tabId + '-content').show();
        
        return false; // Prevent default behavior
    });
    
    // Initialize the first tab (Tümü)
    $('.community-tab[data-tab="all"]').click();
});
</script>
@endpush
@endsection 