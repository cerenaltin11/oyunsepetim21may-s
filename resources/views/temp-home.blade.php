@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('styles')
<style>
    .hero-banner {
        background-color: #000;
        border-radius: 8px;
        height: 400px;
        margin-bottom: 2rem;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 3;
        width: 80%;
    }
    
    .hero-title {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #fff;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }
    
    .hero-description {
        font-size: 1.2rem;
        color: #e0e0e0;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
    }
    
    .game-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .game-card {
        background-color: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #fff;
    }
    
    .section-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #fff;
        border-left: 3px solid #007bff;
        padding-left: 10px;
    }
    
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #0069d9;
    }
    
    .category-tag {
        display: inline-block;
        background-color: #333;
        color: #ddd;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-size: 0.7rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .price {
        color: #007bff;
        font-weight: 700;
    }
    
    .game-price {
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
    }
    
    .discount {
        background-color: #28a745;
        color: white;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
    <section class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">OyunSepetim'e Hoş Geldiniz</h1>
            <p class="hero-description">En sevdiğiniz oyunları keşfedin, satın alın ve kütüphanenizde saklayın.</p>
            <a href="/games" class="btn btn-primary">Oyunları Keşfet</a>
        </div>
    </section>

    <section>
        <h2 class="section-title">Popüler Oyunlar</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/cyberpunk-2077">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg" alt="Cyberpunk 2077" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">RPG</div>
                        <h3 class="game-title">Cyberpunk 2077</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-25%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/red-dead-redemption-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg" alt="Red Dead Redemption 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Açık Dünya</div>
                        <div class="category-tag">Macera</div>
                        <h3 class="game-title">Red Dead Redemption 2</h3>
                        <div class="game-price">
                            <span class="price">₺349</span>
                            <span class="discount">-35%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/fifa-23">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg" alt="FIFA 23" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Spor</div>
                        <h3 class="game-title">FIFA 23</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/elden-ring">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg" alt="Elden Ring" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">RPG</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Elden Ring</h3>
                        <div class="game-price">
                            <span class="price">₺599</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/call-of-duty-modern-warfare-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg" alt="Call of Duty: Modern Warfare 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">FPS</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Call of Duty: Modern Warfare 2</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                            <span class="discount">-15%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section>
        <h2 class="section-title">Strateji Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/age-of-empires-iv">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg" alt="Age of Empires IV" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Strateji</div>
                        <div class="category-tag">Tarih</div>
                        <h3 class="game-title">Age of Empires IV</h3>
                        <div class="game-price">
                            <span class="price">₺249</span>
                            <span class="discount">-50%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/civilization-vi">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/289070/header.jpg" alt="Civilization VI" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Strateji</div>
                        <div class="category-tag">Sıra Tabanlı</div>
                        <h3 class="game-title">Sid Meier's Civilization VI</h3>
                        <div class="game-price">
                            <span class="price">₺179</span>
                            <span class="discount">-70%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section>
        <h2 class="section-title">Korku Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/resident-evil-village">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1196590/header.jpg" alt="Resident Evil Village" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Korku</div>
                        <h3 class="game-title">Resident Evil Village</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-20%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Aksiyon Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/call-of-duty-modern-warfare-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg" alt="Call of Duty: Modern Warfare 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">FPS</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Call of Duty: Modern Warfare 2</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                            <span class="discount">-15%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/cyberpunk-2077">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg" alt="Cyberpunk 2077" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">RPG</div>
                        <h3 class="game-title">Cyberpunk 2077</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-25%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/god-of-war-ragnarok">
                    <img src="https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png" alt="God of War Ragnarök" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">Macera</div>
                        <h3 class="game-title">God of War Ragnarök</h3>
                        <div class="game-price">
                            <span class="price">₺799</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection 