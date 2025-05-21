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
    .post-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .post-content-container {
        background: var(--bg-card);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 32px;
    }
    .post-header {
        padding: 32px;
        border-bottom: 1px solid var(--border-color);
    }
    .post-title-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }
    .post-pin {
        color: var(--accent-color);
    }
    .post-title {
        color: var(--text-primary);
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }
    .post-meta {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }
    .post-meta a {
        color: var(--accent-color);
        text-decoration: none;
    }
    .post-meta a:hover {
        text-decoration: underline;
    }
    .post-body {
        padding: 32px;
        color: var(--text-primary);
        font-size: 1.1rem;
        line-height: 1.7;
    }
    .post-actions {
        padding: 24px 32px;
        background: rgba(0, 0, 0, 0.2);
        border-top: 1px solid var(--border-color);
    }
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .action-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        background: none;
        border: none;
        padding: 8px 0;
        font-size: 0.95rem;
        cursor: pointer;
        transition: color 0.2s;
    }
    .action-btn:hover {
        color: var(--accent-color);
    }
    .comments-section {
        background: var(--bg-card);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .comments-header {
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
    }
    .comments-title {
        color: var(--text-primary);
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    .comment-form {
        padding: 32px;
        border-bottom: 1px solid var(--border-color);
    }
    .comment-textarea {
        width: 100%;
        min-height: 120px;
        padding: 16px;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 1rem;
        line-height: 1.6;
        resize: vertical;
        margin-bottom: 16px;
        transition: border-color 0.2s;
    }
    .comment-textarea:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    .comment-submit {
        background: var(--accent-color);
        color: var(--text-primary);
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .comment-submit:hover {
        background: var(--accent-hover);
    }
    .comments-list {
        padding: 32px;
    }
    .comment-item {
        margin-bottom: 32px;
    }
    .comment-item:last-child {
        margin-bottom: 0;
    }
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .comment-author {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .author-name {
        color: var(--text-primary);
        font-weight: 600;
    }
    .comment-date {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .comment-content {
        color: var(--text-primary);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .comment-actions {
        display: flex;
        gap: 16px;
    }
    .comment-action {
        color: var(--text-secondary);
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s;
    }
    .comment-action:hover {
        color: var(--accent-color);
    }
    .empty-comments {
        text-align: center;
        padding: 48px 20px;
        color: var(--text-secondary);
    }
    .empty-comments i {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 16px;
    }
    .empty-comments p {
        font-size: 1.1rem;
        margin: 0;
    }
</style>
@endsection

@section('content')
<div class="post-container">
    <div class="post-content-container">
        <div class="post-header">
            <div class="post-title-row">
                @if($post->is_pinned)
                    <div class="post-pin">
                        <i class="fas fa-thumbtack"></i>
                    </div>
                @endif
                <h1 class="post-title">{{ $post->title }}</h1>
            </div>
            <div class="post-meta">
                Gönderen: <a href="#">{{ $post->user->name }}</a>
                @if($post->game)
                    | <a href="{{ route('community.game', $post->game) }}">{{ $post->game->title }}</a> oyunu
                @endif
                • {{ $post->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="post-body">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="post-actions">
            <div class="action-buttons">
                @auth
                    <button class="action-btn" onclick="likePost({{ $post->id }})">
                        <i class="far fa-thumbs-up"></i>
                        <span id="like-count">{{ $post->likes()->count() }}</span>
                    </button>
                @endauth
                <div class="action-btn">
                    <i class="far fa-eye"></i>
                    <span>{{ $post->views }} görüntüleme</span>
                </div>
            </div>
        </div>
    </div>

    <div class="comments-section">
        <div class="comments-header">
            <h2 class="comments-title">Yorumlar</h2>
        </div>

        @auth
            <form action="{{ route('community.comment', $post) }}" method="POST" class="comment-form">
                @csrf
                <textarea name="content" class="comment-textarea" required placeholder="Yorum yaz..."></textarea>
                <button type="submit" class="comment-submit">Yorum Yap</button>
            </form>
        @endauth

        <div class="comments-list">
            @forelse($post->comments as $comment)
                <div class="comment-item">
                    <div class="comment-header">
                        <div class="comment-author">
                            <span class="author-name">{{ $comment->user->name }}</span>
                            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="comment-content">
                        {!! nl2br(e($comment->content)) !!}
                    </div>
                    @auth
                        <div class="comment-actions">
                            <button class="comment-action" onclick="likeComment({{ $comment->id }})">
                                Beğen
                            </button>
                            <button class="comment-action" onclick="replyToComment({{ $comment->id }})">
                                Yanıtla
                            </button>
                        </div>
                    @endauth
                </div>
            @empty
                <div class="empty-comments">
                    <i class="far fa-comments"></i>
                    <p>Henüz yorum yok. İlk yorumu sen yap!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
function likePost(postId) {
    fetch(`/community/like/post/${postId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('like-count').textContent = data.likes_count;
    });
}

function likeComment(commentId) {
    fetch(`/community/like/comment/${commentId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        // Beğeni sayısını güncelle
    });
}

function replyToComment(commentId) {
    const textarea = document.querySelector('textarea[name="content"]');
    textarea.focus();
    textarea.value = `@${commentId} `;
}
</script>
@endpush
@endsection 