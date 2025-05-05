@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', 'Sepetim')

@section('styles')
<style>
    .cart-container {
        padding: 2rem 0;
    }
    
    .cart-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-dark);
        padding-bottom: 1rem;
    }
    
    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }
    
    .cart-items {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
    }
    
    .cart-item {
        display: flex;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .cart-item-image {
        width: 120px;
        height: 70px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .cart-item-info {
        flex: 1;
    }
    
    .cart-item-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }
    
    .cart-item-category {
        display: inline-block;
        font-size: 0.8rem;
        color: var(--text-gray);
        margin-bottom: 0.5rem;
    }
    
    .cart-item-price {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .cart-item-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }
    
    .cart-item-remove {
        background: none;
        border: none;
        color: var(--text-gray);
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }
    
    .cart-item-remove:hover {
        color: #f44336;
    }
    
    .cart-summary {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
        height: fit-content;
    }
    
    .summary-title {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .summary-label {
        color: var(--text-gray);
    }
    
    .summary-value {
        font-weight: 600;
    }
    
    .summary-total {
        font-size: 1.2rem;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid var(--accent-dark);
    }
    
    .promo-code {
        margin: 1.5rem 0;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .promo-input {
        display: flex;
        gap: 0.5rem;
    }
    
    .promo-input input {
        flex: 1;
        padding: 0.6rem;
        background-color: var(--accent-dark);
        border: none;
        border-radius: 4px;
        color: var(--text-light);
    }
    
    .checkout-btn {
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        margin-top: 1rem;
    }
    
    .checkout-btn:hover {
        background-color: #3d9a40;
    }
    
    .payment-options {
        margin-top: 1.5rem;
    }
    
    .payment-title {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: var(--text-gray);
    }
    
    .payment-cards {
        display: flex;
        gap: 0.5rem;
    }
    
    .payment-card {
        width: 40px;
        height: 25px;
        background-color: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
    }
    
    .empty-cart-icon {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }
    
    .empty-cart-text {
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
    
    .cart-actions {
        margin-top: 1rem;
        text-align: center;
    }
    
    .clear-cart-btn {
        color: #f44336;
        background: none;
        border: none;
        text-decoration: underline;
        cursor: pointer;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 0.5rem;
    }
    
    .clear-cart-btn:hover {
        color: #d32f2f;
    }
    
    @media (max-width: 768px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
        
        .cart-item {
            flex-direction: column;
        }
        
        .cart-item-actions {
            flex-direction: row;
            margin-top: 1rem;
        }
    }
    
    .personalized-deal-badge {
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #e91e63;
        color: white;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        z-index: 2;
    }
    
    .personalized-item {
        border: 1px solid #e91e63;
        box-shadow: 0 0 10px rgba(233, 30, 99, 0.1);
        position: relative;
        overflow: visible;
        border-radius: 8px;
    }
    
    .personalized-discount {
        color: #e91e63;
        font-weight: bold;
    }
    
    .auth-required {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
        background-color: var(--secondary-dark);
        border-radius: 8px;
        margin: 2rem auto;
        max-width: 600px;
    }
    
    .auth-required-icon {
        font-size: 4rem;
        color: var(--accent-color);
        margin-bottom: 1.5rem;
    }
    
    .auth-required-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }
    
    .auth-required-text {
        margin-bottom: 1.5rem;
        color: var(--text-gray);
    }
    
    .auth-btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: var(--accent-color);
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
        margin: 0 0.5rem;
    }
    
    .auth-btn:hover {
        background-color: var(--accent-dark);
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
    <div class="cart-container">
        <h1 class="cart-title">Sepetim</h1>
        
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
        
        @if(Auth::check())
            @if(isset($cartItems) && count($cartItems) > 0)
                <div class="cart-grid">
                    <div class="cart-items">
                        @foreach($cartItems as $item)
                            <div class="cart-item {{ $item['is_personalized'] ? 'personalized-item' : '' }}">
                                @if($item['is_personalized'])
                                    <div class="personalized-deal-badge">
                                        <i class="fas fa-star"></i> Size Özel İndirim
                                    </div>
                                @endif
                                
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="cart-item-image">
                                
                                <div class="cart-item-info">
                                    <h3 class="cart-item-title">{{ $item['title'] }}</h3>
                                    <span class="cart-item-category">{{ $item['category'] }}</span>
                                    
                                    <div class="cart-item-price">
                                        @if($item['discount_price'])
                                            <span class="price {{ $item['is_personalized'] ? 'personalized-discount' : '' }}">₺{{ $item['discount_price'] }}</span>
                                            <span class="discount {{ $item['is_personalized'] ? 'personalized-discount' : '' }}">-{{ round((($item['price'] - $item['discount_price']) / $item['price']) * 100) }}%</span>
                                            @if($item['is_personalized'])
                                                <small class="personalized-text">Kişiye özel indirim</small>
                                            @endif
                                        @else
                                            <span class="price">₺{{ $item['price'] }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="cart-item-actions">
                                    <a href="{{ route('cart.remove', ['gameId' => $item['id']]) }}" class="cart-item-remove">
                                        <i class="fas fa-trash-alt"></i> Kaldır
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="cart-summary">
                        <h2 class="summary-title">Sipariş Özeti</h2>
                        
                        <div class="summary-row">
                            <span class="summary-label">Ürünler ({{ $totalCount }})</span>
                            <span class="summary-value">₺{{ $totalPrice + $discount }}</span>
                        </div>
                        
                        @if($discount > 0)
                            <div class="summary-row">
                                <span class="summary-label">İndirim</span>
                                <span class="summary-value">-₺{{ $discount }}</span>
                            </div>
                        @endif
                        
                        <div class="promo-code">
                            <p>Promosyon Kodu</p>
                            <div class="promo-input">
                                <input type="text" placeholder="Kod girin">
                                <button class="btn btn-primary">Uygula</button>
                            </div>
                        </div>
                        
                        <div class="summary-row summary-total">
                            <span class="summary-label">Toplam</span>
                            <span class="summary-value">₺{{ $totalPrice }}</span>
                        </div>
                        
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="checkout-btn">Ödemeye Geç</button>
                        </form>
                        
                        <div class="cart-actions">
                            <a href="{{ route('cart.clear') }}" class="clear-cart-btn">Sepeti Temizle</a>
                        </div>
                        
                        <div class="payment-options">
                            <p class="payment-title">Ödeme Seçenekleri</p>
                            <div class="payment-cards">
                                <div class="payment-card">
                                    <i class="fab fa-cc-visa"></i>
                                </div>
                                <div class="payment-card">
                                    <i class="fab fa-cc-mastercard"></i>
                                </div>
                                <div class="payment-card">
                                    <i class="fab fa-cc-paypal"></i>
                                </div>
                                <div class="payment-card">
                                    <i class="fab fa-bitcoin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2>Sepetiniz boş</h2>
                    <p class="empty-cart-text">Henüz sepetinize ürün eklemediniz. Keşfetmeye başlayın!</p>
                    <a href="{{ url('/games') }}" class="btn btn-primary">Oyunları Keşfet</a>
                </div>
            @endif
        @else
            <div class="auth-required">
                <div class="auth-required-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h2 class="auth-required-title">Giriş Yapmanız Gerekiyor</h2>
                <p class="auth-required-text">Sepetinize erişmek ve alışveriş yapmak için lütfen giriş yapın veya kayıt olun.</p>
                <div>
                    <a href="{{ route('login') }}" class="auth-btn">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="auth-btn">Kayıt Ol</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function removeFromCart(id) {
        // Gerçek uygulamada burada AJAX ile sepetten ürün silme işlemi yapılacaktır
        alert('Ürün sepetten kaldırıldı (ID: ' + id + ')');
        
        // Demo amaçlı, ürünü görsel olarak kaldır
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length >= id) {
            cartItems[id-1].style.display = 'none';
        }
        
        // Eğer son ürün kaldırıldıysa, boş sepet mesajını göster
        const visibleItems = Array.from(cartItems).filter(item => item.style.display !== 'none');
        if (visibleItems.length === 0) {
            document.querySelector('.cart-grid').style.display = 'none';
            document.querySelector('.empty-cart').style.display = 'flex';
        }
    }
    
    function checkout() {
        alert('Ödeme sayfasına yönlendiriliyorsunuz...');
        // Gerçek uygulamada burada ödeme sayfasına yönlendirme işlemi yapılacaktır
    }
</script>
@endsection 