@extends('layouts.app')

@section('title', 'Ödeme Başarılı')

@section('styles')
<style>
    .success-container {
        padding: 3rem 0;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .success-icon {
        font-size: 5rem;
        color: #4caf50;
        margin-bottom: 1.5rem;
        animation: success-pulse 2s ease-in-out;
    }
    
    @keyframes success-pulse {
        0% { transform: scale(0.5); opacity: 0; }
        50% { transform: scale(1.2); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .success-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #4caf50;
    }
    
    .success-message {
        font-size: 1.1rem;
        color: var(--text-gray);
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .order-details {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .order-number {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
    }
    
    .order-label {
        color: var(--text-gray);
    }
    
    .purchased-games {
        margin-top: 1.5rem;
        border-top: 1px solid var(--accent-dark);
        padding-top: 1.5rem;
    }
    
    .purchased-game {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        background-color: var(--accent-dark);
        border-radius: 4px;
    }
    
    .game-image {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 1rem;
    }
    
    .game-details {
        flex-grow: 1;
    }
    
    .game-title {
        font-weight: bold;
        margin-bottom: 0.2rem;
    }
    
    .game-price {
        font-size: 0.9rem;
        color: var(--text-gray);
    }
    
    .total-price {
        font-size: 1.1rem;
        font-weight: bold;
        text-align: right;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--accent-dark);
    }
    
    .actions {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 1rem;
    }
    
    .action-btn {
        padding: 0.8rem 1.5rem;
        border-radius: 4px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background-color: var(--accent-color);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #0b86e3;
    }
    
    .btn-secondary {
        background-color: var(--accent-dark);
        color: var(--text-light);
    }
    
    .btn-secondary:hover {
        background-color: #444;
    }
    
    .thank-you {
        margin-top: 3rem;
        font-size: 1.2rem;
        color: var(--text-light);
    }
    
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #f00;
        opacity: 0;
    }
</style>
@endsection

@section('content')
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="success-title">Ödemeniz Başarıyla Tamamlandı!</h1>
        
        <p class="success-message">
            Siparişiniz başarıyla oluşturuldu ve ödemeniz onaylandı. 
            Oyunlarınız kütüphanenize eklenmiştir. Kütüphanem sayfasından oyunlarınıza erişebilirsiniz.
        </p>
        
        <div class="order-details">
            <div class="order-number">
                <strong>Sipariş Numarası:</strong> #{{ $orderDetails['order_id'] }}
            </div>
            
            <div class="order-info">
                <span class="order-label">Sipariş Tarihi:</span>
                <span>{{ $orderDetails['date'] }}</span>
            </div>
            
            <div class="order-info">
                <span class="order-label">Ödeme Yöntemi:</span>
                <span>{{ $orderDetails['payment_method'] }}</span>
            </div>
            
            <div class="order-info">
                <span class="order-label">Kart Numarası:</span>
                <span>{{ $orderDetails['card_number'] }}</span>
            </div>
            
            <div class="order-info">
                <span class="order-label">Durum:</span>
                <span style="color: #4caf50;">Tamamlandı</span>
            </div>
            
            <div class="purchased-games">
                <h3>Satın Alınan Oyunlar</h3>
                
                @foreach($orderDetails['items'] as $item)
                    <div class="purchased-game">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="game-image">
                        <div class="game-details">
                            <div class="game-title">{{ $item['title'] }}</div>
                            <div class="game-price">₺{{ number_format($item['price'], 2, ',', '.') }}</div>
                        </div>
                    </div>
                @endforeach
                
                <div class="total-price">
                    Toplam: ₺{{ number_format($orderDetails['total'], 2, ',', '.') }}
                </div>
            </div>
        </div>
        
        <div class="actions">
            <a href="/library" class="action-btn btn-primary">
                <i class="fas fa-gamepad"></i> Kütüphaneme Git
            </a>
            <a href="/games" class="action-btn btn-secondary">
                <i class="fas fa-shopping-cart"></i> Alışverişe Devam Et
            </a>
        </div>
        
        <div class="thank-you">
            OyunSepetim'i tercih ettiğiniz için teşekkür ederiz!
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfeti efekti
        function createConfetti() {
            const colors = ['#1a9fff', '#4caf50', '#e91e63', '#ff9800', '#9c27b0'];
            const confettiCount = 100;
            
            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = -10 + 'px';
                confetti.style.opacity = Math.random();
                confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                
                document.body.appendChild(confetti);
                
                const size = Math.random() * 8 + 6;
                confetti.style.width = size + 'px';
                confetti.style.height = size + 'px';
                
                const destinationX = confetti.offsetLeft + (Math.random() - 0.5) * 200;
                const destinationY = window.innerHeight;
                
                const animation = confetti.animate([
                    { transform: `translate(0, 0) rotate(0deg)`, opacity: 1 },
                    { transform: `translate(${(Math.random() - 0.5) * 300}px, ${destinationY}px) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                ], {
                    duration: Math.random() * 3000 + 2000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)',
                    fill: 'forwards'
                });
                
                animation.onfinish = () => {
                    confetti.remove();
                };
            }
        }
        
        // Konfeti efektini başlat
        setTimeout(createConfetti, 500);
    });
</script>
@endsection 