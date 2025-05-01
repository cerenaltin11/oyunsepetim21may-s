@extends('layouts.app')

@section('title', 'Kütüphanem')

@section('styles')
<style>
    .library-container {
        padding: 2rem 0;
    }
    
    .library-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-dark);
        padding-bottom: 1rem;
    }
    
    .library-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .library-item {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s;
    }
    
    .library-item:hover {
        transform: translateY(-5px);
    }
    
    .library-item-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .library-item-info {
        padding: 1rem;
    }
    
    .library-item-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }
    
    .library-item-category {
        display: inline-block;
        font-size: 0.8rem;
        color: var(--text-gray);
        margin-bottom: 0.5rem;
    }
    
    .library-item-size {
        font-size: 0.9rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .library-item-actions {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }
    
    .download-btn {
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
        text-decoration: none;
    }
    
    .download-btn:hover {
        background-color: var(--accent-dark);
    }
    
    .play-btn {
        background-color: #4caf50;
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
        text-decoration: none;
    }
    
    .play-btn:hover {
        background-color: #3d9a40;
    }
    
    .empty-library {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
    }
    
    .empty-library-icon {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .empty-library-text {
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
    
    .game-stats {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 0.5rem;
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
    }
    
    .game-playtime {
        color: var(--text-gray);
    }
    
    .game-last-played {
        color: var(--text-gray);
    }
</style>
@endsection

@section('content')
    <div class="library-container">
        <h1 class="library-title">Kütüphanem</h1>
        
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
        
        @if(count($libraryItems) > 0)
            <div class="library-grid">
                @foreach($libraryItems as $game)
                    <div class="library-item">
                        <div class="library-item-image-container" style="position: relative;">
                            <img src="{{ $game->image }}" alt="{{ $game->title }}" class="library-item-image">
                            <div class="game-stats">
                                <span class="game-playtime"><i class="fas fa-clock"></i> 0 saat</span>
                                <span class="game-last-played">Son oynanma: Hiç</span>
                            </div>
                        </div>
                        
                        <div class="library-item-info">
                            <h3 class="library-item-title">{{ $game->title }}</h3>
                            <div class="category-tags">
                                @foreach(explode(',', $game->category) as $cat)
                                    <span class="category-tag">{{ trim($cat) }}</span>
                                @endforeach
                            </div>
                            
                            <div class="library-item-size">
                                Boyut: {{ rand(1, 50) }} GB
                            </div>
                            
                            <div class="library-item-actions">
                                <a href="#" class="play-btn">
                                    <i class="fas fa-play"></i> Oyna
                                </a>
                                <a href="{{ route('library.download', ['gameId' => $game->id]) }}" class="download-btn">
                                    <i class="fas fa-download"></i> İndir
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-library">
                <div class="empty-library-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h2>Kütüphaneniz Boş</h2>
                <p class="empty-library-text">Henüz hiç oyun satın almadınız. Oyun satın alarak kütüphanenize ekleyebilirsiniz.</p>
                <a href="/games" class="btn btn-primary">Oyunları Keşfet</a>
            </div>
        @endif
    </div>
@endsection 