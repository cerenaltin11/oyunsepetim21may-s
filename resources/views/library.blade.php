@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', 'Kütüphanem')

@section('styles')
<style>
    .library-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .library-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
    }
    
    /* Game card styling */
    .game-item {
        background-color: #1a1a1a;
        border-radius: 6px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        transition: transform 0.2s;
        width: 100%;
    }
    
    .game-item:hover {
        transform: translateY(-3px);
    }
    
    .game-cover {
        position: relative;
        width: 100%;
        padding-top: 100%; /* Square aspect ratio */
    }
    
    .game-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .game-title {
        font-size: 0.9rem;
        font-weight: 500;
        color: #fff;
        padding: 10px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .game-buttons {
        display: flex;
        overflow: hidden;
    }
    
    .game-btn {
        flex: 1;
        text-align: center;
        padding: 8px 0;
        font-size: 0.8rem;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }
    
    .play-btn {
        background-color: #4CAF50;
    }
    
    .download-btn {
        background-color: #2196F3;
    }
    
    .play-btn:hover {
        background-color: #45a049;
    }
    
    .download-btn:hover {
        background-color: #0b7dda;
    }
    
    /* Alert messages */
    .alert {
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
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
    
    /* Empty library */
    .empty-library {
        text-align: center;
        padding: 2rem;
        background-color: #1a1a1a;
        border-radius: 4px;
        margin: 1rem 0;
    }
    
    .empty-library-icon {
        font-size: 2.5rem;
        color: #666;
        margin-bottom: 1rem;
    }
    
    .empty-library h3 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: #fff;
    }
    
    .empty-library p {
        color: #aaa;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    .empty-library .browse-btn {
        background-color: #2196F3;
        color: white;
        padding: 8px 16px;
        border-radius: 3px;
        text-decoration: none;
        display: inline-block;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
<div class="container py-3">
    <h1 class="library-title">Kütüphanem</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    
    @if(session('info'))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> {{ session('info') }}
        </div>
    @endif
    
    @if(Auth::check())
        @if(count($libraryItems) > 0)
            <div class="games-grid">
                @foreach($libraryItems as $game)
                    <div class="game-item">
                        <div class="game-cover">
                            <img src="{{ $game->image }}" class="game-image" alt="{{ $game->title }}">
                        </div>
                        <div class="game-title" title="{{ $game->title }}">{{ $game->title }}</div>
                        <div class="game-buttons">
                            <a href="#" class="game-btn play-btn">
                                <i class="fas fa-play"></i> Oyna
                            </a>
                            <a href="{{ route('library.download', ['gameId' => $game->id]) }}" class="game-btn download-btn">
                                <i class="fas fa-download"></i> İndir
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-library">
                <div class="empty-library-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3>Kütüphanenizde henüz oyun bulunmuyor</h3>
                <p>Oyun satın aldıktan sonra burada görünecektir</p>
                <a href="/games" class="browse-btn">
                    <i class="fas fa-search"></i> Oyunlara Göz At
                </a>
            </div>
        @endif
    @else
        <div class="empty-library">
            <div class="empty-library-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h3>Giriş Yapmanız Gerekiyor</h3>
            <p>Kütüphanenize erişmek için lütfen giriş yapın veya kayıt olun.</p>
            <a href="{{ route('login') }}" class="browse-btn">
                <i class="fas fa-sign-in-alt"></i> Giriş Yap
            </a>
        </div>
    @endif
</div>
@endsection 