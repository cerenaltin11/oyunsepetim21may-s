@extends('layouts.app')

@section('title', 'Kullanıcı Paneli')

@section('styles')
<style>
    .dashboard-container {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .dashboard-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1.5rem;
    }
    
    .user-large-avatar {
        width: 80px;
        height: 80px;
        background-color: var(--accent-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        overflow: hidden;
        border: 3px solid var(--accent-color);
    }
    
    .user-large-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .dashboard-header-info h1 {
        margin: 0;
        font-size: 2rem;
    }
    
    .dashboard-header-info p {
        margin: 0.5rem 0 0;
        color: var(--text-gray);
    }
    
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .dashboard-cards a {
        display: block;
        transition: transform 0.3s;
    }
    
    .dashboard-cards a:hover {
        transform: translateY(-5px);
    }
    
    .dashboard-card {
        background-color: var(--accent-dark);
        border-radius: 8px;
        padding: 1.5rem;
        height: 100%;
    }
    
    .dashboard-card-icon {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }
    
    .dashboard-card h3 {
        margin: 0 0 0.5rem;
        font-size: 1.2rem;
    }
    
    .dashboard-card p {
        margin: 0;
        color: var(--text-gray);
    }
    
    .recent-activity {
        background-color: var(--accent-dark);
        border-radius: 8px;
        padding: 1.5rem;
    }
    
    .recent-activity h2 {
        margin-top: 0;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
    
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .activity-item {
        padding: 1rem 0;
        border-bottom: 1px solid var(--secondary-dark);
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-date {
        display: block;
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
</style>
@endsection

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="user-large-avatar">
                @if(Auth::user()->photo)
                    <img src="{{ asset('images/profiles/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ substr(Auth::user()->name, 0, 1) }}
                @endif
            </div>
            <div class="dashboard-header-info">
                <h1>Hoş Geldiniz, {{ Auth::user()->name }}</h1>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        
        <div class="dashboard-cards">
            <a href="/orders" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <div class="dashboard-card-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h3>Kütüphanem</h3>
                    <p>Satın aldığınız oyunları buradan görüntüleyebilirsiniz.</p>
                </div>
            </a>
            
            <a href="/orders" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <div class="dashboard-card-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <h3>Siparişlerim</h3>
                    <p>Sipariş geçmişinizi ve durumlarını kontrol edin.</p>
                </div>
            </a>
            
            <a href="/games" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <div class="dashboard-card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>İstek Listem</h3>
                    <p>İstek listenize eklediğiniz oyunları görüntüleyin.</p>
                </div>
            </a>
            
            <a href="/profile" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <div class="dashboard-card-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h3>Profil Ayarları</h3>
                    <p>Hesap bilgilerinizi ve tercihlerinizi düzenleyin.</p>
                </div>
            </a>
        </div>
        
        <div class="recent-activity">
            <h2>Son Etkinlikler</h2>
            <ul class="activity-list">
                <li class="activity-item">
                    Hesabınız oluşturuldu.
                    <span class="activity-date">{{ Auth::user()->created_at->format('d.m.Y H:i') }}</span>
                </li>
                <!-- Daha sonra başka etkinlikler burada listelenebilir -->
            </ul>
        </div>
    </div>
@endsection 