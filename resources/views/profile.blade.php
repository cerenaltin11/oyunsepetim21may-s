@extends('layouts.app')

@section('title', 'Profil Bilgilerim')

@section('styles')
<style>
    .profile-container {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .profile-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--accent-dark);
        padding-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }
    
    .profile-header h1 {
        margin-top: 0;
    }
    
    .profile-form {
        max-width: 600px;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem;
        background-color: var(--accent-dark);
        border: none;
        border-radius: 4px;
        color: var(--text-light);
        font-size: 1rem;
    }
    
    .form-input:focus {
        outline: 2px solid var(--accent-color);
    }
    
    .btn-group {
        display: flex;
        gap: 1rem;
    }
    
    .section-divider {
        margin: 2rem 0;
        border-top: 1px solid var(--accent-dark);
        padding-top: 2rem;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background-color: rgba(76, 175, 80, 0.2);
        color: #4caf50;
        border: 1px solid #4caf50;
    }
    
    .alert-danger {
        background-color: rgba(244, 67, 54, 0.2);
        color: #f44336;
        border: 1px solid #f44336;
    }
    
    .profile-photo-section {
        margin-bottom: 2rem;
    }
    
    .profile-photo-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        background-color: var(--accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 3px solid var(--accent-color);
    }
    
    .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-photo-placeholder {
        color: var(--text-gray);
        font-size: 3rem;
    }
    
    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }
    
    .file-upload input[type=file] {
        position: absolute;
        font-size: 100px;
        top: 0;
        right: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    .upload-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: var(--accent-dark);
        color: var(--text-gray);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .upload-btn:hover {
        background-color: var(--accent-color);
        color: white;
    }
    
    .selected-file {
        margin-top: 0.5rem;
        font-size: 0.9rem;
        color: var(--text-gray);
    }
    
    .photo-preview {
        display: none;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-photo">
                @if(Auth::user()->photo)
                    <img src="{{ asset('images/profiles/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}">
                @else
                    <i class="fas fa-user profile-photo-placeholder"></i>
                @endif
            </div>
            <div>
                <h1>Profil Bilgilerim</h1>
                <p>Hesap bilgilerinizi buradan güncelleyebilirsiniz.</p>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="profile-photo-section">
            <h2>Profil Fotoğrafı</h2>
            <form class="profile-form" action="/profile/photo" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="profile-photo-container">
                    <div class="file-upload">
                        <button type="button" class="upload-btn">
                            <i class="fas fa-upload"></i> Fotoğraf Seç
                        </button>
                        <input type="file" name="photo" id="photo-upload" accept="image/*">
                    </div>
                    <div class="selected-file" id="selected-file-name">Dosya seçilmedi</div>
                </div>
                
                <img id="photo-preview" class="photo-preview" src="#" alt="Önizleme">
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Fotoğrafı Yükle</button>
                    @if(Auth::user()->photo)
                        <a href="/profile/photo/delete" class="btn btn-danger">Fotoğrafı Kaldır</a>
                    @endif
                </div>
            </form>
        </div>
        
        <div class="section-divider"></div>
        
        <h2>Kişisel Bilgiler</h2>
        <form class="profile-form" action="/profile" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ Auth::user()->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ Auth::user()->email }}" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Bilgileri Güncelle</button>
            </div>
        </form>
        
        <div class="section-divider"></div>
        
        <h2>Şifre Değiştir</h2>
        <form class="profile-form" action="/password" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="current_password" class="form-label">Mevcut Şifre</label>
                <input type="password" id="current_password" name="current_password" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Yeni Şifre</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoUpload = document.getElementById('photo-upload');
        const selectedFileName = document.getElementById('selected-file-name');
        const photoPreview = document.getElementById('photo-preview');
        
        // Dosya seçildiğinde isim gösterme ve önizleme
        photoUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                selectedFileName.textContent = file.name;
                
                // Dosya önizleme
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                selectedFileName.textContent = 'Dosya seçilmedi';
                photoPreview.style.display = 'none';
            }
        });
    });
</script>
@endsection 