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
    .create-post-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .create-post-header {
        margin-bottom: 32px;
    }
    .create-post-title {
        color: var(--text-primary);
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }
    .create-post-form {
        background: var(--bg-card);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        padding: 32px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        color: var(--text-primary);
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 1rem;
        transition: border-color 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    .form-select {
        width: 100%;
        padding: 12px 16px;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 1rem;
        cursor: pointer;
        transition: border-color 0.2s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238f98a0' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }
    .form-select:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    .form-textarea {
        width: 100%;
        min-height: 240px;
        padding: 16px;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 1rem;
        line-height: 1.6;
        resize: vertical;
        transition: border-color 0.2s;
    }
    .form-textarea:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    .form-error {
        color: #ef4444;
        font-size: 0.9rem;
        margin-top: 6px;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        margin-top: 32px;
    }
    .btn {
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        border: none;
    }
    .btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-secondary);
    }
    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.15);
        color: var(--text-primary);
    }
    .btn-submit {
        background: var(--accent-color);
        color: var(--text-primary);
    }
    .btn-submit:hover {
        background: var(--accent-hover);
    }
</style>
@endsection

@section('content')
<div class="create-post-container">
    <div class="create-post-header">
        <h1 class="create-post-title">Yeni Gönderi Oluştur</h1>
    </div>

    <form action="{{ route('community.store') }}" method="POST" class="create-post-form">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="form-input">
            @error('title')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="type" class="form-label">Gönderi Türü</label>
            <select name="type" id="type" required class="form-select">
                <option value="discussion" {{ old('type') == 'discussion' ? 'selected' : '' }}>Tartışma</option>
                <option value="announcement" {{ old('type') == 'announcement' ? 'selected' : '' }}>Duyuru</option>
                <option value="guide" {{ old('type') == 'guide' ? 'selected' : '' }}>Rehber</option>
            </select>
            @error('type')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="game_id" class="form-label">İlgili Oyun (Opsiyonel)</label>
            <select name="game_id" id="game_id" class="form-select">
                <option value="">Bir oyun seçin</option>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>
                        {{ $game->title }}
                    </option>
                @endforeach
            </select>
            @error('game_id')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="content" class="form-label">İçerik</label>
            <textarea name="content" id="content" required class="form-textarea">{{ old('content') }}</textarea>
            @error('content')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('community.index') }}" class="btn btn-cancel">
                Vazgeç
            </a>
            <button type="submit" class="btn btn-submit">
                Gönderiyi Oluştur
            </button>
        </div>
    </form>
</div>
@endsection 