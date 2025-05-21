@extends('layouts.app')

@section('title', 'İnceleme Yaz')

@section('styles')
<style>
    .review-page-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .review-page-header {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .review-page-title {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: white;
    }
    
    .game-info {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        background: linear-gradient(to right, rgba(22, 31, 48, 0.8), rgba(32, 42, 68, 0.8));
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .game-image {
        width: 140px;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .game-details h2 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        color: white;
        font-size: 1.8rem;
    }
    
    .game-details .meta {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .review-form {
        background: linear-gradient(to bottom, rgba(22, 31, 48, 0.95), rgba(32, 42, 68, 0.95));
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(52, 152, 219, 0.2);
    }
    
    .review-form-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .form-group {
        margin-bottom: 1.8rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.8rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
    }
    
    .modern-radio-group {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        justify-content: center;
    }
    
    .modern-radio {
        display: none;
    }
    
    .modern-radio-label {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 1rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
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
        transition: all 0.3s;
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
        transition: all 0.3s;
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
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
    
    .guidelines-box {
        margin: 1.5rem 0;
        padding: 1.5rem;
        background: rgba(52, 152, 219, 0.1);
        border-radius: 8px;
        border-left: 4px solid rgba(52, 152, 219, 0.5);
    }
    
    .guidelines-box h4 {
        margin: 0 0 1rem 0;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
    }
    
    .guidelines-box ul {
        margin: 0;
        padding-left: 1.2rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .guidelines-box li {
        margin-bottom: 0.5rem;
    }
    
    .review-submit {
        background: linear-gradient(to right, #3498db, #2980b9);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        margin: 0 auto;
    }
    
    .review-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(52, 152, 219, 0.4);
        background: linear-gradient(to right, #2980b9, #3498db);
    }
    
    .review-guidelines {
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .actions-row {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }
    
    .back-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: white;
    }
</style>
@endsection

@section('content')
<div class="review-page-container">
    <div class="review-page-header">
        <h1 class="review-page-title">Oyun İncelemesi Yaz</h1>
        <p style="color: rgba(255, 255, 255, 0.7);">Deneyiminizi diğer oyuncularla paylaşın</p>
    </div>
    
    <div class="game-info">
        <img src="{{ $game->image }}" alt="{{ $game->title }}" class="game-image">
        <div class="game-details">
            <h2>{{ $game->title }}</h2>
            <div class="meta">
                <div><strong>Geliştirici:</strong> {{ $game->developer }}</div>
                <div><strong>Yayıncı:</strong> {{ $game->publisher }}</div>
                @if($game->release_date)
                <div><strong>Çıkış Tarihi:</strong> {{ date('d F Y', strtotime($game->release_date)) }}</div>
                @endif
            </div>
            <div class="categories">
                @foreach(explode(',', $game->category) as $cat)
                    <div class="category-tag">{{ trim($cat) }}</div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="review-form">
        <div class="review-form-title">{{ $game->title }} için İnceleme Yaz</div>
        
        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="game_id" value="{{ $game->id }}">
            
            <div class="form-group">
                <label class="form-label" style="text-align: center; display: block;">Bu oyunu öneriyor musunuz?</label>
                <div class="modern-radio-group">
                    <div class="modern-radio">
                        <input type="radio" id="recommend-yes" name="is_recommended" value="1" required>
                        <label for="recommend-yes" class="modern-radio-label positive">
                            <i class="fas fa-thumbs-up" style="font-size: 1.2rem;"></i> Evet, öneriyorum
                        </label>
                    </div>
                    <div class="modern-radio">
                        <input type="radio" id="recommend-no" name="is_recommended" value="0">
                        <label for="recommend-no" class="modern-radio-label negative">
                            <i class="fas fa-thumbs-down" style="font-size: 1.2rem;"></i> Hayır, önermiyorum
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="review-content" class="form-label">İncelemeniz</label>
                <p class="review-guidelines">
                    Lütfen oyun deneyiminizi detaylı bir şekilde paylaşın. Oyunun güçlü ve zayıf yönlerinden, hikaye ve oynanıştan, grafik ve ses kalitesinden bahsedebilirsiniz. Diğer oyunculara yararlı olacak özgün bir inceleme yazmanız önerilir.
                </p>
                <textarea name="content" id="review-content" class="form-control" rows="10" placeholder="Bu oyunla ilgili deneyimlerinizi paylaşın..." required></textarea>
            </div>
            
            <div class="guidelines-box">
                <h4>İyi Bir İnceleme Nasıl Yazılır?</h4>
                <ul>
                    <li>Oyunu yeterince oynadıktan sonra inceleme yazın</li>
                    <li>Hem olumlu hem de olumsuz yönlerinden bahsedin</li>
                    <li>Oyun deneyiminizi etkileyen özelliklere odaklanın</li>
                    <li>Spoiler içeriklerini belirtin veya gizleyin</li>
                    <li>Ekran görüntüleriyle incelemenizi destekleyin</li>
                    <li>Kişisel deneyimlerinizi paylaşın, genellemelerden kaçının</li>
                    <li>Objektif ve yapıcı eleştiriler sunun</li>
                </ul>
            </div>
            
            <div class="form-group">
                <label class="form-label">Ekran Görüntüleri (isteğe bağlı)</label>
                <p class="review-guidelines">
                    İncelemenizi görsellerle destekleyin. Oyun içi ekran görüntüleri, incelemenizin daha etkili olmasını sağlar.
                </p>
                <div class="file-upload">
                    <button type="button" class="file-upload-btn">
                        <i class="fas fa-image" style="margin-right: 0.5rem;"></i> Görsel Seç
                    </button>
                    <input type="file" name="images[]" class="file-upload input" multiple accept="image/*">
                </div>
                <small class="file-upload-info">En fazla 3 görsel yükleyebilirsiniz (JPEG, PNG veya GIF)</small>
            </div>
            
            <div class="actions-row">
                <a href="{{ route('games.detail', $game->id) }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Oyun sayfasına dön
                </a>
                
                <button type="submit" class="review-submit">
                    <i class="fas fa-paper-plane"></i> İnceleme Gönder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Dosya yükleme önizleme
    document.addEventListener('DOMContentLoaded', function() {
        const fileUpload = document.querySelector('.file-upload input');
        const fileUploadBtn = document.querySelector('.file-upload-btn');
        
        fileUpload.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileUploadBtn.textContent = `${this.files.length} dosya seçildi`;
                
                if (this.files.length > 3) {
                    alert('En fazla 3 görsel yükleyebilirsiniz!');
                    this.value = '';
                    fileUploadBtn.innerHTML = '<i class="fas fa-image" style="margin-right: 0.5rem;"></i> Görsel Seç';
                }
            } else {
                fileUploadBtn.innerHTML = '<i class="fas fa-image" style="margin-right: 0.5rem;"></i> Görsel Seç';
            }
        });
    });
</script>
@endsection 