@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('styles')
<style>
    .auth-container {
        max-width: 500px;
        margin: 2rem auto;
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    
    .auth-title {
        text-align: center;
        margin-bottom: 2rem;
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
    
    .form-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }
    
    .form-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-gray);
    }
    
    .login-link a {
        color: var(--accent-color);
        text-decoration: none;
    }
    
    .login-link a:hover {
        text-decoration: underline;
    }
    
    .error-message {
        color: #f44336;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    
    .alert-danger {
        background-color: rgba(244, 67, 54, 0.2);
        color: #f44336;
        border: 1px solid #f44336;
    }
</style>
@endsection

@section('content')
    <div class="auth-container">
        <h1 class="auth-title">Kayıt Ol</h1>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="/register" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Şifre Tekrar</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>
            </div>
            
            <div class="form-buttons">
                <a href="/" class="btn">Geri Dön</a>
                <button type="submit" class="btn btn-primary">Kayıt Ol</button>
            </div>
        </form>
        
        <div class="login-link">
            Zaten hesabınız var mı? <a href="/login">Giriş Yap</a>
        </div>
    </div>
@endsection 