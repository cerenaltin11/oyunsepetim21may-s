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
    
    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3); /* Daha az karanlık overlay */
        z-index: 2;
    }

    .hero-slideshow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
        z-index: 0;
        background-color: #000; /* Default background color while loading */
        background-position: center;
        background-size: cover;
    }

    .hero-slide.active {
        opacity: 1;
        z-index: 1;
    }
    
  
    .hero-slide.tlou2 {
        background-image: url({{ asset('images/th.jpg') }});
    }
    
    .hero-slide.rdr2 {
        background-image: url({{ asset('images/rdr.jpeg') }});
    }
    
    .hero-slide.gta5 {
        background-image: url({{ asset('images/gta.jpg') }});
    }
    
    .hero-slide.re7 {
        background-image: url({{ asset('images/re.jpg') }});
    }

    .hero-title {
        font-size: 4rem; /* Daha büyük başlık */
        margin-bottom: 1rem;
        font-weight: 800;
        text-shadow: 2px 2px 15px rgba(0, 0, 0, 0.9); /* Daha belirgin gölge */
        transition: opacity 0.5s ease;
        color: #fff;
        position: absolute;
        bottom: 120px;
        left: 50px;
        text-align: left;
        max-width: 80%;
        z-index: 3;
    }

    .hero-description {
        font-size: 1.4rem;
        color: #d3d3d3;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9);
        transition: opacity 0.5s ease;
        max-width: 600px;
        position: absolute;
        bottom: 70px;
        left: 50px;
        text-align: left;
        z-index: 3;
    }

    .hero-cta {
        position: absolute;
        bottom: 30px;
        left: 50px;
        z-index: 3;
    }

    .slideshow-indicators {
        position: absolute;
        bottom: 20px;
        right: 50px; /* Sağa alındı */
        display: flex;
        gap: 10px;
        z-index: 3;
    }

    .slideshow-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slideshow-indicator.active {
        background-color: var(--accent-color);
        transform: scale(1.2);
    }

    .section-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        border-left: 4px solid var(--accent-color);
        padding-left: 1rem;
    }

    .section-title-view-all {
        float: right;
        font-size: 1rem;
        color: var(--accent-color);
        text-decoration: none;
        margin-top: 5px;
    }
    
    .section-title-view-all:hover {
        text-decoration: underline;
    }

    .game-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
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
    
    .special-offers-section {
        margin-bottom: 4rem;
    }

    .special-offers {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .special-offer {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        height: 180px;
    }

    .offer-image {
        width: 40%;
        object-fit: cover;
    }

    .offer-info {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .offer-title {
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
    }

    .offer-description {
        color: var(--text-gray);
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .carousel {
        position: relative;
        margin-bottom: 4rem;
    }

    .carousel-track {
        display: flex;
        overflow-x: auto;
        padding-bottom: 1rem;
        scroll-behavior: smooth;
        -ms-overflow-style: none;
        scrollbar-width: none;
        gap: 1rem;
    }

    .carousel-track::-webkit-scrollbar {
        display: none;
    }

    .carousel-item {
        flex: 0 0 auto;
        width: 300px;
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
    }

    .carousel-nav {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .carousel-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--accent-dark);
        cursor: pointer;
    }

    .carousel-dot.active {
        background-color: var(--accent-color);
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 3;
    }

    .carousel-btn.prev {
        left: 10px;
    }

    .carousel-btn.next {
        right: 10px;
    }

    @media (max-width: 768px) {
        .special-offers {
            grid-template-columns: 1fr;
        }
        
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-description {
            font-size: 1rem;
        }
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }
    
    .page-item {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: var(--secondary-dark);
        color: var(--text-light);
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .page-item.active {
        background-color: var(--accent-color);
        color: white;
    }
    
    .page-item:hover:not(.active):not(.disabled) {
        background-color: var(--accent-dark);
        transform: translateY(-2px);
    }
    
    .page-item.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .prev, .next {
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
    @if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endif

    <section class="hero-banner">
        <div class="hero-slideshow">
            <div class="hero-slide tlou2 active" data-title="The Last of Us Part II" data-desc="Ellie ve Joel'in destansı macerasında hayatta kalma savaşı devam ediyor.">
            </div>
            <div class="hero-slide rdr2" data-title="Red Dead Redemption 2" data-desc="Arthur Morgan ve Van der Linde çetesi, Amerika'nın merkezindeki zorlu yaşama karşı mücadele ediyor.">
            </div>
            <div class="hero-slide gta5" data-title="Grand Theft Auto V" data-desc="Los Santos şehrinde Michael, Franklin ve Trevor'ın hikayesine tanıklık edin.">
            </div>
            <div class="hero-slide re7" data-title="Resident Evil 7: Biohazard" data-desc="Ethan Winters, kayıp eşi Mia'yı Baker ailesinin çiftliğinde ararken korkunç olaylarla karşılaşır.">
            </div>
        </div>
        
        <h1 class="hero-title" id="slide-title">The Last of Us Part II</h1>
        <p class="hero-description" id="slide-desc">Ellie ve Joel'in destansı macerasında hayatta kalma savaşı devam ediyor.</p>
        <div class="hero-cta">
            <a href="/games" class="btn btn-primary">Tüm Oyunları İncele</a>
        </div>
        
        <div class="slideshow-indicators">
            <span class="slideshow-indicator active" data-slide="0"></span>
            <span class="slideshow-indicator" data-slide="1"></span>
            <span class="slideshow-indicator" data-slide="2"></span>
            <span class="slideshow-indicator" data-slide="3"></span>
        </div>
    </section>

    <section>
        <h2 class="section-title">
            Öne Çıkan Oyunlar
            <a href="{{ url('/games') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="carousel">
            <button class="carousel-btn prev"><i class="fas fa-chevron-left"></i></button>
            <div class="carousel-track">
                <div class="carousel-item">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg" alt="Cyberpunk 2077" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">Macera</div>
                        <h3 class="game-title">Cyberpunk 2077</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-25%</span>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg" alt="FIFA 23" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Spor</div>
                        <h3 class="game-title">FIFA 23</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg" alt="Elden Ring" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">RPG</div>
                        <h3 class="game-title">Elden Ring</h3>
                        <div class="game-price">
                            <span class="price">₺599</span>
                            <span class="discount">-10%</span>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg" alt="Age of Empires IV" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Strateji</div>
                        <h3 class="game-title">Age of Empires IV</h3>
                        <div class="game-price">
                            <span class="price">₺249</span>
                            <span class="discount">-50%</span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-btn next"><i class="fas fa-chevron-right"></i></button>
            <div class="carousel-nav">
                <span class="carousel-dot active"></span>
                <span class="carousel-dot"></span>
                <span class="carousel-dot"></span>
            </div>
        </div>
    </section>

    <section class="special-offers-section">
        <h2 class="section-title">
            Özel Teklifler
            <a href="{{ url('/deals') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="special-offers">
            <div class="special-offer">
                <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/capsule_616x353.jpg" alt="Hafta Sonu İndirimleri" class="offer-image">
                <div class="offer-info">
                    <h3 class="offer-title">Hafta Sonu İndirimleri</h3>
                    <p class="offer-description">Seçili oyunlarda %70'e varan indirimler!</p>
                    <a href="/deals" class="btn btn-primary">İncele</a>
                </div>
            </div>
            <div class="special-offer">
                <img src="https://cdn.akamai.steamstatic.com/steam/apps/1174180/capsule_616x353.jpg" alt="Yaz Kampanyası" class="offer-image">
                <div class="offer-info">
                    <h3 class="offer-title">Yaz Kampanyası</h3>
                    <p class="offer-description">3 al 2 öde! Yaz kampanyasını kaçırma.</p>
                    <a href="/deals" class="btn btn-primary">İncele</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">
            Popüler Oyunlar
            <a href="{{ url('/games?sort=popularity&direction=desc') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($popularGames) && count($popularGames) > 0)
                @foreach($popularGames as $game)
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
                <div class="alert alert-info w-100">Popüler oyunlar bulunamadı.</div>
            @endif
        </div>
    </section>
    
    <section>
        <h2 class="section-title">
            Aksiyon Oyunları
            <a href="{{ url('/games?category=Aksiyon') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($actionGames) && count($actionGames) > 0)
                @foreach($actionGames as $game)
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
                <div class="alert alert-info w-100">Aksiyon oyunları bulunamadı.</div>
            @endif
        </div>
    </section>
    
    <section>
        <h2 class="section-title">
            RPG Oyunları
            <a href="{{ url('/games?category=RPG') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($rpgGames) && count($rpgGames) > 0)
                @foreach($rpgGames as $game)
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
                <div class="alert alert-info w-100">RPG oyunları bulunamadı.</div>
            @endif
        </div>
    </section>

    <section>
        <h2 class="section-title">
            Spor ve Yarış Oyunları
            <a href="{{ url('/games?category=Spor&category=Yarış') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($sportGames) && count($sportGames) > 0)
                @foreach($sportGames as $game)
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
                <div class="alert alert-info w-100">Spor ve yarış oyunları bulunamadı.</div>
            @endif
        </div>
    </section>
    
    <section>
        <h2 class="section-title">
            Korku Oyunları
            <a href="{{ url('/games?category=Korku') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($horrorGames) && count($horrorGames) > 0)
                @foreach($horrorGames as $game)
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
                <div class="alert alert-info w-100">Korku oyunları bulunamadı.</div>
            @endif
        </div>
    </section>
    
    <section>
        <h2 class="section-title">
            Strateji Oyunları
            <a href="{{ url('/games?category=Strateji') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($strategyGames) && count($strategyGames) > 0)
                @foreach($strategyGames as $game)
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
                <div class="alert alert-info w-100">Strateji oyunları bulunamadı.</div>
            @endif
        </div>
    </section>

    <section>
        <h2 class="section-title">
            Ücretsiz Oyunlar
            <a href="{{ url('/games?price=0') }}" class="section-title-view-all">Tümünü Gör</a>
        </h2>
        <div class="game-grid">
            @if(isset($freeGames) && count($freeGames) > 0)
                @foreach($freeGames as $game)
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
                                <span class="price">Ücretsiz</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <div class="alert alert-info w-100">Ücretsiz oyunlar bulunamadı.</div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize slideshow immediately
        initSlideshow();
        
        function initSlideshow() {
            // Hero Slideshow initialization
            const slides = document.querySelectorAll('.hero-slide');
            const indicators = document.querySelectorAll('.slideshow-indicator');
            const slideTitle = document.getElementById('slide-title');
            const slideDesc = document.getElementById('slide-desc');
            
            let currentSlide = 0;
            let slideInterval;
            let isFirstLoad = false; // Changed to false to show the first slide title immediately

            // Start automatic slideshow with interval
            function startSlideshow() {
                slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }

            // Stop slideshow
            function stopSlideshow() {
                clearInterval(slideInterval);
            }

            // Update slide content
            function updateSlideContent(slideIndex) {
                const slide = slides[slideIndex];
                const title = slide.getAttribute('data-title');
                const desc = slide.getAttribute('data-desc');
                
                if (isFirstLoad) {
                    // On first load, don't change the default welcome text
                    isFirstLoad = false;
                    return;
                }
                
                // Fade out current content
                slideTitle.style.opacity = 0;
                slideDesc.style.opacity = 0;
                
                // Update content after fade out
                setTimeout(() => {
                    slideTitle.textContent = title;
                    slideDesc.textContent = desc;
                    
                    // Fade in new content
                    slideTitle.style.opacity = 1;
                    slideDesc.style.opacity = 1;
                }, 300);
            }

            // Switch to specific slide
            function goToSlide(slideIndex) {
                // Remove active class from all slides
                slides.forEach(slide => {
                    slide.classList.remove('active');
                });
                
                // Remove active class from all indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                });
                
                // Add active class to current slide and indicator
                slides[slideIndex].classList.add('active');
                indicators[slideIndex].classList.add('active');
                
                // Update slide content
                updateSlideContent(slideIndex);
                
                // Update current slide index
                currentSlide = slideIndex;
            }

            // Go to next slide
            function nextSlide() {
                let nextIndex = currentSlide + 1;
                if (nextIndex >= slides.length) {
                    nextIndex = 0;
                }
                goToSlide(nextIndex);
            }

            // Add click event listeners to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    stopSlideshow(); // Stop auto rotation when manual navigation
                    goToSlide(index);
                    startSlideshow(); // Resume auto rotation
                });
            });

            // Add fade transition to slide content
            slideTitle.style.transition = 'opacity 0.3s ease-in-out';
            slideDesc.style.transition = 'opacity 0.3s ease-in-out';

            // Start the slideshow
            startSlideshow();

            // Pause slideshow on hover (optional)
            const heroSection = document.querySelector('.hero-banner');
            heroSection.addEventListener('mouseenter', stopSlideshow);
            heroSection.addEventListener('mouseleave', startSlideshow);
        }
    });

    // Öne Çıkan Oyunlar Carousel
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.querySelector('.carousel-track');
        const prevButton = document.querySelector('.carousel-btn.prev');
        const nextButton = document.querySelector('.carousel-btn.next');
        const dots = document.querySelectorAll('.carousel-dot');
        const items = document.querySelectorAll('.carousel-item');
        const itemWidth = 300 + 16; // Width of item + gap
        
        let position = 0;
        let currentIndex = 0;
        
        // Display number of visible items based on container width
        function getVisibleItems() {
            const trackWidth = track.clientWidth;
            return Math.floor(trackWidth / itemWidth);
        }
        
        // Update dot indicators
        function updateDots() {
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }
        
        // Scroll to specific index
        function scrollToIndex(index) {
            if (index < 0) index = 0;
            if (index > items.length - getVisibleItems()) index = items.length - getVisibleItems();
            
            position = index * -itemWidth;
            track.scrollLeft = Math.abs(position);
            currentIndex = index;
            updateDots();
        }
        
        // Event listeners
        prevButton.addEventListener('click', () => {
            scrollToIndex(currentIndex - 1);
        });
        
        nextButton.addEventListener('click', () => {
            scrollToIndex(currentIndex + 1);
        });
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                scrollToIndex(index);
            });
        });
        
        // Initialize
        updateDots();
    });
</script>
@endsection 