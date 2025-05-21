@extends('layouts.app')

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
        background-color: var(--primary-dark) !important;
    }
    .game-community-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .game-header {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 32px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
    }
    .game-header-content {
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .game-image {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
    }
    .game-info h1 {
        color: var(--text-primary);
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 8px;
        letter-spacing: -0.5px;
    }
    .game-info p {
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin: 0;
    }
    .community-actions {
        background: var(--bg-card);
        border-radius: 16px;
        margin-bottom: 32px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .actions-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 32px;
        border-bottom: 1px solid var(--border-color);
    }
    .action-tabs {
        display: flex;
        gap: 24px;
    }
    .action-tab {
        color: var(--text-secondary);
        font-weight: 600;
        text-decoration: none;
        padding: 8px 0;
        position: relative;
        transition: color 0.2s;
    }
    .action-tab:hover {
        color: var(--text-primary);
    }
    .action-tab.active {
        color: var(--accent-color);
    }
    .action-tab.active::after {
        content: '';
        position: absolute;
        bottom: -21px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--accent-color);
    }
    .create-post-btn {
        background: var(--accent-color);
        color: var(--text-primary);
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }
    .create-post-btn:hover {
        background: var(--accent-hover);
        color: var(--text-primary);
    }
    .posts-list {
        background: var(--bg-card);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .post-item {
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
        transition: background 0.2s;
    }
    .post-item:hover {
        background: var(--bg-hover);
    }
    .post-item:last-child {
        border-bottom: none;
    }
    .post-header {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 12px;
    }
    .post-pin {
        color: var(--accent-color);
        margin-top: 4px;
    }
    .post-title {
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .post-title:hover {
        color: var(--accent-color);
    }
    .post-meta {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin: 8px 0 16px;
    }
    .post-meta a {
        color: var(--accent-color);
        text-decoration: none;
    }
    .post-meta a:hover {
        text-decoration: underline;
    }
    .post-content {
        color: var(--text-primary);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .post-stats {
        display: flex;
        gap: 24px;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .post-stat {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .empty-posts {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }
    .empty-posts i {
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 16px;
    }
    .empty-posts p {
        font-size: 1.1rem;
        margin: 0;
    }
    .pagination {
        padding: 20px;
        border-top: 1px solid var(--border-color);
    }
</style>
@endsection

@section('content')
<div class="game-community-container">
    <div class="game-header">
        <div class="game-header-content">
            @if($game->image)
                <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-image">
            @endif
            <div class="game-info">
                <h1>{{ $game->title }} Topluluğu</h1>
                <p>{{ $game->title }} hakkında tartışmalara katıl!</p>
            </div>
        </div>
    </div>

    <div class="community-actions">
        <div class="actions-header">
            <div class="action-tabs">
                <a href="#" class="action-tab active">Tüm Gönderiler</a>
                <a href="#" class="action-tab">Tartışmalar</a>
                <a href="#" class="action-tab">Rehberler</a>
                <a href="#" class="action-tab">Duyurular</a>
            </div>
            @auth
                <a href="{{ route('community.create') }}?game_id={{ $game->id }}" class="create-post-btn">
                    Gönderi Oluştur
                </a>
            @endauth
        </div>
    </div>

    <div class="posts-list">
        @forelse($posts as $post)
            <article class="post-item">
                <div class="post-header">
                    @if($post->is_pinned)
                        <div class="post-pin">
                            <i class="fas fa-thumbtack"></i>
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('community.show', $post) }}" class="post-title">
                            {{ $post->title }}
                        </a>
                        <div class="post-meta">
                            Gönderen: <a href="#">{{ $post->user->name }}</a>
                            • {{ $post->created_at->diffForHumans() }}
                        </div>
                        <div class="post-content">
                            {{ Str::limit(strip_tags($post->content), 200) }}
                        </div>
                        <div class="post-stats">
                            <div class="post-stat">
                                <i class="far fa-comment"></i>
                                <span>{{ $post->comments_count ?? $post->comments()->count() }} yorum</span>
                            </div>
                            <div class="post-stat">
                                <i class="far fa-eye"></i>
                                <span>{{ $post->views }} görüntüleme</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-posts">
                <i class="fas fa-comments"></i>
                <p>Bu oyun için hiç gönderi yok. İlk paylaşımı sen yap!</p>
            </div>
        @endforelse

        @if($posts->hasPages())
            <div class="pagination">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 